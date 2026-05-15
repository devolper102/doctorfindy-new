<?php

/**
 * Class ArticleController
 *
 * @category Doctry
 *
 * @package Doctry
 * @author  Amentotech <theamentotech@gmail.com>
 * @license http://www.amentotech.com Amentotech
 * @version <PHP: 1.0.0>
 * @link    http://www.amentotech.com
 */

namespace App\Http\Controllers;

use App\Disease;
use App\Location;
use App\Service;
use App\Speciality;
use App\UserMeta;
use DB;
use Auth;
use File;
use App\User;
use App\Helper;
use App\Category;
use App\Article;
use Illuminate\Http\Request;
use App\SiteManagement;
use Illuminate\Support\Arr;
use App\Models\ArticleCategory;

/**
 * Class ArticleController
 *
 */
class ArticleController extends Controller
{
    /**
     * Defining scope of variable
     *
     * @access public
     * @var    array $category
     */
    protected $article;

    /**
     * Create a new controller instance.
     *
     * @param mixed $article get site-management model
     *
     * @return void
     */
    public function __construct(Article $article)
    {
        $this->article = $article;
    }

    /**
     * Create Article.
     *
     * @return \Illuminate\Http\Response
     */
    public function createArticle()
    {
        $articles = $this->article::where('author_id', Auth::user()->id)->orderBy('created_at', 'desc')->paginate(8);
        $categories = Category::where('parent', '!=', 0)->pluck('title', 'id');
        return View(
            'back-end.articles.index',
            compact('categories', 'articles')
        );
    }

    /**
     * Edit Article.
     *
     * @param string $slug post slug
     * 
     * @return \Illuminate\Http\Response
     */
    public function editArticle($slug)
    {
        if (!empty($slug)) {
            $article = $this->article::where('slug', $slug)->first();
            $categories = Arr::pluck(Category::all()->toArray(), 'title', 'id');
            return View(
                'back-end.articles.edit',
                compact('article', 'categories')
            );
        } else {
            abort(404);
        }
    }

    /**
     * Post Article.
     *
     * @param \Illuminate\Http\Request $request request
     * 
     * @return \Illuminate\Http\Response
     */
    public function postArticle(Request $request)
    {
        // dd($request->all());
        $this->validate(
            $request,
            [
                'title' => 'required',
                'description' => 'required'
            ]
        );
        if (empty($request['categories'])) {
            $response['type'] = 'cat-required';
            $response['message'] = trans('lang.cat_required');
            return $response;
        }
        $server = Helper::doctieIsDemoSiteAjax();
        if (!empty($server)) {
            $response['type'] = 'error';
            $response['message'] = $server->getData()->message;
            return $response;
        }
        $json = array();
        if (!empty($request)) {
            $post_article = $this->article->createArticle($request);
            if ($post_article == "success") {
                $json['type'] = 'success';
                $json['progressing'] = trans('lang.saving');
                $json['message'] = trans('lang.article_created');
                return $json;
            } else {
                $json['type'] = 'error';
                $json['message'] = trans('lang.something_wrong');
                return $json;
            }
        } else {
            $json['type'] = 'error';
            $json['message'] = trans('lang.something_wrong');
            return $json;
        }
    }

    /**
     * Post Article.
     *
     * @param \Illuminate\Http\Request $request request
     * 
     * @return \Illuminate\Http\Response
     */
    public function updateArticle(Request $request)
    {
        $this->validate(
            $request,
            [
                'title' => 'required',
                'description' => 'required'
            ]
        );
        if (empty($request['categories'])) {
            $response['type'] = 'cat-required';
            $response['message'] = trans('lang.cat_required');
            return $response;
        }
        $server = Helper::doctieIsDemoSiteAjax();
        if (!empty($server)) {
            $response['type'] = 'error';
            $response['message'] = $server->getData()->message;
            return $response;
        }
        $json = array();
        if (!empty($request) && Auth::user()) {
            $article_id = $request['article_id'];
             $author_id = Auth::user()->id;
            // $update_article = $this->article->updateArticle($request, $article_id, Auth::user()->id);
             $update_article = $this->article->updateArticle($request, $article_id, $author_id);
            if ($update_article == "success") {
                $article = $this->article->find($article_id);
                $article->status = 'approved';
                $article->save();
                $json['type'] = 'success';
                $json['progressing'] = trans('lang.saving');
                $json['message'] = trans('lang.article_created');
                return $json;
            } else {
                $json['type'] = 'error';
                $json['message'] = trans('lang.something_wrong');
                return $json;
            }
        } else {
            $json['type'] = 'error';
            $json['message'] = trans('lang.something_wrong');
            return $json;
        }
    }

