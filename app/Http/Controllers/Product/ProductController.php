<?php

namespace App\Http\Controllers\Product;
use App\Http\Controllers\Controller;
use App\Providers\RouteServiceProvider;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Support\Facades\Hash;
use Illuminate\Http\Request;
use Socialite;
use Auth;
use Exception;
use App\User;
use App\Appointment;
use App\ProductCategory;
use App\Product;
use App\ProductAttribute;
use App\ProductOrder;
use App\ProductPriceType;
use App\ProductReview;
use App\ProductTag;
use App\ProductBrand;
use App\ProductTransaction;
use App\CategoryProduct;
use App\TagProduct;
use App\AttributeProduct;
use App\ProductPageSetting;
use App\Location;
use App\Article;
use App\Disease;
use App\Feedback;
use App\Helper;
use App\Service;
use App\SiteManagement;
use App\Speciality;
use App\Procedure;
use Spatie\Permission\Traits\HasRoles;
use Carbon\Carbon;
use Image;
use Session;
use DB;
use PDF;
use Illuminate\Support\Facades\URL;
use Illuminate\Support\Str;
use \Cache;

class ProductController extends Controller
{
   /*
   FrontEnd Product Functions Start
   */
   public function brandAndOfferProducts() {
      $todaydate = Carbon::now()->format('Y-m-d');
      $product_categories = ProductCategory::where('status',1)->select('id','name','status','slug')->latest()->limit(10)->get();
      $product_brands = ProductBrand::where('status',1)->latest()->limit(10)->get();
      $featured_products = Product::where('feature',1)->with('reviews')->latest()->limit(10)->get();
      $current_week_products = Product::whereBetween('price_start', 
                                    [Carbon::now()->startOfWeek(), Carbon::now()->endOfWeek()])
                                    ->with('reviews')
                                    ->latest()->limit(10)->get();
      $current_month_products = Product::whereBetween('price_start', 
                                       [Carbon::now()->startOfMonth(), Carbon::now()->endOfMonth()])
                                       ->with('reviews')
                                       ->latest()->limit(10)->get();
      $top_categories = ProductCategory::where('status',1)->where('top',1)
                                             ->select('id','name','status','slug')
                                             ->latest()
                                             ->get();
      $top_products = Product::where('status',1)->where('top',1)->select('id','name','slug')->latest()->get();
      $pageSetting = ProductPageSetting::first();
      $meta_values = ['header_service','show_headertabs','topbar_settings','general_settings','download_app_sec','home_slider','socials','footer_settings','subscribe_now_sec','home_doctor_sec','home_search_banner','small_devices_top_section'];
        /*Doctors*/
        $doctors = User::role('doctor')->with('profile','specialities','location')->limit(4)->get();
        /*Hospital*/
        $hospitals = User::role('hospital')->orderBy("trending","desc")->with('profile','location','area')->limit(6)->get();
        /*Laboratory*/
        $laboratories = User::role('laboratory')->orderBy("trending","desc")->with('profile','location','area')->limit(6)->get();
        /*Specialities*/
        $specialities = Speciality::select('id','title','slug','image','top','trending')->where('top', '1')->orderBy("created_at","asc")->limit(8)->get(); 
        /*Diseases*/
        $diseases = Disease::select('id','title', 'slug','flag','trending')->limit(4)->get();
        /*Services*/
        $services = Service::select('id','title', 'slug','image','trending')->limit(4)->get();
        /*Locations*/
        $cities = Location::with('specialities')->orderBy("created_at","asc")->limit(13)->get();
        // dd($cities);
        /*Blogs Section*/
        $articles = Article::where('is_featured', '1')->with('author','categories')->orderBy("created_at","desc")->limit(3)->get();
        /*Feedbacks*/
        $feedbacks = Feedback::with('patient')->where('approval', '1')->orderBy("created_at","asc")->limit(3)->get();
        /*All Procedure*/
        $procedures = Procedure::where('top', '1')->with('cities')->orderBy("created_at","asc")->limit(6)->get();
        $managements = SiteManagement::whereIn('meta_key',$meta_values)->get();
        
        $user = User::where('id', Auth::id() ? Auth::id() : '')->with('profile','roles')->first();
        $logged_user = $user ? $user : [];
      return view('front-end.product-home.product-home',compact('product_categories','product_brands','featured_products','current_week_products','current_month_products','top_categories','top_products','pageSetting','specialities', 'services', 'cities', 'diseases', 'doctors', 'hospitals', 'laboratories','articles', 'feedbacks','procedures','managements', 'logged_user'));
   }
   public function index()
    {
      $meta_values = ['header_service','show_headertabs','topbar_settings','general_settings','download_app_sec','home_slider','socials','footer_settings','subscribe_now_sec','home_doctor_sec','home_search_banner','small_devices_top_section'];
        /*Doctors*/
        $doctors = User::role('doctor')->with('profile','specialities','location')->limit(4)->get();
        /*Hospital*/
        $hospitals = User::role('hospital')->orderBy("trending","desc")->with('profile','location','area')->limit(6)->get();
        /*Laboratory*/
        $laboratories = User::role('laboratory')->orderBy("trending","desc")->with('profile','location','area')->limit(6)->get();
        /*Specialities*/
        $specialities = Speciality::select('id','title','slug','image','top','trending')->where('top', '1')->orderBy("created_at","asc")->limit(8)->get(); 
        /*Diseases*/
        $diseases = Disease::select('id','title', 'slug','flag','trending')->limit(4)->get();
        /*Services*/
        $services = Service::select('id','title', 'slug','image','trending')->limit(4)->get();
        /*Locations*/
        $cities = Location::orderBy("created_at","asc")->limit(13)->get();
        // dd($cities);
        /*Blogs Section*/
        $articles = Article::where('is_featured', '1')->with('author','categories')->orderBy("created_at","desc")->limit(3)->get();
        /*Feedbacks*/
        $feedbacks = Feedback::with('patient')->where('approval', '1')->orderBy("created_at","asc")->limit(3)->get();
        /*All Procedure*/
        $procedures = Procedure::where('top', '1')->with('cities')->orderBy("created_at","asc")->limit(6)->get();
        $managements = SiteManagement::whereIn('meta_key',$meta_values)->get();
        
        $user = User::where('id', Auth::id() ? Auth::id() : '')->with('profile','roles')->first();
        $logged_user = $user ? $user : [];
         $product_categories = ProductCategory::where('status',1)->select('id','name','status','slug')->latest()->limit(10)->get();
      $product_brands = ProductBrand::where('status',1)->latest()->limit(10)->get();
      $products = Product::where('status',1)
                                 ->with('brand','attributes','tags','categories','reviews')
                                 ->latest()
                                 ->paginate(12);
      if(count($products)>0){
         $min_price = collect(Product::where('status',1)->get())->min('price');
         $max_price = collect(Product::where('status',1)->get())->max('price');
      }else{
         $max_price = 2000;
         $min_price = 0;
      }
      $top_categories = ProductCategory::where('status',1)->where('top',1)
                                             ->select('id','name','status','slug')
                                             ->latest()
                                             ->get();
      $top_products = Product::where('status',1)->where('top',1)->select('id','name','slug')->latest()->get();
      $pageSetting = ProductPageSetting::first();
      $cities = Location::get();
         return view('front-end.product-all.product-all',compact('product_categories','product_brands','products','top_categories','top_products','pageSetting','max_price','min_price','specialities', 'services', 'cities','diseases', 'doctors', 'hospitals','laboratories','articles','feedbacks','procedures','managements','logged_user'));
    }
    public function filterCategoryProducts($filter_id,$category,$query) {
      // 0 for All Products
      if ((int)$filter_id == 0) {
         $products = Product::where('status',1)
                                 ->whereJsonContains('product_category_id',(int)$category)
                                 ->with('brand','attributes','tags','categories','reviews')
                                 ->latest()
                                 ->paginate(12);
      }
      // 1 for Featured
      if ((int)$filter_id == 1) {
         $products = Product::where(['status'=>1,'feature'=>1])
                                 ->whereJsonContains('product_category_id',(int)$category)
                                 ->with('brand','attributes','tags','categories','reviews')
                                 ->latest()
                                 ->paginate(12);
      }
      // 2 for Alphabetically, A-Z
      if ((int)$filter_id == 2) {
         $products = Product::where('status',1)
                                 ->whereJsonContains('product_category_id',(int)$category)
                                 ->orderBy('name', 'ASC')
                                 ->with('brand','attributes','tags','categories','reviews')
                                 ->latest()
                                 ->paginate(12);
      }
      // 3 for Alphabetically, Z-A
      if ((int)$filter_id == 3) {
         $products = Product::where('status',1)
                                 ->whereJsonContains('product_category_id',(int)$category)
                                 ->orderBy('name', 'DESC')
                                 ->with('brand','attributes','tags','categories','reviews')
                                 ->latest()
                                 ->paginate(12);
      }
      // 4 for Price, low to high
      if ((int)$filter_id == 4) {
         $products = Product::where('status',1)
                                 ->whereJsonContains('product_category_id',(int)$category)
                                 ->orderBy('price', 'ASC')
                                 ->with('brand','attributes','tags','categories','reviews')
                                 ->latest()
                                 ->paginate(12);
      }
      // 5 for Price, high to low
      if ((int)$filter_id == 5) {
         $products = Product::where('status',1)
                                 ->whereJsonContains('product_category_id',(int)$category)
                                 ->orderBy('price', 'DESC')
                                 ->with('brand','attributes','tags','categories','reviews')
                                 ->latest()
                                 ->paginate(12);
      }
      return response()->json($products);
    }
    public function filterProducts($filter_id,$query) {
      // 0 for All Products
      if ((int)$filter_id == 0) {
         $products = Product::where('status',1)
                                 ->with('brand','attributes','tags','categories','reviews')
                                 ->latest()
                                 ->paginate(12);
      }
      // 1 for Featured
      if ((int)$filter_id == 1) {
         $products = Product::where(['status'=>1,'feature'=>1])
                                 ->with('brand','attributes','tags','categories','reviews')
                                 ->latest()
                                 ->paginate(12);
      }
      // 2 for Alphabetically, A-Z
      if ((int)$filter_id == 2) {
         $products = Product::where('status',1)
                                 ->orderBy('name', 'ASC')
                                 ->with('brand','attributes','tags','categories','reviews')
                                 ->latest()
                                 ->paginate(12);
      }
      // 3 for Alphabetically, Z-A
      if ((int)$filter_id == 3) {
         $products = Product::where('status',1)
                                 ->orderBy('name', 'DESC')
                                 ->with('brand','attributes','tags','categories','reviews')
                                 ->latest()
                                 ->paginate(12);
      }
      // 4 for Price, low to high
      if ((int)$filter_id == 4) {
         $products = Product::where('status',1)
                                 ->orderBy('price', 'ASC')
                                 ->with('brand','attributes','tags','categories','reviews')
                                 ->latest()
                                 ->paginate(12);
      }
      // 5 for Price, high to low
      if ((int)$filter_id == 5) {
         $products = Product::where('status',1)
                                 ->orderBy('price', 'DESC')
                                 ->with('brand','attributes','tags','categories','reviews')
                                 ->latest()
                                 ->paginate(12);
      }
      return response()->json($products);
    }
    public function filterBrandProducts($filter_id,$brand,$query) {
      // 0 for All Products
      if ((int)$filter_id == 0) {
         $products = Product::where(['product_brand_id'=>$brand,'status'=>1])
                                 ->with('brand','attributes','tags','categories','reviews')
                                 ->latest()
                                 ->paginate(12);
      }
      // 1 for Featured
      if ((int)$filter_id == 1) {
         $products = Product::where(['product_brand_id'=>$brand,'status'=>1,'feature'=>1])
                                 ->with('brand','attributes','tags','categories','reviews')
                                 ->latest()
                                 ->paginate(12);
      }
      // 2 for Alphabetically, A-Z
      if ((int)$filter_id == 2) {
         $products = Product::where(['product_brand_id'=>$brand,'status'=>1])
                                 ->orderBy('name', 'ASC')
                                 ->with('brand','attributes','tags','categories','reviews')
                                 ->latest()
                                 ->paginate(12);
      }
      // 3 for Alphabetically, Z-A
      if ((int)$filter_id == 3) {
         $products = Product::where(['product_brand_id'=>$brand,'status'=>1])
                                 ->orderBy('name', 'DESC')
                                 ->with('brand','attributes','tags','categories','reviews')
                                 ->latest()
                                 ->paginate(12);
      }
      // 4 for Price, low to high
      if ((int)$filter_id == 4) {
         $products = Product::where(['product_brand_id'=>$brand,'status'=>1])
                                 ->orderBy('price', 'ASC')
                                 ->with('brand','attributes','tags','categories','reviews')
                                 ->latest()
                                 ->paginate(12);
      }
      // 5 for Price, high to low
      if ((int)$filter_id == 5) {
         $products = Product::where(['product_brand_id'=>$brand,'status'=>1])
                                 ->orderBy('price', 'DESC')
                                 ->with('brand','attributes','tags','categories','reviews')
                                 ->latest()
                                 ->paginate(12);
      }
      return response()->json($products);
    }
    public function productDetail($product_slug)
    {
      $product = Product::where('slug',$product_slug)
                        ->with('brand','attributes','tags','categories','reviews','review_rating')
                        ->first();
      // dd($product);
       $similarProducts = Product::whereJsonContains('product_category_id', $product->product_category_id)
                                 ->with('brand','attributes','tags','categories','reviews')
                                 ->get();
      $meta_values = ['header_service','show_headertabs','topbar_settings','general_settings','download_app_sec','home_slider','socials','footer_settings','subscribe_now_sec','home_doctor_sec','home_search_banner','small_devices_top_section'];
        /*Doctors*/
        $doctors = User::role('doctor')->with('profile','specialities','location')->limit(4)->get();
        /*Hospital*/
        $hospitals = User::role('hospital')->orderBy("trending","desc")->with('profile','location','area')->limit(6)->get();
        /*Laboratory*/
        $laboratories = User::role('laboratory')->orderBy("trending","desc")->with('profile','location','area')->limit(6)->get();
        /*Specialities*/
        $specialities = Speciality::select('id','title','slug','image','top','trending')->where('top', '1')->orderBy("created_at","asc")->limit(8)->get(); 
        /*Diseases*/
        $diseases = Disease::select('id','title', 'slug','flag','trending')->limit(4)->get();
        /*Services*/
        $services = Service::select('id','title', 'slug','image','trending')->limit(4)->get();
        /*Locations*/
        $cities = Location::with('specialities')->orderBy("created_at","asc")->limit(13)->get();
        // dd($cities);
        /*Blogs Section*/
        $articles = Article::where('is_featured', '1')->with('author','categories')->orderBy("created_at","desc")->limit(3)->get();
        /*Feedbacks*/
        $feedbacks = Feedback::with('patient')->where('approval', '1')->orderBy("created_at","asc")->limit(3)->get();
        /*All Procedure*/
        $procedures = Procedure::where('top', '1')->with('cities')->orderBy("created_at","asc")->limit(6)->get();
        $managements = SiteManagement::whereIn('meta_key',$meta_values)->get();
        
        $user = User::where('id', Auth::id() ? Auth::id() : '')->with('profile','roles')->first();
        $logged_user = $user ? $user : [];
       return view('front-end.product-detail.product-detail',compact('product','similarProducts','specialities', 'services', 'cities', 'diseases', 'doctors', 'hospitals', 'laboratories','articles', 'feedbacks','procedures','managements', 'logged_user'));
    }
    public function categoryListProduct($category_slug)
    {
      $category = ProductCategory::where('slug',$category_slug)->select('id')->first();
      $products = Product::whereJsonContains('product_category_id',$category->id)
                                 ->with('brand','attributes','tags','categories','reviews')
                                 ->latest()
                                 ->paginate(10);
      $allCategories = ProductCategory::where('status',1)->limit(5)->get();
      $current_category = ProductCategory::where('id',$category->id)->where('status',1)->first();
      $cities = Location::get();
      $brands = ProductBrand::where('status',1)->limit(5)->get();
      $top_categories = ProductCategory::where('status',1)->where('top',1)
                                             ->select('id','name','status','slug')
                                             ->latest()
                                             ->get();
      if(count($products)>0){
         $min_price = collect(Product::whereJsonContains('product_category_id',$category->id)->where('status',1)->get())->min('price');
         $max_price = collect(Product::whereJsonContains('product_category_id',$category->id)->where('status',1)->get())->max('price');
      }else{
         $max_price = 2000;
         $min_price = 0;
      }                                      
      $top_products = Product::where('status',1)->where('top',1)->select('id','name','slug')->latest()->get();
      $meta_values = ['header_service','show_headertabs','topbar_settings','general_settings','download_app_sec','home_slider','socials','footer_settings','subscribe_now_sec','home_doctor_sec','home_search_banner','small_devices_top_section'];
        /*Doctors*/
        $doctors = User::role('doctor')->with('profile','specialities','location')->limit(4)->get();
        /*Hospital*/
        $hospitals = User::role('hospital')->orderBy("trending","desc")->with('profile','location','area')->limit(6)->get();
        /*Laboratory*/
        $laboratories = User::role('laboratory')->orderBy("trending","desc")->with('profile','location','area')->limit(6)->get();
        /*Specialities*/
        $specialities = Speciality::select('id','title','slug','image','top','trending')->where('top', '1')->orderBy("created_at","asc")->limit(8)->get(); 
        /*Diseases*/
        $diseases = Disease::select('id','title', 'slug','flag','trending')->limit(4)->get();
        /*Services*/
        $services = Service::select('id','title', 'slug','image','trending')->limit(4)->get();
        /*Locations*/
        $cities = Location::with('specialities')->orderBy("created_at","asc")->limit(13)->get();
        // dd($cities);
        /*Blogs Section*/
        $articles = Article::where('is_featured', '1')->with('author','categories')->orderBy("created_at","desc")->limit(3)->get();
        /*Feedbacks*/
        $feedbacks = Feedback::with('patient')->where('approval', '1')->orderBy("created_at","asc")->limit(3)->get();
        /*All Procedure*/
        $procedures = Procedure::where('top', '1')->with('cities')->orderBy("created_at","asc")->limit(6)->get();
        $managements = SiteManagement::whereIn('meta_key',$meta_values)->get();
        
        $user = User::where('id', Auth::id() ? Auth::id() : '')->with('profile','roles')->first();
        $logged_user = $user ? $user : [];
      return view('front-end.product-listing.product-listing',compact('products','allCategories','current_category','cities','brands','top_categories','top_products','min_price','max_price','specialities', 'services', 'cities', 'diseases', 'doctors', 'hospitals', 'laboratories','articles', 'feedbacks','procedures','managements', 'logged_user'));
    }
    public function categoryListProductPaginate($category_id)
    {
      $products = Product::whereJsonContains('product_category_id',(int)$category_id)
                                 ->with('brand','attributes','tags','categories','reviews')
                                 ->latest()
                                 ->paginate(10);
      return response()->json($products);
    }
    public function brandListProduct($brand_slug)
    {
       $meta_values = ['header_service','show_headertabs','topbar_settings','general_settings','download_app_sec','home_slider','socials','footer_settings','subscribe_now_sec','home_doctor_sec','home_search_banner','small_devices_top_section'];
        /*Doctors*/
        $doctors = User::role('doctor')->with('profile','specialities','location')->limit(4)->get();
        /*Hospital*/
        $hospitals = User::role('hospital')->orderBy("trending","desc")->with('profile','location','area')->limit(6)->get();
        /*Laboratory*/
        $laboratories = User::role('laboratory')->orderBy("trending","desc")->with('profile','location','area')->limit(6)->get();
        /*Specialities*/
        $specialities = Speciality::select('id','title','slug','image','top','trending')->where('top', '1')->orderBy("created_at","asc")->limit(8)->get(); 
        /*Diseases*/
        $diseases = Disease::select('id','title', 'slug','flag','trending')->limit(4)->get();
        /*Services*/
        $services = Service::select('id','title', 'slug','image','trending')->limit(4)->get();
        /*Locations*/
        $cities = Location::with('specialities')->orderBy("created_at","asc")->limit(13)->get();
        // dd($cities);
        /*Blogs Section*/
        $articles = Article::where('is_featured', '1')->with('author','categories')->orderBy("created_at","desc")->limit(3)->get();
        /*Feedbacks*/
        $feedbacks = Feedback::with('patient')->where('approval', '1')->orderBy("created_at","asc")->limit(3)->get();
        /*All Procedure*/
        $procedures = Procedure::where('top', '1')->with('cities')->orderBy("created_at","asc")->limit(6)->get();
        $managements = SiteManagement::whereIn('meta_key',$meta_values)->get();
        
        $user = User::where('id', Auth::id() ? Auth::id() : '')->with('profile','roles')->first();
        $logged_user = $user ? $user : [];
      $brand = ProductBrand::where('slug',$brand_slug)->select('id')->first();
      $products = Product::where('product_brand_id',$brand->id)
                                 ->with('brand','attributes','tags','categories','reviews')
                                 ->latest()
                                 ->paginate(10);
      $allCategories = ProductCategory::where('status',1)->limit(5)->get();
      $current_brand = ProductBrand::where('id',$brand->id)->where('status',1)->first();
      $cities = Location::get();
      $brands = ProductBrand::where('status',1)->limit(5)->get();
      $top_categories = ProductCategory::where('status',1)->where('top',1)
                                             ->select('id','name','status','slug')
                                             ->latest()
                                             ->get();
      if(count($products)>0){
         $min_price = collect(Product::where('product_brand_id',$brand->id)->where('status',1)->get())->min('price');
         $max_price = collect(Product::where('product_brand_id',$brand->id)->where('status',1)->get())->max('price');
      }else{
         $max_price = 2000;
         $min_price = 0;
      }
      $top_products = Product::where('status',1)->where('top',1)->select('id','name','slug')->latest()->get();
      return view('front-end.product-brand.product-brand',compact('products','allCategories','current_brand','cities','brands','top_categories','top_products','min_price','max_price','specialities', 'services', 'cities', 'diseases', 'doctors', 'hospitals', 'laboratories','articles', 'feedbacks','procedures','managements', 'logged_user'));
    }
    public function brandListProductPaginate($brand_id)
    {
      $products = Product::where('product_brand_id',$brand_id)
                                 ->with('brand','attributes','tags','categories','reviews')
                                 ->latest()
                                 ->paginate(10);
      return response()->json($products);
    }
    public function checkoutProduct()
    {
      $meta_values = ['header_service','show_headertabs','topbar_settings','general_settings','download_app_sec','home_slider','socials','footer_settings','subscribe_now_sec','home_doctor_sec','home_search_banner','small_devices_top_section'];
        /*Doctors*/
        $doctors = User::role('doctor')->with('profile','specialities','location')->limit(4)->get();
        /*Hospital*/
        $hospitals = User::role('hospital')->orderBy("trending","desc")->with('profile','location','area')->limit(6)->get();
        /*Laboratory*/
        $laboratories = User::role('laboratory')->orderBy("trending","desc")->with('profile','location','area')->limit(6)->get();
        /*Specialities*/
        $specialities = Speciality::select('id','title','slug','image','top','trending')->where('top', '1')->orderBy("created_at","asc")->limit(8)->get(); 
        /*Diseases*/
        $diseases = Disease::select('id','title', 'slug','flag','trending')->limit(4)->get();
        /*Services*/
        $services = Service::select('id','title', 'slug','image','trending')->limit(4)->get();
        /*Locations*/
        $cities = Location::with('specialities')->orderBy("created_at","asc")->limit(13)->get();
        // dd($cities);
        /*Blogs Section*/
        $articles = Article::where('is_featured', '1')->with('author','categories')->orderBy("created_at","desc")->limit(3)->get();
        /*Feedbacks*/
        $feedbacks = Feedback::with('patient')->where('approval', '1')->orderBy("created_at","asc")->limit(3)->get();
        /*All Procedure*/
        $procedures = Procedure::where('top', '1')->with('cities')->orderBy("created_at","asc")->limit(6)->get();
        $managements = SiteManagement::whereIn('meta_key',$meta_values)->get();
        
        $user = User::where('id', Auth::id() ? Auth::id() : '')->with('profile','roles')->first();
        $logged_user = $user ? $user : [];
      return view('front-end.product-checkout.product-checkout',compact('specialities', 'services', 'cities', 'diseases', 'doctors', 'hospitals', 'laboratories','articles', 'feedbacks','procedures','managements', 'logged_user'));
    }
    public function getMoreCategories($count)
    {
      $allCategories = ProductCategory::where('status',1)->limit((int)$count)->get();
      return response()->json([
         'message' => 'More categories Get',
         'status' => "success",
         'statusCode' => 200,
         'categories' => $allCategories
      ]);
    }
    public function getMoreBrands($count)
    {
      $allBrands = ProductBrand::where('status',1)->limit((int)$count)->get();
      return response()->json([
         'message' => 'More Brands Get',
         'status' => "success",
         'statusCode' => 200,
         'brands' => $allBrands
      ]);
    }
    public function getProductWithinPrice(Request $request)
    {
        if($request->exists('category_id')){
            $products = Product::where('status',1)
                                 ->whereJsonContains('product_category_id',(int)$request->category_id)
                                 ->where('price',">=",(int)$request->priceStart)
                                 ->where('price',"<=",(int)$request->priceEnd)
                                 ->with('brand','attributes','tags','categories','reviews')
                                 ->latest()
                                 ->paginate(10);
        }else{
            $products = Product::where('status',1)
                                 ->where('product_brand_id',(int)$request->brand_id)
                                 ->where('price',">=",(int)$request->priceStart)
                                 ->where('price',"<=",(int)$request->priceEnd)
                                 ->with('brand','attributes','tags','categories','reviews')
                                 ->latest()
                                 ->paginate(10);
        }
          return response()->json([
             'message' => "Range Price Products Get",
             'status' => 'success',
             'statusCode' => 200,
             'products' => $products
          ]);
    }
    public function getSearchCategory($query)
    {
      $category = ProductCategory::where('status',1)->select('id','name','slug')->where('name','LIKE','%'.$query.'%')->get();
      $product = Product::where('status',1)->select('id','name','slug')->where('name','LIKE','%'.$query.'%')->get();
      return response()->json([
         'message' => "Search result Fetched",
         'status' => 'success',
         'statusCode' => 200,
         'category' => $category,
         'product' => $product,
      ]);
    }
    public function saveProductReview(Request $request)
    {
      $order = ProductOrder::where('client_id',$request->login_user_id)->select('cart')->get();
      $review = ProductReview::where('user_id',$request->login_user_id)->where('product_id',$request->product_id)->first();
      if(count($order)>0){
         if($review){
            return response()->json([
               'message' => "Your Already Reviewed on This Product",
               'status' => 'success',
               'statusCode' => 200
            ]);   
         }else{
            $exist = false;
            for($i = 0; $i < count($order); $i++){
               $value = collect($order[$i]['cart'])->contains('id',(int)$request->product_id);
               $exist = $value;
            }
            if($exist){
               $review = new ProductReview();
               $review->product_id = $request->product_id;
               $review->user_id = $request->login_user_id;
               $review->message = $request->message;
               $review->reviewer_name = $request->reviewer_name;
               $review->rating = $request->rating;
               $review->status = 0;
               $review->save();
               return response()->json([
                  'message' => "Thanks for Giving Review.",
                  'status' => 'success',
                  'statusCode' => 200
               ]);
            }else{
               return response()->json([
                  'message' => "You Haven't Purchase this Product Yet",
                  'status' => 'success',
                  'statusCode' => 200
               ]);
            }
         }
      }else{
         return response()->json([
            'message' => "You Haven't Purchase this Product Yet",
            'status' => 'success',
            'statusCode' => 200
         ]);
      }
    }
    /*
      FrontEnd Product Functions End
   */

