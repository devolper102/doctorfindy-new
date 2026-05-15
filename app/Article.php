<?php
/**
 * Class Article.
 *
 * @category Doctry
 *
 * @package Doctry
 * @author  Amentotech <theamentotech@gmail.com>
 * @license http://www.amentotech.com Amentotech
 * @link    http://www.amentotech.com
 */
namespace App;

use Auth;
use File;
use App\User;
use App\Category;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use Illuminate\Database\Eloquent\Model;
use GeneaLabs\LaravelModelCaching\Traits\Cachable;
use Intervention\Image\Facades\Image;
use App\Models\ArticleCategory;
use Storage;

/**
 * Class Article
 *
 */
class Article extends Model
{
    use Cachable;
    /**
     * Fillable for the database
     *
     * @return fillable
     */
    protected $fillable = array(
        'author_id', 'categories', 'tags', 'views', 'title', 'description', 'image',
        'excerpt', 'is_featured','reading_time','status','url_title'
    );

    /**
     * Dates
     *
     * @return protected dates
     */
    protected $dates = [
        'created_at',
        'updated_at',
    ];

    /**
     * Articles can have multiple authors
     *
     * @return relation
     */
    public function author()
    {
        return $this->belongsTo('App\User')->with('profile')->with('roles');
    }
    public function articleCategory()
    {
        return $this->hasOne(ArticleCategory::class, 'article_id', 'id');
    }