    /**
     * Remove article from database.
     *
     * @param mixed $request request attributes
     *
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request)
    {
        $server = Helper::doctieIsDemoSiteAjax();
        if (!empty($server)) {
            $json['type'] = 'error';
            $json['message'] = $server->getData()->message;
            return $json;
        }
        $json = array();
        $id = $request['id'];
        if (!empty($id)) {
            $article = $this->article::find($id);
            if ($article->categories->count() > 0) {
                $article->categories()->detach();
            }
            $this->article::where('id', $id)->delete();
            $json['type'] = 'success';
            $json['message'] = trans('lang.article_deleted');
            return $json;
        } else {
            $json['type'] = 'error';
            return $json;
        }
    }

    /**
     * Get all categories
     *
     * @param mixed $request request attributes
     * 
     * @return \Illuminate\Http\Response
     */
    public function getStoredCategories(Request $request)
    {
        $json = array();
        if (!empty($request['slug'])) {
            $article = $this->article::where('slug', $request['slug'])->select('id')->first();
            if (!empty($article)) {
                $articles = $this->article::find($article->id);
                $cats = $articles->categories->toArray();
                if (!empty($cats)) {
                    $json['type'] = 'success';
                    $json['cats'] = $cats;
                    return $json;
                } else {
                    $json['type'] = 'error';
                    return $json;
                }
            } else {
                $json['type'] = 'error';
                return $json;
            }
        } else {
            $json['type'] = 'error';
            return $json;
        }
    }

    /**
     * Get Article Categories.
     *
     * @param mixed $request request attributes
     *
     * @return \Illuminate\Http\Response
     */
    public function getArticleCats(Request $request)
    {
        $json = array();
        if (!empty($request['slug']) && $request['slug'] != 'create-article') {
            $article = $this->article::where('slug', $request['slug'])->select('id')->first();
            $db_cats = Category::select('id')->get()->pluck('id')->toArray();
            $article_cats = Category::getArticleCat($article->id);
            if (!empty($article_cats)) {
                $result = array_diff($db_cats, $article_cats);
                if (!empty($result)) {
                    $cats = DB::table('categories')
                        ->whereIn('id', $result)
                        ->orderBy('title')->get()->toArray();
                } else {
                    $cats = array();
                }
                $json['type'] = 'success';
                $json['cats'] = $cats;
                $json['message'] = trans('lang.cats_already_selected');
                return $json;
            } else {
                $cats = Category::select('title', 'id','parent')->get()->toArray();
                if (!empty($cats)) {
                    $json['type'] = 'success';
                    $json['cats'] = $cats;
                    return $json;
                } else {
                    $json['type'] = 'error';
                    $json['message'] = trans('lang.something_wrong');
                    return $json;
                }
            }
        } else {
            $cats = Category::select('title', 'id','parent')->get()->toArray();
            if (!empty($cats)) {
                $json['type'] = 'success';
                $json['cats'] = $cats;
                return $json;
            } else {
                $json['type'] = 'error';
                $json['message'] = trans('lang.something_wrong');
                return $json;
            }
        }
    }