    public function saveProductCategory(Request $request)
    {
      $product=new ProductCategory;
      $product->name=$request->name;
      $product->slug=str_replace(' ', '-', $request->name).'-'.rand(11000,11111100);
      $product->seo_title=$request->seo_title;
      $product->seo_description=$request->seo_description;
      $product->seo_keyword=$request->seo_keyword;
      $product->slug=$request->slug;
      if($request->hasFile('additionalImg')){
              //dd($request);
              $imageName = $request->additionalImg->getClientOriginalName();
              $request->additionalImg->move(public_path('uploads/product_category'), $imageName);
              $product->banner=$imageName;
            } 
      if($request->hasFile('baseImg')){
              //dd($request);
              $imageName = $request->baseImg->getClientOriginalName();
              $request->baseImg->move(public_path('uploads/product_category'), $imageName);
              $product->logo=$imageName;
            }
       if($request->has('status'))
       {
          $product->status=$request->status;
       }
       $product->save();
       return response()->json('Product category saved');
    }
    public function updateProductCategory(Request $request,$id)
    {
      $product=ProductCategory::where('id',$id)->first();
      $product->name=$request->name;
      $product->seo_title=$request->seo_title;
      $product->seo_description=$request->seo_description;
      $product->seo_keyword=$request->seo_keyword;
      $product->slug=$request->slug;
      if($request->hasFile('banner')){
              //dd($request);
              $imageName = $request->banner->getClientOriginalName();
              $request->banner->move(public_path('uploads/product_category'), $imageName);
              $product->banner=$imageName;
            } 
      if($request->hasFile('logo')){
              //dd($request);
              $imageName = $request->logo->getClientOriginalName();
              $request->logo->move(public_path('uploads/product_category'), $imageName);
              $product->logo=$imageName;
            }
       if($request->has('status'))
       {
          $product->status=$request->status;
       }
       // dd($product);
       $product->update();
       return response()->json('Product category Updated');
    }
    public function getAllProductsCategory()
    {
        $product=ProductCategory::get();
        return response()->json($product);
    }
    public function getAllProductSetting()
    {
      $setting=ProductPageSetting::get();
      return response()->json($setting);
    }
    public function saveProductPageSetting(Request $request)
    {
       $id = 1;
       $setting = ProductPageSetting::find($id);
       if(!$setting){
         $setting = new ProductPageSetting();
       }
       if($request->hasFile('banner_image')){
         $imageBanner = $request->banner_image->getClientOriginalName();
         $request->banner_image->move(public_path('uploads/productsetting'), $imageBanner);
         $setting->banner_image = $imageBanner;
       }
       if($request->hasFile('category_banner_image')){
         $imageCategoryBanner = $request->category_banner_image->getClientOriginalName();
         $request->category_banner_image->move(public_path('uploads/productsetting'), $imageCategoryBanner);
         $setting->category_banner_image = $imageCategoryBanner;
       }
       if($request->hasFile('favourite_product_image')){
         $imageFavouriteBanner = $request->favourite_product_image->getClientOriginalName();
         $request->favourite_product_image->move(public_path('uploads/productsetting'), $imageFavouriteBanner);
         $setting->favourite_product_image = $imageFavouriteBanner;
       }
       if($request->hasFile('call_center_logo')){
         $imageCallCenter = $request->call_center_logo->getClientOriginalName();
         $request->call_center_logo->move(public_path('uploads/productsetting'), $imageCallCenter);
         $setting->call_center_logo = $imageCallCenter;
       }
       if($request->hasFile('shop_confidence_logo')){
         $imageShopConfidence = $request->shop_confidence_logo->getClientOriginalName();
         $request->shop_confidence_logo->move(public_path('uploads/productsetting'), $imageShopConfidence);
         $setting->shop_confidence_logo = $imageShopConfidence;
       }
       if($request->hasFile('safe_payment_logo')){
         $imageSafePayment = $request->safe_payment_logo->getClientOriginalName();
         $request->safe_payment_logo->move(public_path('uploads/productsetting'), $imageSafePayment);
         $setting->safe_payment_logo = $imageSafePayment;
       }
       if($request->hasFile('deliver_all_logo')){
         $imageDeliverAll = $request->deliver_all_logo->getClientOriginalName();
         $request->deliver_all_logo->move(public_path('uploads/productsetting'), $imageDeliverAll);
         $setting->deliver_all_logo = $imageDeliverAll;
       }
       $setting->brand_heading = $request->brand_heading;
       $setting->feature_heading = $request->feature_heading;
       $setting->monthly_offer_heading = $request->monthly_offer_heading;
       $setting->weekly_offer_heading = $request->weekly_offer_heading;
       $setting->favourite_product_text = $request->favourite_product_text;
       $setting->call_center_heading = $request->call_center_heading;
       $setting->call_center_text = $request->call_center_text;
       $setting->shop_confidence_heading = $request->shop_confidence_heading;
       $setting->shop_confidence_text = $request->shop_confidence_text;
       $setting->safe_payment_heading = $request->safe_payment_heading;
       $setting->safe_payment_text = $request->safe_payment_text;
       $setting->deliver_all_heading = $request->deliver_all_heading;
       $setting->deliver_all_text = $request->deliver_all_text;
       $setting->product_seo_title = $request->product_seo_title;
       $setting->product_seo_keyword = $request->product_seo_keyword;
       $setting->product_seo_description = $request->product_seo_description;
       $setting->save();
      return response()->json([
         'status' => 'success',
         'statusCode' => 200,
         'message' => 'Setting Updated Successfully'
      ]);
    }
    public function enableProductCategory($id)
    {
        $productCategory=ProductCategory::where('id',$id)->update(['status'=>1]);
       return response()->json('Product category Enabled Successfully');
    }
    public function disableProductCategory($id)
    {
        $productCategory=ProductCategory::where('id',$id)->update(['status'=>0]);
       return response()->json('Product category Disabled Successfully');
    }
    public function deleteProductCategory($id)
    {
        ProductCategory::where('id',$id)->delete();
       return response()->json('Product category Disabled Successfully');
    }
    public function getAllBrands()
    {
        $brands=ProductBrand::get();
        return response()->json($brands);
    }
    public function saveBrand(Request $request)
    {
        $brand=new ProductBrand;
         if($request->has('name'))
         {
            $brand->name=$request->name;
            $brand->slug=str_replace(' ', '-', $request->name).'-'.rand(11000,11111100);
         }
          if($request->has('status'))
         {
            $brand->status=$request->status;
         }
         if($request->hasFile('logo')){
              //dd($request);
              $imageName = $request->logo->getClientOriginalName();
              $request->logo->move(public_path('uploads/brands'), $imageName);
              $brand->logo=$imageName;
            }
            if($request->hasFile('banner')){
              //dd($request);
              $imageName = $request->banner->getClientOriginalName();
              $request->banner->move(public_path('uploads/brands'), $imageName);
              $brand->banner=$imageName;
            }
            if($request->has('meta_title'))
         {
            $brand->meta_title=$request->meta_title;
         }
         if($request->has('meta_description'))
         {
            $brand->meta_description=$request->meta_description;
         }
         if($request->has('meta_key'))
         {
            $brand->meta_key=$request->meta_key;
         }
         $brand->save();
         return response()->json('Brand Saved Successfully');

    }
    public function disableBrand($id)
    {
        $brand=ProductBrand::where('id',$id)->update(['status'=>0]);
       return response()->json('Brand Disabled Successfully');
    }
     public function enableBrand($id)
    {
        $brand=ProductBrand::where('id',$id)->update(['status'=>1]);
       return response()->json('Brand Enabled Successfully');
    }
    public function deleteBrand($id)
    {
        ProductBrand::where('id',$id)->delete();
       return response()->json('Brand Deleted Successfully');
    }
    public function updateBrand(Request $request,$id)
    {
         $brand=ProductBrand::where('id',$id)->first();
         // dd($brand);
         if($request->has('name'))
         {
            $brand->name=$request->name;
         }
          if($request->has('status'))
         {
            $brand->status=$request->status;
         }
         if($request->hasFile('logo')){
              //dd($request);
              $imageName = $request->logo->getClientOriginalName();
              $request->logo->move(public_path('uploads/brands'), $imageName);
              $brand->logo=$imageName;
            }
            if($request->hasFile('banner')){
              //dd($request);
              $imageName = $request->banner->getClientOriginalName();
              $request->banner->move(public_path('uploads/brands'), $imageName);
              $brand->banner=$imageName;
            }
            if($request->has('meta_title'))
         {
            $brand->meta_title=$request->meta_title;
         }
         if($request->has('meta_description'))
         {
            $brand->meta_description=$request->meta_description;
         }
         if($request->has('meta_key'))
         {
            $brand->meta_key=$request->meta_key;
         }
         // dd($brand);
         $brand->update();
         return response()->json('Brand Updated Successfully');
    }
    public function saveTag(Request $request)
    {
        $tag=new ProductTag;
        $tag->name=$request->name;
        $tag->save();
        return response()->json('Tag Saved Successfully');

    }
    public function getAllTags()
    {
        $tag=ProductTag::get();
        return response()->json($tag);
    }
    public function updateTag(Request $request,$id)
    {
        $tag=ProductTag::where('id',$id)->first();
        $tag->name=$request->name;
        $tag->update();
        return response()->json('Tag Updated Successfully');
    }
    public function deleteProductTag($id)
    {
        ProductTag::where('id',$id)->delete();
       return response()->json('Tag Deleted Successfully');
    }