    /**
     * Articles can have multiple categories.
     *
     * @return relation
     */
    public function categories()
    {
        return $this->belongsToMany('App\Category')->withPivot('category_id');
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
            if (!Article::all()->where('slug', $temp)->isEmpty()) {
                $i = 1;
                $new_slug = $temp . '-' . $i;
                while (!Article::all()->where('slug', $new_slug)->isEmpty()) {
                    $i++;
                    $new_slug = $temp . '-' . $i;
                }
                $temp = $new_slug;
            }
            $this->attributes['slug'] = $temp;
        }
    }

    /**
     * Create article
     *
     * @param mixed $request $req->attr
     *
     * @return relation
     */
    public function createArticle(Request $request)
{
    if (!empty($request)) {
        $article = new Article();
        $article->title = filter_var($request['title'], FILTER_SANITIZE_STRING);
        $article->url_title = filter_var($request['url_title'], FILTER_SANITIZE_STRING);
        $article->slug = filter_var($request['url_title'], FILTER_SANITIZE_STRING);
        $article->short_description = $request['short_description'];
        $article->description = $request['description'];
        $article->reading_time = $request['reading_time'];
        $article->excerpt = filter_var(Str::limit($request['description'], 100), FILTER_SANITIZE_STRING);

        if ($request['is_featured'] === 'true') {
            $article->is_featured = 1;
        } else {
            $article->is_featured = 0;
        }

        $article->status = 'pending';
        $user_id = User::find(Auth::user()->id);
        $article->author()->associate($user_id);

        if (!empty($request['hidden_feature_img'])) {
            $filename = $request['hidden_feature_img'];
            $parts = explode('.', $filename);
            $file_original_name = $parts[0] . '.webp';

            $old_path = 'uploads/users/temp';
            $new_path = 'uploads/users/' . Auth::user()->id . '/articles';
            $watermarkPath = 'images/doctorfindy-header-blog-logo.png';

            // Determine the disk based on the environment
            $disk = (env('FILESYSTEM_DRIVER') === 'production') ? 's3' : 'local_public';

            // create directory if not exist
            if (!Storage::disk($disk)->exists($new_path)) {
                Storage::disk($disk)->makeDirectory($new_path);
            }

            $filename = time() . '-' . $file_original_name;

            // Get image sizes configurations
            $article_img_sizes = Helper::getImageSizes('articles');

            // Process and store images
            if (!empty($article_img_sizes)) {
                foreach ($article_img_sizes as $key => $size) {
                    $image = Image::make(Storage::disk($disk)->get($old_path . '/' . $key . '-' . $file_original_name));
                    $image->resize($size['width'], $size['height'], function ($constraint) {
                        $constraint->aspectRatio();
                    });

                    // Resize the watermark to fit the image size
                    $watermark = Image::make(Storage::disk($disk)->get($watermarkPath))->resize(round($size['width'] * 0.2), null, function ($constraint) {
                        $constraint->aspectRatio();
                    });

                    // Calculate the position to place the watermark (top-right corner)
                    $x = $image->getWidth() - $watermark->getWidth() - 10;
                    $y = 10;

                    // Apply the watermark to the image
                    $image->insert($watermark, 'top-left', $x, $y);

                    // Save the image with the watermark
                    Storage::disk($disk)->put($new_path . '/' . $key . '-' . $filename, $image->stream(), 'public');
                }
            }

            // Save the original image size
            $image = Image::make(Storage::disk($disk)->get($old_path . '/' . $file_original_name));
            $image->insert(Storage::disk($disk)->get($watermarkPath), 'top-right', 30, 30);
            Storage::disk($disk)->put($new_path . '/' . $filename, $image->stream(), 'public');

            $article->image = filter_var($filename, FILTER_SANITIZE_STRING);
        } else {
            $article->image = null;
        }

        $article->save();

        $cats = $request['categories'];
        $article->categories()->detach();

        if (!empty($cats)) {
            foreach ($cats as $cat) {
                $article->categories()->attach($cat['id']);
            }
        }

        return 'success';
    } else {
        return 'error';
    }
}


    function generateSlug($input) {
    $slug = strtolower($input);
    $slug = preg_replace('/[^a-z0-9-]+/', '-', $slug);
    $slug = trim($slug, '-');
    
    
    return $slug;
}    

    /**
     * Get Articles
     *
     * @param integer $paginate paginate
     * @param boolean $featured featured
     * 
     * @access public
     *
     * @return array
     */
    public static function getArticles($paginate = 7, $featured = '')
    {
        $articles = array();
        $articles = Article::latest();
        if (!empty($featured)) {
            $articles->where('is_featured', $featured);
        }
        return $articles->paginate(intval($paginate));
        
    }
    

    /**
     * Update Article
     *
     * @param integer $request    $req->attr
     * @param integer $article_id article_id
     * @param integer $user_id    user ID
     *
     * @return relation
     */
    public function updateArticle($request, $article_id, $user_id)
    {
        if (!empty($request)) {
            $article = $this->findOrFail($article_id);
            $article->title = filter_var($request['title'], FILTER_SANITIZE_STRING);
            if ($article->url_title != $request['url_title']) {
                $article->slug = filter_var($request['url_title'], FILTER_SANITIZE_STRING);
            }
            // $article->url_title = filter_var($request['url_title'], FILTER_SANITIZE_STRING);
            // $article->slug = filter_var($request['url_title'], FILTER_SANITIZE_STRING);
            $article->short_description = $request['short_description'];
            $article->description = $request['description'];
            $article->reading_time = $request['reading_time'];
            $article->excerpt = filter_var(Str::limit($request['description'], 100), FILTER_SANITIZE_STRING);
            if ($request['is_featured'] === 'true') {
                $article->is_featured = 1;
            } else {
                $article->is_featured = 0;
            }
             if ($request['status'] === 'approved') {
                 // Update the status to approved
                $article->status = 'approved';
             } else {
                     // Update the status to pending
                     $article->status = 'pending';
             }

            $watermarkPath = 'images/doctorfindy-header-blog-logo.png';
            
            if (!empty($request['hidden_feature_img'])) {
            $filename = $request['hidden_feature_img'];
            $parts = explode('.', $filename);
            $file_original_name = $parts[0] . '.webp';

            $old_path = 'uploads/users/temp';
            $new_path = 'uploads/users/' . Auth::user()->id . '/articles';
            $full_path = $new_path . '/' . $filename;
            // $watermarkPath = 'images/doctorfindy-header-blog-logo.png';

            // Determine the disk based on the environment
            $disk = (env('FILESYSTEM_DRIVER') === 'production') ? 's3' : 'local_public';
            
            
            // create directory if not exist
            if (!Storage::disk($disk)->exists($new_path)) {
                Storage::disk($disk)->makeDirectory($new_path);
            }
            if (!Storage::disk($disk)->exists($full_path)) {
            $filename = time() . '-' . $file_original_name;

            // Get image sizes configurations
            $article_img_sizes = Helper::getImageSizes('articles');

            // Process and store images
            if (!empty($article_img_sizes)) {
                foreach ($article_img_sizes as $key => $size) {
                    $image = Image::make(Storage::disk($disk)->get($old_path . '/' . $key . '-' . $file_original_name));
                    $image->resize($size['width'], $size['height'], function ($constraint) {
                        $constraint->aspectRatio();
                    });

                    // Resize the watermark to fit the image size
                    $watermark = Image::make(Storage::disk($disk)->get($watermarkPath))->resize(round($size['width'] * 0.2), null, function ($constraint) {
                        $constraint->aspectRatio();
                    });

                    // Calculate the position to place the watermark (top-right corner)
                    $x = $image->getWidth() - $watermark->getWidth() - 10;
                    $y = 10;

                    // Apply the watermark to the image
                    $image->insert($watermark, 'top-left', $x, $y);

                    // Save the image with the watermark
                    Storage::disk($disk)->put($new_path . '/' . $key . '-' . $filename, $image->stream(), 'public');
                }
            }

            // Save the original image size
            $image = Image::make(Storage::disk($disk)->get($old_path . '/' . $file_original_name));
            $image->insert(Storage::disk($disk)->get($watermarkPath), 'top-right', 30, 30);
            Storage::disk($disk)->put($new_path . '/' . $filename, $image->stream(), 'public');

            $article->image = filter_var($filename, FILTER_SANITIZE_STRING);
        }else{
            $article->image = filter_var($filename, FILTER_SANITIZE_STRING);
        }
        } else {
            $article->image = null;
        }

             if (!empty($request['hidden_background_img'])) {
                $backgroundImg = $request['hidden_background_img'];
                $prts = explode('.', $backgroundImg);
                $background_img_name = $prts[0].'.webp';
                $background_img_old_path = '/uploads/users/temp';
                $background_img_new_path = '/uploads/users/'.Auth::user()->id.'/articles';
                $background_img_full_path = $background_img_new_path . '/' . $backgroundImg;
                // Determine the disk based on the environment
                $disk = (env('FILESYSTEM_DRIVER') === 'production') ? 's3' : 'local_public';

                // create directory if not exist
                if (!Storage::disk($disk)->exists($background_img_new_path)) {
                Storage::disk($disk)->makeDirectory($background_img_new_path);
                }
                if (!Storage::disk($disk)->exists($background_img_full_path)) {
                    $backgroundImg = time() . '-' . $background_img_name;
                     $image = Image::make(Storage::disk($disk)->get($background_img_old_path . '/' . $background_img_name));
                        
                        $image->insert(Storage::disk($disk)->get($watermarkPath, 'top-right', 30, 30));
                        Storage::disk($disk)->put($background_img_new_path . '/' . $backgroundImg, $image->stream(), 'public');
                        // rename($background_img_old_path . '/' . $background_img_name,$background_img_new_path . '/' . $backgroundImg);
                
                $article->background_img = filter_var($backgroundImg, FILTER_SANITIZE_STRING);
               }
               else{
                $article->background_img = filter_var($backgroundImg, FILTER_SANITIZE_STRING);
            } 
            }
             else {
                $article->background_img = null;
            }
            $article->save();
            $cats = $request['categories'];
            $article->categories()->detach();
            if (!empty($cats)) {
                foreach ($cats as $cat) {
                    $article->categories()->attach($cat['id']);
                }
            }
            return 'success';
        } else {
            return 'error';
        }
    }


}