    /**
     * Show article listing.
     *
     * @param string $category category
     * 
     * @return \Illuminate\Http\Response
     */
    public function articlesCategories()
    {
        $categories = Category::with('articles')->with('speciality')->with('subCategories')->get();
        // dd($categories);
        $articles = Article::with('categories')->where('status','approved')->orderBy('views','desc')->with('author')->paginate(8);
        $roundArticles = Article::with('categories')->where('status','approved')->with('author')->latest()->take(5)->get();
        // $roundArticles = $articles->take(5);
        $user_ = User::where('id', \Auth::id() ? Auth::id() : '')->with('profile')->with('roles')->first();
        $logged_user = $user_ ? $user_ : [];

        $doctors = User::role('doctor')->orderBy("trending","desc")->select('id','first_name','last_name','location_id','slug')->with('profile','specialities','location','feedbacks')->limit(4)->get();
        /*Hospital*/
        $hospitals = User::role('hospital')->orderBy("trending","desc")->with('profile','location','area','feedbacks','teams')->select('id','first_name','last_name','location_id','slug')->limit(6)->get();
        /*Laboratory*/
        $laboratories = User::role('laboratory')->with('profile','location','area')->select('id','first_name','last_name','location_id','slug')->limit(6)->get();
        /*Specialities*/
        $specialities = Speciality::select('id','title','slug','image')->orderBy("created_at","asc")->limit(8)->get();
        /*Diseases*/
        $diseases = Disease::select('id','title', 'slug','flag')->limit(4)->get();
        /*Services*/
        $services = Service::select('id','title', 'slug','image')->limit(4)->get();
        $cities = Location::where('top', '1')->orderBy("created_at","asc")->limit(6)->get();
        $meta_values = ['header_service','show_headertabs','topbar_settings','general_settings','download_app_sec','home_slider','socials','footer_settings','subscribe_now_sec','list_doctor_inner_section','procedure_banner_section'];
        $managements = SiteManagement::whereIn('meta_key',$meta_values)->get();
        $segments = \Request::segments();
        $blogsListingGraph = Helper::blogsListingGraph();
        return View(
            'front-end.articles.index',
            compact(
                'roundArticles',
                'categories',
                'articles',
                'logged_user',
                'laboratories',
                'cities',
                'services',
                'diseases',
                'specialities',
                'hospitals',
                'doctors',
                'managements',
                'segments'
                
            )
        );
    }
    public function articleSelectedCatogoryDoctors(Request $request,$id)
    {
        $speciality_id=$id;
        $user_ids = DB::table('user_speciality')->where('speciality_id',$speciality_id)->pluck('user_id')->toArray();
         $users = User::role('doctor')->whereIn('id',$user_ids)->with('location','doc_teams','teams','onlines','roles','feedbacks')->with('profile',function ($q){
                return $q->select('user_id','avatar','banner','address','longitude','latitude','votes','available_days','working_time','created_at','updated_at','total_experience','description','experiences','memberships','educations','awards','gender','sub_heading','wait_time','short_desc');
            })->with('specialities',function ($q){
                return $q->take(3);
            })->orderBy("trending","desc")->limit(4)->get();
        return response()->json($users);
    }
    // public function getArticlesPaginateData(Request $request)
    // {
    //     $page=(int)$request->query('page');
    //     $selectedCategory=$request->query('selected');
    //     $perPage = 8;
    //     if($selectedCategory !== 'null' && $selectedCategory !== null)
    //     {
    //         $articleCat=ArticleCategory::where('category_id',$selectedCategory)->limit(8)->pluck('article_id');
    //         $articles = Article::with('categories')
    //         ->whereIn('id',$articleCat)
    //         ->where('status', 'approved')
    //         ->with('author')
    //         ->latest()
    //         ->paginate($perPage, ['*'], 'page', $page);
    //     }
    //     else
    //     {
    //        $articles = Article::with('categories')
    //         ->where('status', 'approved')
    //         ->with('author')
    //         ->latest()
    //         ->paginate($perPage, ['*'], 'page', $page); 
    //     }

    //     return response()->json($articles);
        
    // }
    public function getArticlesPaginateData(Request $request)
{
    $page = (int)$request->query('page');
    $selectedCategory = $request->query('selected');
    $perPage = 8;
    $query = Article::with('categories')
        ->where('status', 'approved')
        ->with('author')
        ->latest();
    if ($selectedCategory !== 'null' && $selectedCategory !== null) {
        // $query->whereHas('categories', function ($query) use ($selectedCategory) {
        //     $query->where('category_id', $selectedCategory);
        // });
         
        $articleCat = ArticleCategory::where('category_id', $selectedCategory)->pluck('article_id');
        $query->whereIn('id', $articleCat);
    }
    $articles = $query->paginate($perPage, ['*'], 'page', $page);
    return response()->json($articles);
}
    public function getRecentAddedArticles()
    {
        // dd(1);
       $articles = Article::where('status','approved')->where('is_featured','1')->with('author')->with('categories')->latest()->get();
       // dd($articles);
       return response()->json($articles); 
    }
    public function getArticlesForSearched(Request $request,$value)
    {
        $value=$value;
        $articles = Article::with('categories')->where('title', 'like', '%' . $value . '%')->orWhere('short_description', 'like', '%' . $value . '%')->where('status','approved')->with('author')->latest()->limit(5)->get();
        return response()->json($articles);
        
    }