    //Attribute
   public function getAllProductAttribute()
   {
      $attributes=ProductAttribute::get();
      return response()->json($attributes);
   }
   public function getProductAttribute($id)
   {
      $attribute = ProductAttribute::where('id',(int)$id)->first();
      $categories = ProductCategory::select('id','name','status')->get();
      return response()->json([$attribute,$categories]);
   }
   public function deleteProductAttribute($id)
   {
      ProductAttribute::where('id',(int)$id)->delete();
      return response()->json('Attribute Deleted Successfully');
   }
   public function saveProductAttributeGeneral(Request $request)
   {
      if($request->has('attribute_id')){
         $attributegeneral = ProductAttribute::find((int)$request->attribute_id);
         $attributegeneral->name = $request->name;
         $attributegeneral->status =$request->status=="true"?1:0;
         $attributegeneral->categories = json_decode($request->categories);
         $attributegeneral->update();
         return response()->json([
            'message' => 'Attribute Updated Successfully',
            'status' => 'success',
            'statusCode' => 200
         ]);
      }else{
         $attributegeneral = new ProductAttribute();
         $attributegeneral->name = $request->name;
         $attributegeneral->status =$request->status=="true"?1:0;
         $attributegeneral->categories = json_decode($request->categories);
         $attributegeneral->save();
         return response()->json([
            'message' => 'Attribute Created Successfully',
            'status' => 'success',
            'statusCode' => 200,
            'id' => $attributegeneral->id
         ]);
      }
   }
   public function saveProductAttributeValue(Request $request)
   {
      $values = json_decode($request->values);
      if(count($values)>0){
         $attribute = ProductAttribute::find((int)$request->attribute_id);
         $attribute->values = $values;
         $attribute->update();
         return response()->json([
            'message' => 'Attribute Value Updated Successfully',
            'status' => 'success',
            'statusCode' => 200,
         ]);
      }else{
         return response()->json([
            'message' => 'Please add atleast one value',
            'status' => 'error',
            'statusCode' => 401,
         ]);
      }
   }

