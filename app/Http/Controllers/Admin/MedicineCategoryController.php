<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\MedicineCategory;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Storage;
use App\Helper;

class MedicineCategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $categories = MedicineCategory::orderBy('id', 'desc')->get();
        return view('back-end.admin.pharmacy.category.index', compact('categories'));
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
        ]);

        $category = new MedicineCategory();
        $category->name = $request->name;
        $category->slug = Str::slug($request->name);
        $category->description = $request->description;
        $category->meta_title = $request->meta_title;
        $category->meta_description = $request->meta_description;
        $category->country_id = $request->country_id;
        $category->state_id = $request->state_id;
        $category->city_id = $request->city_id;
        $category->status = $request->status ?? 'active';
        
        // Handle image upload
        if ($request->hasFile('image')) {
            $file = $request->file('image');
            $directoryPath = 'uploads/pharmacy/categories';
            $filename = $file->getClientOriginalName();
            $ext = pathinfo($filename, PATHINFO_EXTENSION);
            $disk = (env('FILESYSTEM_DRIVER') === 'production') ? 's3' : 'local_public';
            
            // Set the new file name
            $newFilename = 'category_' . time() . '_' . rand(1000, 9999) . '.' . $ext;
            $filePath = $directoryPath . '/' . $newFilename;
            
            if ($disk === 's3') {
                // Store the file on S3
                Storage::disk($disk)->put($filePath, file_get_contents($file), 'public');
            } else {
                // Check if the directory exists, if not, create it
                if (!File::isDirectory(public_path($directoryPath))) {
                    File::makeDirectory(public_path($directoryPath), 0777, true, true);
                }
                // Store the file locally
                $file->move(public_path($directoryPath), $newFilename);
            }
            
            $category->image = $newFilename;
        }
        
        $category->save();

        Session::flash('message', 'Medicine Category Created Successfully');
        return redirect()->back();
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(Request $request, $id)
    {
        // Ensure we get the correct category by ID - explicitly cast to integer
        $categoryId = (int) $id;
        $category = MedicineCategory::where('id', $categoryId)->firstOrFail();
        
        // Verify we got the correct category
        if ($category->id != $categoryId) {
            Session::flash('error', 'Category ID mismatch');
            return redirect()->route('medicine-category.index');
        }
        
        $categories = MedicineCategory::orderBy('id', 'desc')->get();
        return view('back-end.admin.pharmacy.category.index', compact('category', 'categories'));
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
        ]);

        $category = MedicineCategory::find($id);
        $category->name = $request->name;
        $category->slug = Str::slug($request->name);
        $category->description = $request->description;
        $category->meta_title = $request->meta_title;
        $category->meta_description = $request->meta_description;
        $category->country_id = $request->country_id;
        $category->state_id = $request->state_id;
        $category->city_id = $request->city_id;
        $category->status = $request->status ?? 'active';
        
        // Handle image upload
        if ($request->hasFile('image')) {
            // Delete old image if exists
            if ($category->image) {
                $oldImagePath = 'uploads/pharmacy/categories/' . $category->image;
                $disk = (env('FILESYSTEM_DRIVER') === 'production') ? 's3' : 'local_public';
                if ($disk === 's3') {
                    Storage::disk($disk)->delete($oldImagePath);
                } else {
                    if (File::exists(public_path($oldImagePath))) {
                        File::delete(public_path($oldImagePath));
                    }
                }
            }
            
            $file = $request->file('image');
            $directoryPath = 'uploads/pharmacy/categories';
            $filename = $file->getClientOriginalName();
            $ext = pathinfo($filename, PATHINFO_EXTENSION);
            $disk = (env('FILESYSTEM_DRIVER') === 'production') ? 's3' : 'local_public';
            
            // Set the new file name
            $newFilename = 'category_' . time() . '_' . rand(1000, 9999) . '.' . $ext;
            $filePath = $directoryPath . '/' . $newFilename;
            
            if ($disk === 's3') {
                // Store the file on S3
                Storage::disk($disk)->put($filePath, file_get_contents($file), 'public');
            } else {
                // Check if the directory exists, if not, create it
                if (!File::isDirectory(public_path($directoryPath))) {
                    File::makeDirectory(public_path($directoryPath), 0777, true, true);
                }
                // Store the file locally
                $file->move(public_path($directoryPath), $newFilename);
            }
            
            $category->image = $newFilename;
        }
        
        $category->save();

        Session::flash('message', 'Medicine Category Updated Successfully');
        return redirect()->route('medicine-category.index');
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
            MedicineCategory::where('id', $id)->delete();
            $json['type'] = 'success';
            $json['message'] = 'Medicine Category Deleted Successfully';
            return $json;
        } else {
            $json['type'] = 'error';
            return $json;
        }
    }
}
