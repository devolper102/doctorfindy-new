<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Storage;

class MedicineCategory extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name',
        'slug',
        'description',
        'image',
        'meta_title',
        'meta_description',
        'country_id',
        'state_id',
        'city_id',
        'status',
    ];

    /**
     * The accessors to append to the model's array form.
     *
     * @var array
     */
    protected $appends = ['image_url'];

    /**
     * Get the subcategories for the category.
     */
    public function subcategories()
    {
        return $this->hasMany(MedicineSubcategory::class, 'category_id');
    }

    /**
     * Get the image URL for the category.
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
            return $disk->url('uploads/pharmacy/categories/' . $this->image);
        }

        return asset('uploads/pharmacy/categories/' . $this->image);
    }
}