   ////////////////////////////////Admin Products//////////////////////////
   public function getAllProduct()
   {
      $products = Product::with(['tags','categories','attributes','brand'])->latest()->get();
      return response()->json($products);
   }
   public function getProduct($id)
   {
      $products = Product::where('id',(int)$id)->with(['tags','categories','attributes','brand'])->first();
      return response()->json($products);
   }
   public function getProductDetail()
   {
      $categories = ProductCategory::where('status',1)->select('id','name','status')->get();
      $brands = ProductBrand::where('status',1)->select('id','name','status')->get();
      $tags = ProductTag::get();
      $price_type = ProductPriceType::get();
      $attributes = ProductAttribute::get();
      return response()->json([
         'categories' => $categories,
         'brands' => $brands,
         'tags' => $tags,
         'price_type' => $price_type,
         'attributes' => $attributes
      ]);
   }
   public function getAttributeValue($id)
   {
      $attribute = ProductAttribute::where('id',(int)$id)->select('id','name','values')->first();
      return response()->json($attribute);
   }
   public function saveProductGeneral(Request $request)
   {
      if($request->has('product_id')){
         $product = Product::find((int)$request->product_id);
         $product->name = $request->name;
         $product->manufacturer_name = $request->manufacturer_name;
         $product->description = $request->description;
         $product->product_brand_id = $request->product_brand_id;
         $product->status = $request->status;
         $product->product_category_id = json_decode($request->product_category_id);
         $product->product_tag_id = json_decode($request->product_tag_id);
         $product->update();
         $product->categories()->sync($product->product_category_id);
         $product->tags()->sync($product->product_tag_id);
         return response()->json([
            'message' => "Product Updated Successfully",
            'status' => 'success',
            'statusCode' => 200,
            'id' => $product->id
         ]);
      }else{
         $product = new Product();
         $product->name = $request->name;
         $str = str_replace(' ', '-', strtolower($request->name)).'-'.rand(11000,11111100);
         $product->slug = $str;
         $product->manufacturer_name = $request->manufacturer_name;
         $product->description = $request->description;
         $product->product_brand_id = $request->product_brand_id;
         $product->status = $request->status;
         $product->product_category_id = json_decode($request->product_category_id);
         $product->product_tag_id = json_decode($request->product_tag_id);
         $product->save();
         $product->categories()->sync($product->product_category_id);
         $product->tags()->sync($product->product_tag_id);
         return response()->json([
            'message' => "Product Created Successfully",
            'status' => 'success',
            'statusCode' => 200,
            'id' => $product->id
         ]);
      }
   }
   public function saveProductPrice(Request $request)
   {
      $id = $request->product_id;
      if($id){
         $product = Product::find((int)$id);
         $product->price = (int)$request->price;
         $product->discount_price = (int)$request->discount_price;
         $product->price_type_id = $request->price_type_id;
         $product->price_start = $request->price_start;
         $product->price_end = $request->price_end;
         if((int)$request->price_type_id == 2){
            $product->percentage_value = $request->percentage_value;
         }
         $product->update();
         return response()->json([
            'message' => 'Product Price Updated Successfully',
            'status' => 'success',
            'statusCode' => 200,
            'id' =>  $product->id
         ]);
      }else{
         return response()->json([
            'message' => 'Add Product Detail First',
            'status' => 'error',
            'statusCode' => 401,
         ]);
      }
   }
   public function saveProductInventory(Request $request)
   {
      $id = $request->product_id;
      if($id){
         $product = Product::find((int)$id);
         $product->sku = $request->sku;
         $product->quantity = $request->quantity;
         $product->return_policy = $request->return_policy;
         $product->stock_available = $request->stock_availablity;
         $product->update();
         return response()->json([
            'message' => 'Product Inventory Updated Successfully',
            'status' => 'success',
            'statusCode' => 200,
            'id' =>  $product->id
         ]);
      }else{
         return response()->json([
            'message' => 'Add Product Details and Price First',
            'status' => 'error',
            'statusCode' => 401,
         ]);
      }
   }
   public function saveProductSeo(Request $request)
   {
      $id = $request->product_id;
      if($id){
         $product = Product::find((int)$id);
         $product->meta_title = $request->meta_title;
         $product->meta_description = $request->meta_description;
         $product->meta_key = $request->meta_key;
         $product->short_description = $request->short_description;
         if($request->slug){
            $product->slug = $request->slug;
         }
         $product->update();
         return response()->json([
            'message' => 'Product SEO Updated Successfully',
            'status' => 'success',
            'statusCode' => 200,
            'id' =>  $product->id
         ]);
      }else{
         return response()->json([
            'message' => 'Add Product Details, Price, Stock and Images First',
            'status' => 'error',
            'statusCode' => 401,
         ]);
      }
   }
   public function saveProductAttribute(Request $request)
   {
      $id = $request->product_id;
      if($id){
         $product = Product::find((int)$id);
         $product->attributes = json_decode($request['attributes']);
         $product->values = json_decode($request->values);
         $product->update();
         $product->attributes()->sync($product->attributes);
         return response()->json([
            'message' => 'Product Attributes Updated Successfully',
            'status' => 'success',
            'statusCode' => 200,
            'id' =>  $product->id
         ]);
      }else{
         return response()->json([
            'message' => 'Add Product Details, Price, Stock, Images and Seo First',
            'status' => 'error',
            'statusCode' => 401,
         ]);
      }
   }
   public function saveProductImage(Request $request)
   {
      // dd($request->all());
      $id = $request->product_id;
      if($id){
         $product = Product::find((int)$id);
         $imageName = uniqid().'.'.$request->thumbnail->extension();
         $request->thumbnail->move(public_path('uploads/products'), $imageName);
         $product->thumbnail = $imageName;
         $additionalimages = $request->additional_images;
         $imagenames = [];
         foreach ($additionalimages as $key => $value) {
            $imageName = uniqid().'.'.$value->extension();
            $imagenames[] = $imageName;
            $value->move(public_path('uploads/products'), $imageName);
         }
         $product->additional_images = $imagenames;
         $product->update();
         return response()->json([
            'message' => 'Product Images Updated Successfully',
            'status' => 'success',
            'statusCode' => 200,
            'id' =>  $product->id
         ]);
      }else{
         return response()->json([
            'message' => 'Add Product Details, Price and Stock First',
            'status' => 'error',
            'statusCode' => 401,
         ]);
      }
   }
   public function deleteProduct($id)
   {
      Product::where('id',(int)$id)->delete();
      TagProduct::where('product_id',(int)$id)->get()->each->delete();
      AttributeProduct::where('product_id',(int)$id)->get()->each->delete();
      CategoryProduct::where('product_id',(int)$id)->get()->each->delete();
      return response()->json('Product Deleted Successfully');
   }
   public function markFeatureProduct($id)
   {
      $product = Product::find($id);
      $product->feature = 1;
      $product->save();
      return response()->json([
         'message' => 'Product Featured',
         'status' => 'success',
         'statusCode' => 200,
         'product' => $product->feature==1?"Featured":"Un Featured"
      ]);
   }
   public function unmarkFeatureProduct($id)
   {
      $product = Product::find($id);
      $product->feature = 0;
      $product->save();
      return response()->json([
         'message' => 'Product UnFeatured',
         'status' => 'success',
         'statusCode' => 200,
         'product' => $product->feature==1?"Featured":"Un Featured"
      ]);
   }
   public function markTopProduct($id)
   {
      $product = Product::find($id);
      $product->top = 1;
      $product->save();
      return response()->json([
         'message' => 'Product Added to Top',
         'status' => 'success',
         'statusCode' => 200,
         'product' => $product->top==1?"Top":"Not Top"
      ]);
   }
   public function unmarkTopProduct($id)
   {
      $product = Product::find($id);
      $product->top = 0;
      $product->save();
      return response()->json([
         'message' => 'Product Removed from Top',
         'status' => 'success',
         'statusCode' => 200,
         'product' => $product->top==1?"Top":"Not Top"
      ]);
   }
   public function markTopProductCategory($id)
   {
      $category = ProductCategory::find($id);
      $category->top = 1;
      $category->save();
      return response()->json([
         'message' => 'Product Category Added in Top',
         'status' => 'success',
         'statusCode' => 200,
         'product' => $category->top==1?"Top":"Not Top"
      ]);
   }
   public function unmarkTopProductCategory($id)
   {
      $category = ProductCategory::find($id);
      $category->top = 0;
      $category->save();
      return response()->json([
         'message' => 'Product Category Removed from Top',
         'status' => 'success',
         'statusCode' => 200,
         'product' => $category->top==1?"Top":"Not Top"
      ]);
   }
   public function getAllProductOrder()
   {
      $orders = ProductOrder::with('client')->limit(20)->get();
      return response()->json($orders);
   }
   public function deleteProductOrder($id)
   {
      $order = ProductOrder::find($id);
      $order->delete();
      return response()->json([
         'message' => 'Order Deleted Successfully',
         'status' => 'success',
         'statusCode' => 200
      ]);
   }
   public function markPendingProductOrder($id)
   {
      $order = ProductOrder::where('id',(int)$id)->first();
      $order->status = 0;
      $order->is_received = 0;
      $order->save();
      return response()->json([
         'message' => 'Order Marked in Pending Successfully',
         'status' => 'success',
         'statusCode' => 200
      ]);
   }
   public function markConfirmProductOrder($id)
   {
      $order = ProductOrder::where('id',(int)$id)->first();
      $order->status = 1;
      $order->is_received = 0;
      $order->save();
      return response()->json([
         'message' => 'Order Marked in Confirm Successfully',
         'status' => 'success',
         'statusCode' => 200
      ]);
   }
   public function markDeliverProductOrder($id)
   {
      $order = ProductOrder::where('id',(int)$id)->first();
      $order->status = 2;
      $order->is_received = 0;
      $order->save();
      return response()->json([
         'message' => 'Order Marked in Delivered Successfully',
         'status' => 'success',
         'statusCode' => 200
      ]);
   }
   public function markCompleteProductOrder($id)
   {
      $order = ProductOrder::where('id',(int)$id)->first();
      $order->status = 3;
      $order->is_received = 1;
      $order->save();
      return response()->json([
         'message' => 'Order Marked in Complete Successfully',
         'status' => 'success',
         'statusCode' => 200
      ]);
   }
   public function markCancelProductOrder($id)
   {
      $order = ProductOrder::where('id',(int)$id)->first();
      $order->status = 4;
      $order->is_received = 0;
      $order->save();
      return response()->json([
         'message' => 'Order Marked in Cancelled Successfully',
         'status' => 'success',
         'statusCode' => 200
      ]);
   }
   public function viewProductOrder($id)
   {
      $order = ProductOrder::where('id',(int)$id)->with('client')->first();
      return response()->json([
         'message' => 'Order Fetched Successfully',
         'status' => 'success',
         'statusCode' => 200,
         'order' => $order
      ]);
   }

