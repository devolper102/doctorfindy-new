<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class PharmacyMedicine extends Model
{
    use HasFactory;

    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'pharmacy_medicines';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'medicine_category_id',
        'medicine_subcategory_id',
        'name',
        'slug',
        'image',
        'manufacturer',
        'generic_name',
        'rating',
        'price',
        'sale_price',
        'pack_size',
        'pack_price',
        'pack_sale_price',
        'status',
    ];

    /**
     * The accessors to append to the model's array form.
     *
     * @var array
     */
    protected $appends = ['image_url'];

    /**
     * Boot the model.
     *
     * @return void
     */
    protected static function boot()
    {
        parent::boot();

        // Auto-generate slug when saving if it doesn't have one
        static::saving(function ($medicine) {
            if (empty($medicine->slug) && !empty($medicine->name)) {
                $medicine->slug = Str::slug($medicine->name);
                // Check if slug already exists
                $query = self::where('slug', $medicine->slug);
                if ($medicine->exists) {
                    $query->where('id', '!=', $medicine->id);
                }
                
                if ($query->exists()) {
                    $i = 1;
                    $new_slug = $medicine->slug . '-' . $i;
                    while (self::where('slug', $new_slug)->where('id', '!=', $medicine->id)->exists()) {
                        $i++;
                        $new_slug = $medicine->slug . '-' . $i;
                    }
                    $medicine->slug = $new_slug;
                }
            }
        });
    }

    /**
     * Ensure medicine has a slug, generate if missing
     *
     * @return void
     */
    public function ensureSlug()
    {
        if (empty($this->slug) && !empty($this->name)) {
            $this->slug = Str::slug($this->name);
            
            // Check if slug already exists
            $query = self::where('slug', $this->slug);
            if ($this->exists) {
                $query->where('id', '!=', $this->id);
            }
            
            if ($query->exists()) {
                $i = 1;
                $new_slug = $this->slug . '-' . $i;
                while (self::where('slug', $new_slug)->where('id', '!=', $this->id)->exists()) {
                    $i++;
                    $new_slug = $this->slug . '-' . $i;
                }
                $this->slug = $new_slug;
            }
            
            // Save the slug
            if ($this->exists) {
                $this->saveQuietly();
            }
        }
    }

    /**
     * Get the category that owns the medicine.
     */
    public function category()
    {
        return $this->belongsTo(MedicineCategory::class, 'medicine_category_id');
    }

    /**
     * Get the subcategory that owns the medicine.
     */
    public function subcategory()
    {
        return $this->belongsTo(MedicineSubcategory::class, 'medicine_subcategory_id');
    }

    /**
     * Get the details for the medicine.
     */
    public function details()
    {
        return $this->hasOne(PharmacyMedicineDetail::class, 'pharmacy_medicine_id');
    }

    /**
     * Set slug attribute - auto-generate from name if not provided
     *
     * @param string $value
     * @return void
     */
    public function setSlugAttribute($value)
    {
        // If slug is provided, use it; otherwise generate from name
        if (empty($value) && !empty($this->attributes['name'])) {
            $value = $this->attributes['name'];
        }
        
        $temp = Str::slug($value, '-');
        
        // Check if slug already exists (excluding current record)
        $query = self::where('slug', $temp);
        if ($this->exists) {
            $query->where('id', '!=', $this->id);
        }
        
        if ($query->exists()) {
            $i = 1;
            $new_slug = $temp . '-' . $i;
            while (self::where('slug', $new_slug)->where('id', '!=', $this->id)->exists()) {
                $i++;
                $new_slug = $temp . '-' . $i;
            }
            $temp = $new_slug;
        }
        
        $this->attributes['slug'] = $temp;
    }

    /**
     * Get the image URL for the medicine.
     *
     * @return string|null
     */
    public function getImageUrlAttribute()
    {
        if (!$this->image) {
            return null;
        }

        if (env('FILESYSTEM_DRIVER') === 'production') {
            /** @var \Illuminate\Filesystem\FilesystemAdapter $disk */
            $disk = Storage::disk('s3');
            return $disk->url('uploads/pharmacy/medicines/' . $this->image);
        }

        return asset('uploads/pharmacy/medicines/' . $this->image);
    }
}

