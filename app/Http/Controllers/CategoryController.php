<?php
/**
 * Class CategoryController
 *
 * @category Doctry
 *
 * @package Doctry
 * @author  Amentotech <theamentotech@gmail.com>
 * @license http://www.amentotech.com Amentotech
 * @link    http://www.amentotech.com
 */

namespace App\Http\Controllers;

use App\Category;
use App\Helper;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Arr;
use Session;
use View;

/**
 * Class CategoryController
 *
 */
class CategoryController extends Controller
{
    /**
     * Defining scope of variable
     *
     * @access protected
     *
     * @var    array $category
     */
    protected $category;

    /**
     * Create a new controller instance.
     *
     * @param mixed $category get category model
     *
     * @return void
     */
    public function __construct(Category $category)
    {
        $this->category = $category;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
         $categories = Category::all();
        if (!empty($_GET['keyword'])) {
            $keyword = $_GET['keyword'];
            $cats = $this->category::where('title', 'like', '%' . $keyword . '%')->get()->setPath('');
            $pagination = $cats->appends(
                array(
                    'keyword' => $request->get('keyword'),
                )
            );
        } else {
            $cats = $this->category->get();
        }
        return View::make(
            'back-end.admin.categories.index', compact('cats','categories')
        );
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param mixed $request Request attributes
     *
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $server_verification = Helper::DoctieIsDemoSite();
        if (!empty($server_verification)) {
            Session::flash('error', $server_verification);
            return Redirect::back();
        }
        $this->validate(
            $request, [
                'title' => 'required',
            ]
        );
        $this->category->saveCategories($request);
        Session::flash('message', trans('lang.save_category'));
        return Redirect::back();
    }

    /**
     * Edit Category.
     *
     * @param string $slug string
     *
     * @return \Illuminate\Http\Response
     */
    public function edit($slug)
    {
        if (!empty($slug)) {
            $cats = $this->category::where('slug', $slug)->first();
            $category_parent = $this->category::where('slug', $slug)->select('parent')->pluck('parent')->first();
            $category_list = Arr::pluck($this->category::where('slug', '!=', $slug)->get(), 'title', 'id');
            if (!empty($cats)) {
//                dd($cats->image);
                return View::make(
                    'back-end.admin.categories.edit', compact('slug', 'cats','category_parent','category_list')
                );
                return Redirect::to('admin/categories');
            }
        } else {
            abort(404);
        }
    }

    /**
     * Update Categories.
     *
     * @param mixed $request Request attributes
     * @param int   $id      integer
     *
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $server_verification = Helper::doctieIsDemoSite();
        if (!empty($server_verification)) {
            Session::flash('error', $server_verification);
            return Redirect::back();
        }
        $this->validate(
            $request, [
                'title' => 'required',
            ]
        );
        $this->category->updateCategories($request, $id);
        Session::flash('message', trans('lang.cat_updated'));
        return Redirect::to('admin/categories');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param mixed $request Request attributes
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
            $category = $this->category::find($id);
            if ($category->articles->count() > 0) {
                $category->articles()->detach();
            }
            $this->category::where('id', $id)->delete();
            $json['type'] = 'success';
            $json['message'] = trans('lang.cat_deleted');
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
     * @param mixed $request Request attributes
     *
     * @return \Illuminate\Http\Response
     */
    public function deleteSelected(Request $request)
    {
        $server = Helper::DoctieIsDemoSiteAjax();
        if (!empty($server)) {
            $json['type'] = 'error';
            $json['message'] = $server->getData()->message;
            return $json;
        }
        $json = array();
        $checked = $request['ids'];
        foreach ($checked as $id) {
            $this->category::where("id", $id)->delete();
        }
        if (!empty($checked)) {
            $json['type'] = 'success';
            $json['message'] = trans('lang.cat_deleted');
            return $json;
        } else {
            $json['type'] = 'error';
            $json['message'] = trans('lang.something_wrong');
            return $json;
        }
    }
}