   public function getAllOrderTransaction()
   {
      $transaction = ProductTransaction::with('order')->limit(20)->get();
      return response()->json($transaction);
   }
   public function deleteOrderTransaction($id)
   {
      $transaction = ProductTransaction::find($id);
      $transaction->delete();
      return response()->json([
         'message' => 'Transaction Deleted Successfully',
         'status' => 'success',
         'statusCode' => 200
      ]);
   }
   //////////////////Product Checkout /////////////////////////
   public function cashOnDeliveryOrderSave(Request $request)
   {
      $order = new ProductOrder();
      $user = User::where('id',$request->client_id)->first();
      $order->client_id = $request->client_id;
      $order->client_number = $user->phone;
      $order->client_name = $user->name;
      $order->total = $request->total;
      $order->type = $request->type;
      $order->status = $request->status;
      $order->cart = json_decode($request->cart);
      $order->is_received = $request->is_received;
      $order->save();
      $today = Carbon::createFromFormat('Y-m-d H:i:s', $order->created_at); 
      $day = $today->format('Y-m-d');
      $replace = str_replace("-", "", $day);
      $saveformat = "RES".'-POR'.$order->id.'-'.$replace;
      $order->unique_order_id = $saveformat;
      $order->update();
      if((int)$request->type == 2){
         return response()->json([
            'order_id' => $order->unique_order_id,
            'message' => "Redirecting To ALFA",
            'status' => 'success',
            'statusCode' => 200,
         ]);
      }else{
         $neworder = ProductOrder::where('id',$order->id)->with('client')->first();
         return response()->json([
            'order_id' => $order->unique_order_id,
            'message' => "Your Order Has Been Placed Successfully",
            'status' => 'success',
            'order' => $neworder,
            'statusCode' => 200
         ]);
      }
   }
   ////////////////////Product Alfa Payment///////////////////////////////
   public function alfaProductHandshake($order_id,$price)
   {
      $appointment_id = $order_id;
         $alphacredential = array(
            "Key1"  =>  "2s7eQjG3zwctj2fh",
            "Key2"  =>  "0843195089646397",
            "url"    =>  "https://sandbox.bankalfalah.com/HS/HS/HS",
            "HS_RequestHash"    =>  "",
            "HS_IsRedirectionRequest"   =>  "https://dev.reservim.com/alpha/handshake/redirect/<?php echo $appointment_id ?>/<?php echo $price ?>",
            "HS_ChannelId"  =>  "1001",
            "HS_ReturnURL"  =>  "https://dev.reservim.com/alpha/handshake/redirect/<?php echo $appointment_id ?>/<?php echo $price ?>",
            "HS_MerchantId" =>  "12424",
            "HS_StoreId"    =>  "019160",
            "HS_MerchantHash"   =>  "OUU362MB1upELeKgA48wpmKC0ehbvuLuYPeTW3x8qI26W2r0ON+k/nd+2YAv2Agnu8yLOD6fBxA=",
            "HS_MerchantUsername"   =>  "mepaje",
            "HS_MerchantPassword"   =>  "QMnH6JT/SVBvFzk4yqF7CA==",
            "HS_TransactionReferenceNumber" =>  "<?php echo $appointment_id ?>",
            // redirection to alpha page
            "redirect_url"  =>  "https://sandbox.bankalfalah.com/SSO/SSO/SSO",
            "RequestHash"   =>  "",
            "ChannelId" =>  "1001",
            "Currency"  =>  "PKR",
            "IsBIN" =>  "0",
            "ReturnURL" =>  "https://dev.reservim.com/account#/appointments",
            "MerchantId"    =>  "12424",
            "StoreId"   =>  "019160",
            "MerchantHash"  =>  "OUU362MB1upELeKgA48wpmKC0ehbvuLuYPeTW3x8qI26W2r0ON+k/nd+2YAv2Agnu8yLOD6fBxA=",
            "MerchantUsername"  =>  "mepaje",
            "MerchantPassword"  =>  "QMnH6JT/SVBvFzk4yqF7CA=="
      );
      return view('alfaorderdev',compact('appointment_id','price'));
   }
   public function alfaProductRedirect($order_id,$price)
   {
      $appointment_id = $order_id;
      return view('alfaorderdevredirect',compact('appointment_id','price'));
   }
   public function saveAlfaProductTransaction($order_id)
   {
      $orderDetail = ProductOrder::where('unique_order_id',$order_id)->first();
      $transaction = new ProductTransaction();
      $transaction->order_id = (int)$order_id;
      $transaction->status = 1;
      $transaction->total = $orderDetail->total;
      $transaction->type = $orderDetail->type;
      $transaction->save();
      return response()->json([
         'message' => "Transaction Successfull. Your Order Has Been Placed. Keep in Touch with Reservim For Delivery Purpose",
         'status' => 'success',
         'statusCode' => 200,
         'transaction' => $transaction,
         'order_id' => $order_id
      ]);
   }
   public function alfaLiveProductHandshake($order_id,$price)
   {
      $appointment_id = $order_id;
      return view('alfaorderlive',compact('appointment_id','price'));
   }
   public function alfaLiveProductRedirection($order_id,$price)
   {
      $appointment_id = $order_id;
      return view('alfaorderliveredirect',compact('appointment_id','price'));
   }