    /**
     * Show article detail.
     *
     * @param string $slug slug
     * 
     * @return \Illuminate\Http\Response
     */
    public function categoryDetail($slug)
    {
        if (!empty($slug)) {
            $category = Category::where('slug', $slug)->with('articles')->first();
             $categories = Category::with('articles')->with('subCategories')->get();
            $user_ = User::where('id', \Auth::id() ? Auth::id() : '')->with('profile')->with('roles')->first();
            $logged_user = $user_ ? $user_ : [];
        $doctors = User::role('doctor')->orderBy("trending","desc")->with('profile','specialities','location','feedbacks')->whereHas('profile', function ($query) {
    return $query->where('verify_registration', '=', 1);
})->limit(4)->get();
        /*Hospital*/
        $hospitals = User::role('hospital')->orderBy("trending","desc")->with('profile','location','area','feedbacks','teams')->limit(6)->get();
        /*Laboratory*/
        $laboratories = User::role('laboratory')->with('profile','location','area')->limit(6)->get();
        /*Specialities*/
        $specialities = Speciality::select('id','title','slug','image')->orderBy("created_at","asc")->limit(8)->get();
        /*Diseases*/
        $diseases = Disease::select('id','title', 'slug','flag')->limit(4)->get();
        /*Services*/
        $services = Service::select('id','title', 'slug','image')->limit(4)->get();
        $cities = Location::where('top', '1')->orderBy("created_at","asc")->limit(6)->get();
        $meta_values = ['header_service','show_headertabs','topbar_settings','general_settings','download_app_sec','home_slider','socials','footer_settings','subscribe_now_sec','list_doctor_inner_section','procedure_banner_section'];
        $managements = SiteManagement::whereIn('meta_key',$meta_values)->get();
        $segments = \Request::segments();
            return View(
                'front-end.articles.show',
                compact(
                    'categories',
                    'category',
                    'logged_user',
                    'laboratories',
                    'cities',
                    'services',
                    'diseases',
                    'specialities',
                    'hospitals',
                    'doctors',
                    'managements',
                    'segments'
                    
                )
            );
        } else {
            abort(404);
        }
    }
    public function articleDetailShareCount(Request $request,$id)
    {
        $article=Article::where('id',$id)->first();
        $totalShared= $article->total_shared;
        $article->total_shared = $totalShared + 1;
        $article->update();
        $totalShares=$article->total_shared;

        return response()->json($totalShares);
    }
    public function articleDetail($slug) {
        $article = Article::where('slug', $slug)->with('categories')->with('author')->first();
        // dd($article);
        $articles = Article::with('categories')->where('status','approved')->orderBy('views','desc')->with('author')->limit(5)->get();
        $view_artical =  $article->views;
           $increment_view = $view_artical + 1;
            Article::where('slug', $slug)->update([
                'views' => $increment_view
            ]);
        $user_ = User::where('id', \Auth::id() ? Auth::id() : '')->with('profile')->with('roles')->first();
        $logged_user = $user_ ? $user_ : [];

        $doctors = User::role('doctor')->orderBy("trending","desc")->with('profile','specialities','location','feedbacks')->limit(4)->get();
        /*Hospital*/
        $hospitals = User::role('hospital')->orderBy("trending","desc")->with('profile','location','area','feedbacks','teams')->limit(6)->get();
        /*Laboratory*/
        $laboratories = User::role('laboratory')->with('profile','location','area')->limit(6)->get();
        /*Specialities*/
        $specialities = Speciality::select('id','title','slug','image')->orderBy("created_at","asc")->limit(8)->get();
        /*Diseases*/
        $diseases = Disease::select('id','title', 'slug','flag')->limit(4)->get();
        /*Services*/
        $services = Service::select('id','title', 'slug','image')->limit(4)->get();
        $cities = Location::where('top', '1')->orderBy("created_at","asc")->limit(6)->get();
        $meta_values = ['header_service','show_headertabs','topbar_settings','general_settings','download_app_sec','home_slider','socials','footer_settings','subscribe_now_sec','list_doctor_inner_section','procedure_banner_section'];
        $managements = SiteManagement::whereIn('meta_key',$meta_values)->get();
        $segments = \Request::segments();
        $blogDetailGraph = Helper::blogDetailGraph($article);
        return View(
            'front-end.articles.detail',
            compact(
                'article',
                'articles',
                'logged_user',
                'laboratories',
                'cities',
                'services',
                'diseases',
                'specialities',
                'hospitals',
                'doctors',
                'managements',
                'segments'
                
            ));
    }

