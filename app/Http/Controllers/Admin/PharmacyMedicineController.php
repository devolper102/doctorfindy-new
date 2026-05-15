<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\PharmacyMedicine;
use App\Models\PharmacyMedicineDetail;
use App\Models\MedicineCategory;
use App\Models\MedicineSubcategory;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Storage;
use App\Helper;

class PharmacyMedicineController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $medicines = PharmacyMedicine::with(['category', 'subcategory', 'details'])->orderBy('id', 'desc')->get();
        $categories = MedicineCategory::orderBy('name', 'asc')->get();
        $subcategories = MedicineSubcategory::orderBy('name', 'asc')->get();
        return view('back-end.admin.pharmacy.medicine.index', compact('medicines', 'categories', 'subcategories'));
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
            'medicine_category_id' => 'required',
        ]);

        $medicine = new PharmacyMedicine();
        $medicine->medicine_category_id = $request->medicine_category_id;
        $medicine->medicine_subcategory_id = $request->medicine_subcategory_id;
        $medicine->name = $request->name;
        $medicine->slug = \Illuminate\Support\Str::slug($request->name);
        $medicine->manufacturer = $request->manufacturer;
        $medicine->generic_name = $request->generic_name;
        $medicine->rating = $request->rating ?? 0;
        $medicine->price = $request->price;
        $medicine->sale_price = $request->sale_price;
        $medicine->pack_size = $request->pack_size;
        $medicine->pack_price = $request->pack_price;
        $medicine->pack_sale_price = $request->pack_sale_price;
        $medicine->status = $request->status ?? 'active';
        
        // Handle image upload
        if ($request->hasFile('image')) {
            $file = $request->file('image');
            $directoryPath = 'uploads/pharmacy/medicines';
            $filename = $file->getClientOriginalName();
            $ext = pathinfo($filename, PATHINFO_EXTENSION);
            $disk = (env('FILESYSTEM_DRIVER') === 'production') ? 's3' : 'local_public';
            
            // Set the new file name
            $newFilename = 'medicine_' . time() . '_' . rand(1000, 9999) . '.' . $ext;
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
            
            $medicine->image = $newFilename;
        }
        
        $medicine->save();

        // Save medicine details
        if ($medicine->id) {
            $details = new PharmacyMedicineDetail();
            $details->pharmacy_medicine_id = $medicine->id;
            $details->description = $request->description;
            $details->ingredients = $request->ingredients;
            $details->drug_class = $request->drug_class;
            $details->dosage_form = $request->dosage_form;
            $details->uses = $request->uses;
            $details->in_case_of_overdose = $request->in_case_of_overdose;
            $details->missed_dose = $request->missed_dose;
            $details->how_to_use = $request->how_to_use;
            $details->when_not_to_use = $request->when_not_to_use;
            $details->side_effects = $request->side_effects;
            $details->precautions_and_warnings = $request->precautions_and_warnings;
            $details->drug_interactions = $request->drug_interactions;
            $details->food_interactions = $request->food_interactions;
            $details->storage_or_disposal = $request->storage_or_disposal;
            $details->quick_tips = $request->quick_tips;
            $details->save();
        }

        Session::flash('message', 'Medicine Created Successfully');
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
        $medicine = PharmacyMedicine::with('details')->find($id);
        $medicines = PharmacyMedicine::with(['category', 'subcategory', 'details'])->orderBy('id', 'desc')->get();
        $categories = MedicineCategory::orderBy('name', 'asc')->get();
        $subcategories = MedicineSubcategory::orderBy('name', 'asc')->get();
        return view('back-end.admin.pharmacy.medicine.index', compact('medicine', 'medicines', 'categories', 'subcategories'));
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
            'medicine_category_id' => 'required',
        ]);

        $medicine = PharmacyMedicine::find($id);
        $medicine->medicine_category_id = $request->medicine_category_id;
        $medicine->medicine_subcategory_id = $request->medicine_subcategory_id;
        $medicine->name = $request->name;
        // Update slug if name changed
        if ($medicine->name !== $request->name) {
            $medicine->slug = \Illuminate\Support\Str::slug($request->name);
        }
        $medicine->manufacturer = $request->manufacturer;
        $medicine->generic_name = $request->generic_name;
        $medicine->rating = $request->rating ?? 0;
        $medicine->price = $request->price;
        $medicine->sale_price = $request->sale_price;
        $medicine->pack_size = $request->pack_size;
        $medicine->pack_price = $request->pack_price;
        $medicine->pack_sale_price = $request->pack_sale_price;
        $medicine->status = $request->status ?? 'active';
        
        // Handle image upload
        if ($request->hasFile('image')) {
            // Delete old image if exists
            if ($medicine->image) {
                $oldImagePath = 'uploads/pharmacy/medicines/' . $medicine->image;
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
            $directoryPath = 'uploads/pharmacy/medicines';
            $filename = $file->getClientOriginalName();
            $ext = pathinfo($filename, PATHINFO_EXTENSION);
            $disk = (env('FILESYSTEM_DRIVER') === 'production') ? 's3' : 'local_public';
            
            // Set the new file name
            $newFilename = 'medicine_' . time() . '_' . rand(1000, 9999) . '.' . $ext;
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
            
            $medicine->image = $newFilename;
        }
        
        $medicine->save();

        // Update or create medicine details
        $details = PharmacyMedicineDetail::where('pharmacy_medicine_id', $medicine->id)->first();
        if (!$details) {
            $details = new PharmacyMedicineDetail();
            $details->pharmacy_medicine_id = $medicine->id;
        }
        $details->description = $request->description;
        $details->ingredients = $request->ingredients;
        $details->drug_class = $request->drug_class;
        $details->dosage_form = $request->dosage_form;
        $details->uses = $request->uses;
        $details->in_case_of_overdose = $request->in_case_of_overdose;
        $details->missed_dose = $request->missed_dose;
        $details->how_to_use = $request->how_to_use;
        $details->when_not_to_use = $request->when_not_to_use;
        $details->side_effects = $request->side_effects;
        $details->precautions_and_warnings = $request->precautions_and_warnings;
        $details->drug_interactions = $request->drug_interactions;
        $details->food_interactions = $request->food_interactions;
        $details->storage_or_disposal = $request->storage_or_disposal;
        $details->quick_tips = $request->quick_tips;
        $details->save();

        Session::flash('message', 'Medicine Updated Successfully');
        return redirect()->route('pharmacy-medicine.index');
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
            return $server;
        }
        
        $json = array();
        $id = $request['id'];
        
        if (!empty($id)) {
            PharmacyMedicine::where('id', $id)->delete();
            $json['type'] = 'success';
            $json['message'] = 'Medicine Deleted Successfully';
            return response()->json($json);
        } else {
            $json['type'] = 'error';
            return response()->json($json);
        }
    }
}

