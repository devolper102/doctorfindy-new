<?php

/**
 * Class DoctorController
 *
 * @category Doctry
 *
 * @package Doctry
 * @author  Amentotech <theamentotech@gmail.com>
 * @license http://www.amentotech.com Amentotech
 * @link    http://www.amentotech.com
 */

namespace App\Http\Controllers;

use App\Page;
use Illuminate\Http\Request;
use View;
use Illuminate\Support\Facades\Redirect;
use Session;
use App\UserMeta;
use App\User;
use App\Disease;
use App\Location;
use App\Service;
use App\Speciality;
use App\SiteManagement;
use DB;
use Auth;
use App\Helper;
use App\SiteTeam;

/**
 * Class PageController
 *
 */
class PageController extends Controller
{
    /**
     * Defining scope of the variable
     *
     * @access public
     * @var    array $page
     */
    protected $page;

    /**
     * Create a new controller instance.
     *
     * @param instance $page instance
     *
     * @return void
     */
    public function __construct(Page $page)
    {
        $this->page = $page;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $pages = $this->page::getPages();
        if (file_exists(resource_path('views/extend/back-end/admin/pages/index.blade.php'))) {
            return View::make('extend.back-end.admin.pages.index', compact('pages'));
        } else {
            return View::make(
                'back-end.admin.pages.index',
                compact('pages')
            );
        }
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $parent_page = $this->page->getParentPages();
        $page_created = trans('lang.page_created');
        if (file_exists(resource_path('views/extend/back-end/admin/pages/create.blade.php'))) {
            return View::make('extend.back-end.admin.pages.create', compact('parent_page', 'page_created'));
        } else {
            return View::make('back-end.admin.pages.create', compact('parent_page', 'page_created'));
        }
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param mixed $request $req->attr
     *
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $server = Helper::doctieIsDemoSiteAjax();
        if (!empty($server)) {
            $response['type'] = 'error';
            $response['message'] = $server->getData()->message;
            return $response;
        }
        $json = array();
        if (!empty($request)) {
            $this->validate(
                $request,
                [
                    'title' => 'required|string',
                    'content' => 'required',
                ]
            );
            $save_page = $this->page->savePage($request);
            if ($request['parent_id']) {
                DB::table('child_pages')->insert(
                    ['parent_id' => $request['parent_id'], 'child_id' => $save_page]
                );
            }
            $json['type'] = 'success';
            $json['message'] = trans('lang.page_created');
            return $json;
        } else {
            $json['type'] = 'error';
            $json['message'] = trans('lang.something_wrong');
            return $json;
        }
    }

    /**
     * Display the specified resource.
     *
     * @param string $slug page slug
     *
     * @return view
     */
    public function show($slug)
    {
        if (!empty($slug)) {
            $page = DB::table('pages')->select('*')->where('slug', $slug)->get()->first();
            $page_meta = !empty($page) ? Helper::getUnserializeData($page->meta) : array();
            $meta_desc = !empty($page_meta['seo_desc']) ? $page_meta['seo_desc'] : '';
            if (file_exists(resource_path('views/extend/front-end/pages/show.blade.php'))) {
                return View::make('extend.front-end.pages.show', compact('page', 'slug', 'meta_desc'));
            } else {
                return View::make('front-end.pages.show', compact('page', 'slug', 'meta_desc'));
            }
        } else {
            abort(404);
        }
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param integer $id page Id
     *
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        if (!empty($id)) {
            $page = $this->page::find($id);
            $parent_selected_id = '';
            $parent_page = $this->page->getParentPages($id);
            $has_child = $this->page->pageHasChild($id);
            $child_parent_id = DB::table('child_pages')->select('parent_id')->where('child_id', $id)->get()->first();
            if (!empty($child_parent_id->parent_id)) {
                $parent_selected_id = $child_parent_id->parent_id;
            } else {
                $parent_selected_id = '';
            }
            $meta = !empty($page->meta) ? Helper::getUnserializeData($page->meta) : '';
            $seo_description = !empty($meta) ? $meta['seo_desc'] : '';
            if (file_exists(resource_path('views/extend/back-end/admin/pages/edit.blade.php'))) {
                return View::make(
                    'extend.back-end.admin.pages.edit',
                    compact('page', 'parent_page', 'parent_selected_id', 'id', 'has_child', 'seo_description')
                );
            } else {
                return View::make(
                    'back-end.admin.pages.edit',
                    compact('page', 'parent_page', 'parent_selected_id', 'id', 'has_child', 'seo_description')
                );
            }
        } else {
            abort(404);
        }
    }

