<?php
/**
 * Class Category
 *
 * @category Doctry
 *
 * @package Doctry
 * @author  Amentotech <theamentotech@gmail.com>
 * @license http://www.amentotech.com Amentotech
 * @link    http://www.amentotech.com
 */

namespace App;

use DB;
use File;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;
use GeneaLabs\LaravelModelCaching\Traits\Cachable;
use App\Models\ArticleCategory;

/**
 * Class Category
 *
 */
class Category extends Model
{
    use Cachable;
    /**
     * Fillables for the database
     *
     * @access protected
     *
     * @var array $fillable
     */
    protected $fillable = array(
        'title', 'slug', 'abstract',
    );

    /**
     * Protected Date
     *
     * @access protected
     * @var    array $dates
     */
    protected $dates = [
        'created_at',
        'updated_at',
    ];

    /**
     * Categoy can have multiple articles.
     *
     * @return relation
     */
    public function articles()
    {
        return $this->belongsToMany('App\Article')->withPivot('article_id')->with('author');
    }

    public function speciality()
    {
        return $this->hasOne('App\Speciality','id','speciality_id');
    }
    public function subCategories()
    {
        return $this->hasMany('App\Category','parent', 'id')->with('articles');
    }


    /**
     * Set slug before saving in DB
     *
     * @param string $value value
     *
     * @access public
     *
     * @return string
     */
    public function setSlugAttribute($value)
    {
        if (!empty($value)) {
            $temp = Str::slug($value, '-');
            if (!Category::all()->where('slug', $temp)->isEmpty()) {
                $i = 1;
                $new_slug = $temp . '-' . $i;
                while (!Category::all()->where('slug', $new_slug)->isEmpty()) {
                    $i++;
                    $new_slug = $temp . '-' . $i;
                }
                $temp = $new_slug;
            }
            $this->attributes['slug'] = $temp;
        }
    }

    /**
     * Saving categories
     *
     * @param string $request Request attributes
     *
     * @return \Illuminate\Http\Response
     */
    public function saveCategories($request)
    {
        if (!empty($request)) {
            $this->title = filter_var($request['title'], FILTER_SANITIZE_STRING);
            $this->slug = filter_var($request['title'], FILTER_SANITIZE_STRING);
            $this->parent = filter_var($request['parent_category'], FILTER_VALIDATE_INT);
            $this->abstract = filter_var($request['abstract'], FILTER_SANITIZE_STRING);
            $old_path = Helper::PublicPath() . '/uploads/categories/temp';
            if (!empty($request['hidden_category_image'])) {
                $filename = $request['hidden_category_image'];
                $parts = explode('.', $filename);
                 $file_original_name = $parts[0].'.webp';
                if (file_exists($old_path . '/' . $file_original_name)) {

                    $new_path = Helper::PublicPath() . '/images/';
                    if (!file_exists($new_path)) {
                        File::makeDirectory($new_path, 0755, true, true);
                    }
                    $filename = time() . '-' . $file_original_name;
                    if (!empty(Helper::getImageSizes('category'))) {
                        foreach (Helper::getImageSizes('category') as $key => $size) {
                            rename($old_path . '/'.$key.'-'.$file_original_name, $new_path . '/' . $key.'-'.$filename);
                        }
                        rename($old_path . '/' . $file_original_name, $new_path . '/' . $filename);
                    } else {
                        rename($old_path . '/' . $file_original_name, $new_path . '/' . $filename);
                    }
                }
                $this->image = filter_var($filename, FILTER_SANITIZE_STRING);
            } else {
                $this->image = null;
            }
            $this->save();
            $json['type'] = 'success';
            $json['message'] = trans('lang.cat_created');
            return $json;
        }
    }

    /**
     * Updating Categories
     *
     * @param string $request Request attributes
     * @param int    $id      get department id for updation
     *
     * @return \Illuminate\Http\Response
     */
    public function updateCategories($request, $id)
    {
        if (!empty($request)) {
            $cats = self::find($id);
            if ($cats->title != $request['title']) {
                $cats->slug = filter_var($request['title'], FILTER_SANITIZE_STRING);
            }
            $cats->title = filter_var($request['title'], FILTER_SANITIZE_STRING);
            $parent_cat = filter_var($request['parent_category'], FILTER_VALIDATE_INT);
            $cats->parent = $parent_cat;
            $cats->abstract = filter_var($request['abstract'], FILTER_SANITIZE_STRING);
            $old_path = Helper::PublicPath() . '/uploads/categories/temp';
            if (!empty($request['hidden_category_image'])) {
                $filename = $request['hidden_category_image'];
                $parts = explode('.', $filename);
                $file_original_name = $parts[0].'.webp';
                if (file_exists($old_path . '/' . $file_original_name)) {

                    $new_path = Helper::PublicPath() . '/images/';
                    if (!file_exists($new_path)) {
                        File::makeDirectory($new_path, 0755, true, true);
                    }
                    $filename = time() . '-' . $file_original_name;
                    if (!empty(Helper::getImageSizes('category'))) {
                        foreach (Helper::getImageSizes('category') as $key => $size) {
                            rename($old_path . '/'.$key.'-'.$file_original_name, $new_path . '/' . $key.'-'.$filename);
                        }
                        rename($old_path . '/' . $file_original_name, $new_path . '/' . $filename);
                    } else {
                        rename($old_path . '/' . $file_original_name, $new_path . '/' . $filename);
                    }
                }
                $cats->image = filter_var($filename, FILTER_SANITIZE_STRING);
            } else {
                $cats->image = null;
            }
            return $cats->save();
        }
    }

    /**
     * For updating articles
     *
     * @param int $article_id article_id
     *
     * @return \Illuminate\Http\Response
     */
    public static function getArticleCat($article_id)
    {
         $categoryIds = ArticleCategory::where('article_id', $article_id)
            ->pluck('category_id')
            ->toArray();

        return $categoryIds;
        // return DB::table('article_category')->select('category_id')
        //     ->where('article_id', $article_id)
        //     ->get()->pluck('category_id')->toArray();
    }
}
