<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\MedicineSubcategory;
use App\Models\MedicineCategory;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Session;
use App\Helper;

class MedicineSubcategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $subcategories = MedicineSubcategory::with('category')->orderBy('id', 'desc')->get();
        $categories = MedicineCategory::orderBy('name', 'asc')->get();
        return view('back-end.admin.pharmacy.subcategory.index', compact('subcategories', 'categories'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $this->validate($request, [
            'name' => 'required',
            'category_id' => 'required',
        ]);

        $subcategory = new MedicineSubcategory();
        $subcategory->category_id = $request->category_id;
        $subcategory->name = $request->name;
        $subcategory->slug = Str::slug($request->name);
        $subcategory->description = $request->description;
        $subcategory->meta_title = $request->meta_title;
        $subcategory->meta_description = $request->meta_description;
        $subcategory->country_id = $request->country_id;
        $subcategory->state_id = $request->state_id;
        $subcategory->city_id = $request->city_id;
        $subcategory->status = $request->status ?? 'active';
        $subcategory->save();

        Session::flash('message', 'Medicine Subcategory Created Successfully');
        return redirect()->back();
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $subcategory = MedicineSubcategory::find($id);
        $subcategories = MedicineSubcategory::with('category')->orderBy('id', 'desc')->get();
        $categories = MedicineCategory::orderBy('name', 'asc')->get();
        return view('back-end.admin.pharmacy.subcategory.index', compact('subcategory', 'subcategories', 'categories'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $this->validate($request, [
            'name' => 'required',
            'category_id' => 'required',
        ]);

        $subcategory = MedicineSubcategory::find($id);
        $subcategory->category_id = $request->category_id;
        $subcategory->name = $request->name;
        $subcategory->slug = Str::slug($request->name);
        $subcategory->description = $request->description;
        $subcategory->meta_title = $request->meta_title;
        $subcategory->meta_description = $request->meta_description;
        $subcategory->country_id = $request->country_id;
        $subcategory->state_id = $request->state_id;
        $subcategory->city_id = $request->city_id;
        $subcategory->status = $request->status ?? 'active';
        $subcategory->save();

        Session::flash('message', 'Medicine Subcategory Updated Successfully');
        return redirect()->route('medicine-subcategory.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \Illuminate\Http\Request  $request
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
            MedicineSubcategory::where('id', $id)->delete();
            $json['type'] = 'success';
            $json['message'] = 'Medicine Subcategory Deleted Successfully';
            return $json;
        } else {
            $json['type'] = 'error';
            return $json;
        }
    }
}