    /**
     * Update the specified resource in storage.
     *
     * @param mixed $request $req->attr
     *
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request)
    {
        $server_verification = Helper::doctieIsDemoSite();
        if (!empty($server_verification)) {
            Session::flash('error', $server_verification);
            return Redirect::to('admin/pages');
        }
        if (!empty($request)) {
            $this->validate(
                $request,
                [
                    'title' => 'required|string',
                    'content' => 'required',
                ]
            );
            $id = $request['page_id'];
            $parent_id = filter_var($request['parent_id'], FILTER_SANITIZE_NUMBER_INT);
            $child_id = filter_var($id, FILTER_SANITIZE_NUMBER_INT);
            $this->page->updatePage($id, $request);
            if ($parent_id == null) {
                DB::table('child_pages')->where('child_id', '=', $child_id)->delete();
            } elseif ($parent_id) {
                DB::table('child_pages')->where('child_id', '=', $child_id)->delete();
                DB::table('child_pages')->insert(
                    ['parent_id' => $parent_id, 'child_id' => $child_id]
                );
            }
            return response()->json(
                [
                    'type' => 'success',
                    'message' => trans('lang.page_updated')
                ]
            );
        } else {
            $json['type'] = 'error';
            $json['message'] = trans('lang.something_wrong');
            return $json;
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param mixed $request $req->attr
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
            $child_pages = $this->page::pageHasChild($id);
            if (!empty($child_pages)) {
                foreach ($child_pages as $page) {
                    DB::table('pages')->where('id', $page->child_id)->update(['relation_type' => 0]);
                }
            } else {
                $relation = DB::table('pages')->select('relation_type')->where('id', $id)->get()->first();
                if ($relation->relation_type == 1) {
                    DB::table('pages')->where('id', $id)->update(['relation_type' => 0]);
                }
            }
            DB::table('child_pages')->where('child_id', '=', $id)->orWhere('parent_id', '=', $id)->delete();
            DB::table('pages')->where('id', '=', $id)->delete();
            $json['type'] = 'success';
            $json['message'] = trans('lang.page_deleted');
            return $json;
        } else {
            $json['type'] = 'error';
            $json['message'] = trans('lang.something_wrong');
            return $json;
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param mixed $request request attributes
     *
     * @return \Illuminate\Http\Response
     */
    public function deleteSelected(Request $request)
    {
        $server = Helper::doctieIsDemoSiteAjax();
        if (!empty($server)) {
            $json['type'] = 'error';
            $json['message'] = $server->getData()->message;
            return $json;
        }
        $json = array();
        $checked = !empty($request) && !empty($request['ids']) ? $request['ids'] : '';
        if (!empty($checked)) {
            foreach ($checked as $id) {
                $this->page::where("id", $id)->delete();
            }
            $json['type'] = 'success';
            return $json;
        } else {
            $json['type'] = 'error';
            $json['message'] = trans('lang.something_wrong');
            return $json;
        }
    }
     public function about() {
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
        $specialities = Speciality::select('id','title','slug','image')->where('top', '1')->orderBy("created_at","asc")->limit(8)->get();
        /*Diseases*/
        $diseases = Disease::select('id','title', 'slug','flag')->latest()->limit(4)->get();
        /*Services*/
        $services = Service::select('id','title', 'slug','image')->latest()->limit(4)->get();
        /*Locations*/
        $cities = Location::where('top', '1')->orderBy("created_at","asc")->limit(8)->get();
        $meta_values = ['header_service','show_headertabs','topbar_settings','general_settings','download_app_sec','home_slider','socials','footer_settings','subscribe_now_sec','list_doctor_inner_section'];
        $managements = SiteManagement::whereIn('meta_key',$meta_values)->get();
        $teams = SiteTeam::orderBy("id","desc")->get();
        $segments = \Request::segments();
        return view('front-end.site-pages.about',
            compact(
                'specialities', 'logged_user', 'laboratories', 'cities', 'services', 'diseases',
                'specialities', 'hospitals', 'doctors', 'managements','segments','teams'
            )
        );
    }
      public function contact() {
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
        $specialities = Speciality::select('id','title','slug','image')->where('top', '1')->orderBy("created_at","asc")->limit(8)->get();
        /*Diseases*/
        $diseases = Disease::select('id','title', 'slug','flag')->limit(4)->get();
        /*Services*/
        $services = Service::select('id','title', 'slug','image')->limit(4)->get();
        /*Locations*/
        $cities = Location::where('top', '1')->orderBy("created_at","asc")->limit(6)->get();
        $meta_values = ['header_service','show_headertabs','topbar_settings','general_settings','download_app_sec','home_slider','socials','footer_settings','subscribe_now_sec','list_doctor_inner_section'];
        $managements = SiteManagement::whereIn('meta_key',$meta_values)->get();
        $segments = \Request::segments();
        return view('front-end.site-pages.contact',
            compact(
                'specialities', 'logged_user', 'laboratories', 'cities', 'services', 'diseases',
                'specialities', 'hospitals', 'doctors', 'managements','segments'
            )
        );
    }
    public function disclaimer()
    {
        $user_ = User::where('id', \Auth::id() ? Auth::id() : '')->with('profile')->with('roles')->first();
        $logged_user = $user_ ? $user_ : [];
  $doctors = User::role('doctor')->orderBy("trending","desc")->with('profile','specialities','location','feedbacks')->whereHas('profile')->limit(4)->get();
        /*Hospital*/
        $hospitals = User::role('hospital')->orderBy("trending","desc")->with('profile','location','area','feedbacks','teams')->limit(6)->get();
        /*Laboratory*/
        $laboratories = User::role('laboratory')->with('profile','location','area')->limit(6)->get();
        /*Specialities*/
        $specialities = Speciality::select('id','title','slug','image')->where('top', '1')->orderBy("created_at","asc")->limit(8)->get();
        /*Diseases*/
        $diseases = Disease::select('id','title', 'slug','flag')->limit(4)->get();
        /*Services*/
        $services = Service::select('id','title', 'slug','image')->limit(4)->get();
        /*Locations*/
        $cities = Location::where('top', '1')->orderBy("created_at","asc")->limit(6)->get();    
        $meta_values = ['header_service','show_headertabs','topbar_settings','general_settings','download_app_sec','home_slider','socials','footer_settings','subscribe_now_sec','list_doctor_inner_section'];
        $managements = SiteManagement::whereIn('meta_key',$meta_values)->get();
        $segments = \Request::segments();
        return view('front-end.site-pages.disclaimer',
            compact(
                'specialities', 'logged_user', 'laboratories', 'cities', 'services', 'diseases',
                'specialities', 'hospitals', 'doctors', 'managements','segments'
            )
        );
    }
      public function privacy() {
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
        $specialities = Speciality::select('id','title','slug','image')->where('top', '1')->orderBy("created_at","asc")->limit(8)->get();
        /*Diseases*/
        $diseases = Disease::select('id','title', 'slug','flag')->limit(4)->get();
        /*Services*/
        $services = Service::select('id','title', 'slug','image')->limit(4)->get();
        /*Locations*/
        $cities = Location::where('top', '1')->orderBy("created_at","asc")->limit(6)->get();    
        $meta_values = ['header_service','show_headertabs','topbar_settings','general_settings','download_app_sec','home_slider','socials','footer_settings','subscribe_now_sec','list_doctor_inner_section'];
        $managements = SiteManagement::whereIn('meta_key',$meta_values)->get();
        $segments = \Request::segments();
        return view('front-end.site-pages.privacy',
            compact(
                'specialities', 'logged_user', 'laboratories', 'cities', 'services', 'diseases',
                'specialities', 'hospitals', 'doctors', 'managements','segments'
            )
        );
    }
}