   ///////////////////Admin Product Review////////////////
   public function catalogue (){
      return view('back-end/products-page/catalogueProducts');
   }
   public function creatProducts ($id = "null"){
      return view('back-end/products-page/product-creat-catalogue',compact('id'));
   }
   public function categories (){
         return view('back-end/products-page/product-categories');
   }
   public function tag (){
         return view('back-end/products-page/product-tag');
   }
   public function brand (){
         return view('back-end/products-page/product-brand');
   }
   public function attributes (){
         return view('back-end/products-page/product-attributes');
   }
   public function reviews (){
         return view('back-end/products-page/product-reviews');
   }
   public function pageSetting (){
        return view('back-end/products-page/product-page-setting');
    }
   public function order (){
      return view('back-end/products-brand-page/product-order');
   }
   public function transcations (){
         return view('back-end/products-brand-page/product-transcations');
   }
   public function getAllProductReview()
   {
      $reviews = ProductReview::with('client','products')->get();
      return response()->json($reviews);
   }
   public function approveProductReview($id)
   {
      $review = ProductReview::find($id);
      $review->status = 1;
      $review->save();
      return response()->json([
         'message'=>"Review Approved",
         'status' => 'success',
         'statusCode' => 200
      ]);
   }
   public function declineProductReview($id)
   {
      $review = ProductReview::find($id);
      $review->status = 0;
      $review->save();
      return response()->json([
         'message'=>"Review Declined",
         'status' => 'success',
         'statusCode' => 200
      ]);
   }
}