    public function articleProfileDetail($slug) {
        $user = User::where('slug', $slug)->with('articles')->with('profile')->first();
        $users = User::where('id', \Auth::id() ? Auth::id() : '')->with('profile')->with('roles')->first();
        $categories = Category::with('articles')->with('subCategories')->get();
        $logged_user = $users ? $users : [];

        $doctors = User::role('doctor')->orderBy("trending","desc")->with('profile','specialities','location','feedbacks')->whereHas('profile', function ($query) {
    return $query->where('verify_registration', '=', 1);
})->limit(4)->get();
        /*Hospital*/
        $hospitals = User::role('hospital')->orderBy("trending","desc")->with('profile','location','area','feedbacks','teams')->limit(6)->get();
        /*Laboratory*/
        $laboratories = User::role('laboratory')->with('profile','location','area')->limit(6)->get();
        /*Specialities*/
        $specialities = Speciality::select('id','title','slug','image')->orderBy("created_at","asc")->limit(8)->get();
        /*Diseases*/
        $diseases = Disease::select('id','title', 'slug','flag')->limit(4)->get();
        /*Services*/
        $services = Service::select('id','title', 'slug','image')->limit(4)->get();
        $cities = Location::where('top', '1')->orderBy("created_at","asc")->limit(6)->get();
        $meta_values = ['header_service','show_headertabs','topbar_settings','general_settings','download_app_sec','home_slider','socials','footer_settings','subscribe_now_sec','list_doctor_inner_section','procedure_banner_section'];
        $managements = SiteManagement::whereIn('meta_key',$meta_values)->get();
        $segments = \Request::segments();
        return view('front-end.articles.profile',
        compact(
            'logged_user', 'laboratories', 'cities', 'services', 'diseases',
            'specialities', 'hospitals', 'doctors', 'managements', 'user','segments','categories'
        ));
    }

    /**
     * Get home page section display settings
     *
     * @access public
     *
     * @return View
     */
    public function getFeaturedArticleSetting(Request $request)
    {
        $json = array();
        $slug =  $request['article_slug'];
        $is_featured = Article::select('is_featured')->where('slug', $slug)->pluck('is_featured')->first();
        if (!empty($is_featured)) {
            if ($is_featured ==  0) {
                $json['is_featured'] = false;
            } else {
                $json['is_featured'] = true;
            }
        }
        return $json;
    }

    /**
     * Get user's save article display on home page
     *
     * @access public
     *
     * @return View
     */
    public function likeArticle(Request $request) {
        $response = array();

        $article = Article::where('id', $request['id'])->first();
        $likes = $article->likes + 1;
        Article::where('id', $request['id'])->update(['likes' => $likes]);

        $user = User::where('id', Auth::id())->with('profile')->first();
        $saved_articles = json_decode($user->profile->saved_articles, true);

        if($saved_articles === null) {
            $saved_articles = [$request['id']];
            $saved_articles = json_encode($saved_articles);
            $response['type'] = 'success';
            $response['message'] = 'Article Liked';
        }
        else {
            if(in_array($request['id'], $saved_articles)) {
                $key = array_search($request['id'], $saved_articles);
                if ($key !== false) {
                    unset($saved_articles[$key]);
                }
                $saved_articles = json_encode($saved_articles);
                $response['type'] = 'remove';
                $response['message'] = 'Article removed from liked articles';
            }
            else {
                array_push($saved_articles, $request['id']);
                $saved_articles = json_encode($saved_articles);
                $response['type'] = 'success';
                $response['message'] = 'Article Liked';
            }
        }
        UserMeta::where('id', $user->profile->id)->update([
            'saved_articles' => $saved_articles
        ]);



        return $response;
    }

}
