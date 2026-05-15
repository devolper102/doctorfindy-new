@extends('back-end.master')
@php
use Illuminate\Support\Facades\Storage;
@endphp
@push('backend_stylesheets')
<style type="text/css">
    #pharmacy-medicine thead tr th{
        min-width: 150px !important;
    }
    .nav-tabs .nav-link {
        padding: 0.5rem 1rem;
    }
</style>
@endpush
@section('content')
@include('includes.pre-loader')
    <div class="dc-services" id="services">
    	  @if (Session::has('message'))
            <div class="flash_msg">
                <flash_messages :message_class="'success'" :time ='5' :message="'{{{ Session::get('message') }}}'" v-cloak></flash_messages>
            </div>
        @elseif (Session::has('error'))
            <div class="flash_msg">
                <flash_messages :message_class="'danger'" :time ='5' :message="'{{{ Session::get('error') }}}'" v-cloak></flash_messages>
            </div>
        @endif
 <section class="dc-haslayout">
    <div class="row">
                <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12 col-xl-12">
                     <div class="dc-dashboardbox">
                        <div class="dc-dashboardboxtitle dc-titlewithsearch dc-titlewithdel">
                            <h2>Manage Pharmacy Medicines</h2>
                            <div class="dc-rightarea form_head">
                                <button type="button" class="dc-btn" data-toggle="modal" data-target="#addMedicineModal">
                                    <i class="fa fa-plus"></i> Add New
                                </button>
                            </div>
                        </div>  
                        @if ($medicines->count() > 0)
                           <div class="dc-dashboardboxcontent dc-categoriescontentholder">
                                <table id="pharmacy-medicine"  class="table table-bordered table-hover dt-responsive nowrap table-responsive"cellspacing="0">
                                    <thead>
                                        <tr>
                                            <th>Image</th>
                                            <th>Name</th>
                                            <th>Category</th>
                                            <th>Subcategory</th>
                                            <th>Manufacturer</th>
                                            <th>Price</th>
                                            <th>Status</th>
                                            <th class="action">{{{ trans('lang.action') }}}</th>
                                            <th>Created Date</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @php $counter = 0; @endphp
                                        @foreach ($medicines as $key => $medicine)
                                            <tr class="del-{{{ $medicine->id }}}" 
                                                data-medicine-id="{{ $medicine->id }}"
                                                data-medicine-name="{{ $medicine->name }}"
                                                data-medicine-category="{{ $medicine->medicine_category_id }}"
                                                data-medicine-subcategory="{{ $medicine->medicine_subcategory_id }}"
                                                data-medicine-manufacturer="{{ $medicine->manufacturer ?? '' }}"
                                                data-medicine-generic="{{ $medicine->generic_name ?? '' }}"
                                                data-medicine-rating="{{ $medicine->rating ?? 0 }}"
                                                data-medicine-price="{{ $medicine->price ?? 0 }}"
                                                data-medicine-sale-price="{{ $medicine->sale_price ?? 0 }}"
                                                data-medicine-pack-size="{{ $medicine->pack_size ?? '' }}"
                                                data-medicine-pack-price="{{ $medicine->pack_price ?? 0 }}"
                                                data-medicine-pack-sale-price="{{ $medicine->pack_sale_price ?? 0 }}"
                                                data-medicine-status="{{ $medicine->status }}"
                                                data-medicine-image="{{ $medicine->image ?? '' }}"
                                                data-medicine-description="{{ optional($medicine->details)->description ?? '' }}"
                                                data-medicine-ingredients="{{ optional($medicine->details)->ingredients ?? '' }}"
                                                data-medicine-drug-class="{{ optional($medicine->details)->drug_class ?? '' }}"
                                                data-medicine-dosage-form="{{ optional($medicine->details)->dosage_form ?? '' }}"
                                                data-medicine-uses="{{ optional($medicine->details)->uses ?? '' }}"
                                                data-medicine-how-to-use="{{ optional($medicine->details)->how_to_use ?? '' }}"
                                                data-medicine-when-not-to-use="{{ optional($medicine->details)->when_not_to_use ?? '' }}"
                                                data-medicine-side-effects="{{ optional($medicine->details)->side_effects ?? '' }}"
                                                data-medicine-precautions="{{ optional($medicine->details)->precautions_and_warnings ?? '' }}"
                                                data-medicine-drug-interactions="{{ optional($medicine->details)->drug_interactions ?? '' }}"
                                                data-medicine-food-interactions="{{ optional($medicine->details)->food_interactions ?? '' }}"
                                                data-medicine-overdose="{{ optional($medicine->details)->in_case_of_overdose ?? '' }}"
                                                data-medicine-missed-dose="{{ optional($medicine->details)->missed_dose ?? '' }}"
                                                data-medicine-storage="{{ optional($medicine->details)->storage_or_disposal ?? '' }}"
                                                data-medicine-tips="{{ optional($medicine->details)->quick_tips ?? '' }}"
                                                data-medicine-image-url="{{ $medicine->image_url }}">
                                        <td>
                                            @if($medicine->image)
                                                <img src="{{ $medicine->image_url }}" alt="{{ $medicine->name }}" style="max-width: 50px; max-height: 50px; border: 1px solid #ddd; padding: 2px; border-radius: 4px;" onerror="this.src='data:image/svg+xml,%3Csvg xmlns=\'http://www.w3.org/2000/svg\' width=\'50\' height=\'50\'%3E%3Crect width=\'50\' height=\'50\' fill=\'%23ddd\'/%3E%3Ctext x=\'50%25\' y=\'50%25\' text-anchor=\'middle\' dy=\'.3em\' fill=\'%23999\'%3ENo Image%3C/text%3E%3C/svg%3E';" />
                                            @else
                                                <span class="text-muted">No Image</span>
                                            @endif
                                        </td>
                                        <td>
                                          {{$medicine->name}}
                                        </td>
                                        <td>
                                            {{optional($medicine->category)->name ?? 'N/A'}}
                                        </td>
                                        <td>
                                            {{optional($medicine->subcategory)->name ?? 'N/A'}}
                                        </td>
                                        <td>
                                            {{$medicine->manufacturer ?? 'N/A'}}
                                        </td>
                                        <td>
                                            @if($medicine->sale_price)
                                                <span class="text-muted"><del>{{number_format($medicine->price, 2)}}</del></span>
                                                <span class="text-success">{{number_format($medicine->sale_price, 2)}}</span>
                                            @else
                                                {{number_format($medicine->price ?? 0, 2)}}
                                            @endif
                                        </td>
                                        <td>
                                            {{ucfirst($medicine->status)}}
                                        </td>
                                                <td>
                                                    <div class="dc-actionbtn">
                                                        <a href="javascript:void(0);" class="dc-addinfo dc-skillsaddinfo" data-toggle="modal" data-target="#editMedicineModal" data-medicine-id="{{ $medicine->id }}">
                                                            <i class="lnr lnr-pencil"></i>
                                                        </a>
                                                        <delete :title="'{{trans("lang.ph_delete_confirm_title")}}'" :id="'{{ intVal(clean($medicine->id)) }}'" :message="'{{trans("Medicine Deleted Successfully")}}'" :url="'{{url('admin/pharmacy-medicine/delete')}}'" :redirect_url="'{{url('admin/pharmacy-medicine')}}'"></delete>
                                                    </div>
                                                </td>
                                                <td>{{ $medicine->created_at->format('M d, Y, H:i A') }}</td>
                                            </tr>
                                            @php $counter++; @endphp
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>
                        @else
                            @include('errors.no-record')
                        @endif
                    </div>
                </div>
            </div>    

    <!-- Add Medicine Modal -->
    <div class="modal fade" id="addMedicineModal" tabindex="-1" role="dialog" aria-labelledby="addMedicineModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-xl" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="addMedicineModalLabel">Add New Medicine</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <form action="{{ url('admin/store-pharmacy-medicine') }}" method="post" enctype="multipart/form-data">
                    {{csrf_field()}}
                    <div class="modal-body">
                        <!-- Nav tabs -->
                        <ul class="nav nav-tabs" role="tablist">
                            <li class="nav-item">
                                <a class="nav-link active" data-toggle="tab" href="#basic-info">Basic Information</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" data-toggle="tab" href="#pricing">Pricing</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" data-toggle="tab" href="#details">Medicine Details</a>
                            </li>
                        </ul>

                        <!-- Tab panes -->
                        <div class="tab-content mt-3">
                            <!-- Basic Information Tab -->
                            <div id="basic-info" class="tab-pane active">
                                <div class="form-group">
                                    <label for="name">Medicine Name <span class="text-danger">*</span></label>
                                    <input type="text" name="name" id="name" value="{{ old('name') }}" class="form-control" placeholder="Enter Medicine Name" required />
                                    @if ($errors->has('name'))  
                                        <p class="text-danger">{{$errors->first('name')}}</p>   
                                    @endif  
                                </div>
                                <div class="form-group">
                                    <label for="image">Medicine Image</label>
                                    <input type="file" name="image" id="image" class="form-control" accept="image/*" />
                                    <small class="form-text text-muted">Upload medicine image (JPG, PNG, GIF, SVG)</small>
                                    @if ($errors->has('image'))  
                                        <p class="text-danger">{{$errors->first('image')}}</p>   
                                    @endif
                                </div>
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="medicine_category_id">Medicine Category <span class="text-danger">*</span></label>
                                            <select name="medicine_category_id" id="medicine_category_id" class="form-control" required>
                                                <option value="">Select Category</option>
                                                @foreach ($categories as $category)
                                                    <option value="{{$category->id}}" {{ old('medicine_category_id') == $category->id ? 'selected' : '' }}>{{$category->name}}</option>
                                                @endforeach
                                            </select>
                                            @if ($errors->has('medicine_category_id'))  
                                                <p class="text-danger">{{$errors->first('medicine_category_id')}}</p>   
                                            @endif
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="medicine_subcategory_id">Medicine Subcategory</label>
                                            <select name="medicine_subcategory_id" id="medicine_subcategory_id" class="form-control">
                                                <option value="">Select Subcategory</option>
                                                @foreach ($subcategories as $subcategory)
                                                    <option value="{{$subcategory->id}}" {{ old('medicine_subcategory_id') == $subcategory->id ? 'selected' : '' }}>{{$subcategory->name}}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="manufacturer">Manufacturer</label>
                                            <input type="text" name="manufacturer" id="manufacturer" value="{{ old('manufacturer') }}" class="form-control" placeholder="Enter Manufacturer" />
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="generic_name">Generic Name</label>
                                            <input type="text" name="generic_name" id="generic_name" value="{{ old('generic_name') }}" class="form-control" placeholder="Enter Generic Name" />
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="rating">Rating</label>
                                            <input type="number" name="rating" id="rating" value="{{ old('rating') }}" class="form-control" placeholder="0.00" step="0.01" min="0" max="5" />
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="status">Status</label>
                                            <select name="status" id="status" class="form-control">
                                                <option value="active" {{ old('status') == 'active' ? 'selected' : '' }}>Active</option>
                                                <option value="inactive" {{ old('status') == 'inactive' ? 'selected' : '' }}>Inactive</option>
                                            </select>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <!-- Pricing Tab -->
                            <div id="pricing" class="tab-pane fade">
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="price">Price</label>
                                            <input type="number" name="price" id="price" value="{{ old('price') }}" class="form-control" placeholder="0.00" step="0.01" min="0" />
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="sale_price">Sale Price</label>
                                            <input type="number" name="sale_price" id="sale_price" value="{{ old('sale_price') }}" class="form-control" placeholder="0.00" step="0.01" min="0" />
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label for="pack_size">Pack Size</label>
                                            <input type="text" name="pack_size" id="pack_size" value="{{ old('pack_size') }}" class="form-control" placeholder="e.g., 10 tablets" />
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label for="pack_price">Pack Price</label>
                                            <input type="number" name="pack_price" id="pack_price" value="{{ old('pack_price') }}" class="form-control" placeholder="0.00" step="0.01" min="0" />
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label for="pack_sale_price">Pack Sale Price</label>
                                            <input type="number" name="pack_sale_price" id="pack_sale_price" value="{{ old('pack_sale_price') }}" class="form-control" placeholder="0.00" step="0.01" min="0" />
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <!-- Medicine Details Tab -->
                            <div id="details" class="tab-pane fade">
                                <div class="form-group">
                                    <label for="medicine_description">Description</label>
                                    <textarea name="description" id="medicine_description" class="form-control" placeholder="Enter Description" rows="3">{{ old('description') }}</textarea>
                                </div>
                                <div class="form-group">
                                    <label for="ingredients">Ingredients</label>
                                    <textarea name="ingredients" id="ingredients" class="form-control" placeholder="Enter Ingredients" rows="2">{{ old('ingredients') }}</textarea>
                                </div>
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="drug_class">Drug Class</label>
                                            <input type="text" name="drug_class" id="drug_class" value="{{ old('drug_class') }}" class="form-control" placeholder="Enter Drug Class" />
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="dosage_form">Dosage Form</label>
                                            <input type="text" name="dosage_form" id="dosage_form" value="{{ old('dosage_form') }}" class="form-control" placeholder="e.g., Tablet, Capsule, Syrup" />
                                        </div>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label for="uses">Uses</label>
                                    <textarea name="uses" id="uses" class="form-control" placeholder="Enter Uses" rows="3">{{ old('uses') }}</textarea>
                                </div>
                                <div class="form-group">
                                    <label for="how_to_use">How to Use</label>
                                    <textarea name="how_to_use" id="how_to_use" class="form-control" placeholder="Enter How to Use" rows="2">{{ old('how_to_use') }}</textarea>
                                </div>
                                <div class="form-group">
                                    <label for="when_not_to_use">When Not to Use</label>
                                    <textarea name="when_not_to_use" id="when_not_to_use" class="form-control" placeholder="Enter When Not to Use" rows="2">{{ old('when_not_to_use') }}</textarea>
                                </div>
                                <div class="form-group">
                                    <label for="side_effects">Side Effects</label>
                                    <textarea name="side_effects" id="side_effects" class="form-control" placeholder="Enter Side Effects" rows="2">{{ old('side_effects') }}</textarea>
                                </div>
                                <div class="form-group">
                                    <label for="precautions_and_warnings">Precautions and Warnings</label>
                                    <textarea name="precautions_and_warnings" id="precautions_and_warnings" class="form-control" placeholder="Enter Precautions and Warnings" rows="2">{{ old('precautions_and_warnings') }}</textarea>
                                </div>
                                <div class="form-group">
                                    <label for="drug_interactions">Drug Interactions</label>
                                    <textarea name="drug_interactions" id="drug_interactions" class="form-control" placeholder="Enter Drug Interactions" rows="2">{{ old('drug_interactions') }}</textarea>
                                </div>
                                <div class="form-group">
                                    <label for="food_interactions">Food Interactions</label>
                                    <textarea name="food_interactions" id="food_interactions" class="form-control" placeholder="Enter Food Interactions" rows="2">{{ old('food_interactions') }}</textarea>
                                </div>
                                <div class="form-group">
                                    <label for="in_case_of_overdose">In Case of Overdose</label>
                                    <textarea name="in_case_of_overdose" id="in_case_of_overdose" class="form-control" placeholder="Enter In Case of Overdose" rows="2">{{ old('in_case_of_overdose') }}</textarea>
                                </div>
                                <div class="form-group">
                                    <label for="missed_dose">Missed Dose</label>
                                    <textarea name="missed_dose" id="missed_dose" class="form-control" placeholder="Enter Missed Dose Information" rows="2">{{ old('missed_dose') }}</textarea>
                                </div>
                                <div class="form-group">
                                    <label for="storage_or_disposal">Storage or Disposal</label>
                                    <textarea name="storage_or_disposal" id="storage_or_disposal" class="form-control" placeholder="Enter Storage or Disposal Information" rows="2">{{ old('storage_or_disposal') }}</textarea>
                                </div>
                                <div class="form-group">
                                    <label for="quick_tips">Quick Tips</label>
                                    <textarea name="quick_tips" id="quick_tips" class="form-control" placeholder="Enter Quick Tips" rows="2">{{ old('quick_tips') }}</textarea>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                        <button type="submit" class="dc-btn">Create Medicine</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <!-- Edit Medicine Modal -->
    <div class="modal fade" id="editMedicineModal" tabindex="-1" role="dialog" aria-labelledby="editMedicineModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-xl" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="editMedicineModalLabel">Edit Medicine</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <form action="javascript:void(0);" method="POST" id="editMedicineForm" enctype="multipart/form-data">
                    @csrf
                    <input type="hidden" name="medicine_id" id="hidden_medicine_id" value="">
                    <input type="hidden" name="medicine_id" id="hidden_medicine_id" value="">
                    <div class="modal-body">
                        <!-- Nav tabs -->
                        <ul class="nav nav-tabs" role="tablist">
                            <li class="nav-item">
                                <a class="nav-link active" data-toggle="tab" href="#edit-basic-info">Basic Information</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" data-toggle="tab" href="#edit-pricing">Pricing</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" data-toggle="tab" href="#edit-details">Medicine Details</a>
                            </li>
                        </ul>

                        <!-- Tab panes -->
                        <div class="tab-content mt-3">
                            <!-- Basic Information Tab -->
                            <div id="edit-basic-info" class="tab-pane active">
                                <div class="form-group">
                                    <label for="edit_name">Medicine Name <span class="text-danger">*</span></label>
                                    <input type="text" name="name" id="edit_name" value="{{ $medicine->name }}" class="form-control" placeholder="Enter Medicine Name" required />
                                    @if ($errors->has('name'))  
                                        <p class="text-danger">{{$errors->first('name')}}</p>   
                                    @endif  
                                </div>
                                <div class="form-group">
                                    <label for="edit_image">Medicine Image</label>
                                    @if($medicine->image)
                                        <div class="mb-2">
                                            <img src="{{ $medicine->image_url }}" alt="{{ $medicine->name }}" style="max-width: 200px; max-height: 200px; border: 1px solid #ddd; padding: 5px; border-radius: 4px;" onerror="this.style.display='none';" />
                                        </div>
                                    @endif
                                    <input type="file" name="image" id="edit_image" class="form-control" accept="image/*" />
                                    <small class="form-text text-muted">Upload new image to replace existing one (JPG, PNG, GIF, SVG)</small>
                                    @if ($errors->has('image'))  
                                        <p class="text-danger">{{$errors->first('image')}}</p>   
                                    @endif
                                </div>
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="edit_medicine_category_id">Medicine Category <span class="text-danger">*</span></label>
                                            <select name="medicine_category_id" id="edit_medicine_category_id" class="form-control" required>
                                                <option value="">Select Category</option>
                                                @foreach ($categories as $category)
                                                    <option value="{{$category->id}}" {{ $medicine->medicine_category_id == $category->id ? 'selected' : '' }}>{{$category->name}}</option>
                                                @endforeach
                                            </select>
                                            @if ($errors->has('medicine_category_id'))  
                                                <p class="text-danger">{{$errors->first('medicine_category_id')}}</p>   
                                            @endif
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="edit_medicine_subcategory_id">Medicine Subcategory</label>
                                            <select name="medicine_subcategory_id" id="edit_medicine_subcategory_id" class="form-control">
                                                <option value="">Select Subcategory</option>
                                                @foreach ($subcategories as $subcategory)
                                                    <option value="{{$subcategory->id}}" {{ $medicine->medicine_subcategory_id == $subcategory->id ? 'selected' : '' }}>{{$subcategory->name}}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="edit_manufacturer">Manufacturer</label>
                                            <input type="text" name="manufacturer" id="edit_manufacturer" value="{{ $medicine->manufacturer }}" class="form-control" placeholder="Enter Manufacturer" />
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="edit_generic_name">Generic Name</label>
                                            <input type="text" name="generic_name" id="edit_generic_name" value="{{ $medicine->generic_name }}" class="form-control" placeholder="Enter Generic Name" />
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="edit_rating">Rating</label>
                                            <input type="number" name="rating" id="edit_rating" value="{{ $medicine->rating }}" class="form-control" placeholder="0.00" step="0.01" min="0" max="5" />
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="edit_status">Status</label>
                                            <select name="status" id="edit_status" class="form-control">
                                                <option value="active" {{ $medicine->status == 'active' ? 'selected' : '' }}>Active</option>
                                                <option value="inactive" {{ $medicine->status == 'inactive' ? 'selected' : '' }}>Inactive</option>
                                            </select>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <!-- Pricing Tab -->
                            <div id="edit-pricing" class="tab-pane fade">
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="edit_price">Price</label>
                                            <input type="number" name="price" id="edit_price" value="{{ $medicine->price }}" class="form-control" placeholder="0.00" step="0.01" min="0" />
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="edit_sale_price">Sale Price</label>
                                            <input type="number" name="sale_price" id="edit_sale_price" value="{{ $medicine->sale_price }}" class="form-control" placeholder="0.00" step="0.01" min="0" />
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label for="edit_pack_size">Pack Size</label>
                                            <input type="text" name="pack_size" id="edit_pack_size" value="{{ $medicine->pack_size }}" class="form-control" placeholder="e.g., 10 tablets" />
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label for="edit_pack_price">Pack Price</label>
                                            <input type="number" name="pack_price" id="edit_pack_price" value="{{ $medicine->pack_price }}" class="form-control" placeholder="0.00" step="0.01" min="0" />
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label for="edit_pack_sale_price">Pack Sale Price</label>
                                            <input type="number" name="pack_sale_price" id="edit_pack_sale_price" value="{{ $medicine->pack_sale_price }}" class="form-control" placeholder="0.00" step="0.01" min="0" />
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <!-- Medicine Details Tab -->
                            <div id="edit-details" class="tab-pane fade">
                                <div class="form-group">
                                    <label for="edit_medicine_description">Description</label>
                                    <textarea name="description" id="edit_medicine_description" class="form-control" placeholder="Enter Description" rows="3">{{ $medicine->details->description ?? '' }}</textarea>
                                </div>
                                <div class="form-group">
                                    <label for="edit_ingredients">Ingredients</label>
                                    <textarea name="ingredients" id="edit_ingredients" class="form-control" placeholder="Enter Ingredients" rows="2">{{ $medicine->details->ingredients ?? '' }}</textarea>
                                </div>
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="edit_drug_class">Drug Class</label>
                                            <input type="text" name="drug_class" id="edit_drug_class" value="{{ $medicine->details->drug_class ?? '' }}" class="form-control" placeholder="Enter Drug Class" />
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="edit_dosage_form">Dosage Form</label>
                                            <input type="text" name="dosage_form" id="edit_dosage_form" value="{{ $medicine->details->dosage_form ?? '' }}" class="form-control" placeholder="e.g., Tablet, Capsule, Syrup" />
                                        </div>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label for="edit_uses">Uses</label>
                                    <textarea name="uses" id="edit_uses" class="form-control" placeholder="Enter Uses" rows="3">{{ $medicine->details->uses ?? '' }}</textarea>
                                </div>
                                <div class="form-group">
                                    <label for="edit_how_to_use">How to Use</label>
                                    <textarea name="how_to_use" id="edit_how_to_use" class="form-control" placeholder="Enter How to Use" rows="2">{{ $medicine->details->how_to_use ?? '' }}</textarea>
                                </div>
                                <div class="form-group">
                                    <label for="edit_when_not_to_use">When Not to Use</label>
                                    <textarea name="when_not_to_use" id="edit_when_not_to_use" class="form-control" placeholder="Enter When Not to Use" rows="2">{{ $medicine->details->when_not_to_use ?? '' }}</textarea>
                                </div>
                                <div class="form-group">
                                    <label for="edit_side_effects">Side Effects</label>
                                    <textarea name="side_effects" id="edit_side_effects" class="form-control" placeholder="Enter Side Effects" rows="2">{{ $medicine->details->side_effects ?? '' }}</textarea>
                                </div>
                                <div class="form-group">
                                    <label for="edit_precautions_and_warnings">Precautions and Warnings</label>
                                    <textarea name="precautions_and_warnings" id="edit_precautions_and_warnings" class="form-control" placeholder="Enter Precautions and Warnings" rows="2">{{ $medicine->details->precautions_and_warnings ?? '' }}</textarea>
                                </div>
                                <div class="form-group">
                                    <label for="edit_drug_interactions">Drug Interactions</label>
                                    <textarea name="drug_interactions" id="edit_drug_interactions" class="form-control" placeholder="Enter Drug Interactions" rows="2">{{ $medicine->details->drug_interactions ?? '' }}</textarea>
                                </div>
                                <div class="form-group">
                                    <label for="edit_food_interactions">Food Interactions</label>
                                    <textarea name="food_interactions" id="edit_food_interactions" class="form-control" placeholder="Enter Food Interactions" rows="2">{{ $medicine->details->food_interactions ?? '' }}</textarea>
                                </div>
                                <div class="form-group">
                                    <label for="edit_in_case_of_overdose">In Case of Overdose</label>
                                    <textarea name="in_case_of_overdose" id="edit_in_case_of_overdose" class="form-control" placeholder="Enter In Case of Overdose" rows="2">{{ $medicine->details->in_case_of_overdose ?? '' }}</textarea>
                                </div>
                                <div class="form-group">
                                    <label for="edit_missed_dose">Missed Dose</label>
                                    <textarea name="missed_dose" id="edit_missed_dose" class="form-control" placeholder="Enter Missed Dose Information" rows="2">{{ $medicine->details->missed_dose ?? '' }}</textarea>
                                </div>
                                <div class="form-group">
                                    <label for="edit_storage_or_disposal">Storage or Disposal</label>
                                    <textarea name="storage_or_disposal" id="edit_storage_or_disposal" class="form-control" placeholder="Enter Storage or Disposal Information" rows="2">{{ $medicine->details->storage_or_disposal ?? '' }}</textarea>
                                </div>
                                <div class="form-group">
                                    <label for="edit_quick_tips">Quick Tips</label>
                                    <textarea name="quick_tips" id="edit_quick_tips" class="form-control" placeholder="Enter Quick Tips" rows="2">{{ $medicine->details->quick_tips ?? '' }}</textarea>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                        <button type="submit" class="dc-btn">Update Medicine</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
                    	
    </div>
       </section>                  	
</div>
@endsection
@push('scripts')
@stack('backend_scripts')
<script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.0/dist/js/bootstrap.bundle.min.js"></script>
<script src="//cdn.ckeditor.com/4.13.1/standard/ckeditor.js"></script>
<script type="text/javascript">
      $(document).ready(function() {
        $('#pharmacy-medicine').DataTable();
        
        // Wait for CKEditor to be fully loaded
        if (typeof CKEDITOR === 'undefined') {
            console.error('CKEditor failed to load');
        } else {
            console.log('CKEditor loaded successfully, version:', CKEDITOR.version);
        }
        
        // Initialize CKEditor for add modal textareas
        var addModalTextareas = [
            'medicine_description',
            'ingredients',
            'uses',
            'how_to_use',
            'when_not_to_use',
            'side_effects',
            'precautions_and_warnings',
            'drug_interactions',
            'food_interactions',
            'in_case_of_overdose',
            'missed_dose',
            'storage_or_disposal',
            'quick_tips'
        ];
        
        // Function to initialize CKEditor for add modal
        function initAddModalEditors() {
            if (typeof CKEDITOR === 'undefined') {
                console.error('CKEditor is not loaded');
                return;
            }
            
            addModalTextareas.forEach(function(textareaId) {
                var element = document.getElementById(textareaId);
                if (element) {
                    // Destroy existing instance if any
                    if (CKEDITOR.instances[textareaId]) {
                        CKEDITOR.instances[textareaId].destroy(true);
                    }
                    
                    // Create new CKEditor instance
                    try {
                        var editor = CKEDITOR.replace(textareaId, {
                            height: 200
                        });
                        if (editor) {
                            console.log('CKEditor initialized for:', textareaId);
                        }
                    } catch (e) {
                        console.error('Error initializing CKEditor for ' + textareaId + ':', e);
                    }
                } else {
                    console.warn('Textarea element not found:', textareaId);
                }
            });
        }
        
        // Initialize CKEditor when add modal is shown
        $('#addMedicineModal').on('shown.bs.modal', function () {
            // Initialize CKEditor after modal is fully shown
            setTimeout(function() {
                initAddModalEditors();
            }, 200);
        });
        
        // Initialize CKEditor when details tab is shown (since textareas are in that tab)
        $('#addMedicineModal').on('shown.bs.tab', 'a[href="#details"]', function (e) {
            setTimeout(function() {
                initAddModalEditors();
            }, 150);
        });
        
        // Also initialize on tab click (before shown event)
        $('#addMedicineModal').on('click', 'a[href="#details"]', function (e) {
            setTimeout(function() {
                initAddModalEditors();
            }, 200);
        });
        
        // Destroy CKEditor instances when add modal is hidden
        $('#addMedicineModal').on('hidden.bs.modal', function () {
            addModalTextareas.forEach(function(textareaId) {
                if (CKEDITOR.instances[textareaId]) {
                    CKEDITOR.instances[textareaId].destroy();
                }
            });
        });
        
        // Store CKEditor instances for edit modal
        var editModalTextareas = [
            'edit_medicine_description',
            'edit_ingredients',
            'edit_uses',
            'edit_how_to_use',
            'edit_when_not_to_use',
            'edit_side_effects',
            'edit_precautions_and_warnings',
            'edit_drug_interactions',
            'edit_food_interactions',
            'edit_in_case_of_overdose',
            'edit_missed_dose',
            'edit_storage_or_disposal',
            'edit_quick_tips'
        ];
        
        // Function to initialize CKEditor for edit modal
        function initEditModalEditors() {
            editModalTextareas.forEach(function(textareaId) {
                var element = document.getElementById(textareaId);
                if (element && !CKEDITOR.instances[textareaId]) {
                    CKEDITOR.replace(textareaId);
                }
            });
        }
        
        // Function to destroy CKEditor instances for edit modal
        function destroyEditModalEditors() {
            editModalTextareas.forEach(function(textareaId) {
                if (CKEDITOR.instances[textareaId]) {
                    CKEDITOR.instances[textareaId].destroy();
                }
            });
        }
        
        // Store medicine ID when edit button is clicked
        var currentMedicineId = null;
        
        // Set form action immediately when edit button is clicked (before modal opens)
        $(document).on('click', 'a[data-medicine-id][data-target="#editMedicineModal"]', function(e) {
            currentMedicineId = $(this).data('medicine-id');
            if (currentMedicineId) {
                var updateUrl = '{{ url("admin/pharmacy-medicine/update") }}/' + currentMedicineId;
                $('#editMedicineForm').attr('action', updateUrl);
                $('#hidden_medicine_id').val(currentMedicineId);
                console.log('Form action set immediately to:', updateUrl);
            }
        });
        
        // Handle edit button click - trigger when modal is about to show
        $('#editMedicineModal').on('show.bs.modal', function (event) {
            var button = $(event.relatedTarget); // Button that triggered the modal
            currentMedicineId = button.data('medicine-id'); // Extract info from data-* attributes
            var row = button.closest('tr');
            
            if (!currentMedicineId || !row.length) {
                console.error('Medicine ID not found');
                return; // Exit if no medicine ID found
            }
            
            // Set form action - construct URL similar to category form
            // Use the same pattern as category: url('admin/medicine-category/update/'.$category->id)
            var updateUrl = '{{ url("admin/pharmacy-medicine/update") }}/' + currentMedicineId;
            $('#editMedicineForm').attr('action', updateUrl);
            $('#hidden_medicine_id').val(currentMedicineId);
            
            // Ensure form method is POST
            $('#editMedicineForm').attr('method', 'POST');
            
            console.log('Form action set to:', updateUrl, 'Medicine ID:', currentMedicineId);
            
            // Double-check action is set (sometimes Bootstrap modal interferes)
            setTimeout(function() {
                var verifyAction = $('#editMedicineForm').attr('action');
                if (verifyAction !== updateUrl) {
                    console.warn('Action was changed, resetting to:', updateUrl);
                    $('#editMedicineForm').attr('action', updateUrl);
                }
            }, 50);
            
            // Populate basic info
            $('#edit_name').val(row.data('medicine-name'));
            $('#edit_medicine_category_id').val(row.data('medicine-category'));
            $('#edit_medicine_subcategory_id').val(row.data('medicine-subcategory'));
            $('#edit_manufacturer').val(row.data('medicine-manufacturer'));
            $('#edit_generic_name').val(row.data('medicine-generic'));
            $('#edit_rating').val(row.data('medicine-rating'));
            $('#edit_status').val(row.data('medicine-status'));
            
            // Populate pricing
            $('#edit_price').val(row.data('medicine-price'));
            $('#edit_sale_price').val(row.data('medicine-sale-price'));
            $('#edit_pack_size').val(row.data('medicine-pack-size'));
            $('#edit_pack_price').val(row.data('medicine-pack-price'));
            $('#edit_pack_sale_price').val(row.data('medicine-pack-sale-price'));
            
            // Populate details - set values first, CKEditor will be initialized later
            $('#edit_medicine_description').val(row.data('medicine-description') || '');
            $('#edit_ingredients').val(row.data('medicine-ingredients') || '');
            $('#edit_drug_class').val(row.data('medicine-drug-class') || '');
            $('#edit_dosage_form').val(row.data('medicine-dosage-form') || '');
            $('#edit_uses').val(row.data('medicine-uses') || '');
            $('#edit_how_to_use').val(row.data('medicine-how-to-use') || '');
            $('#edit_when_not_to_use').val(row.data('medicine-when-not-to-use') || '');
            $('#edit_side_effects').val(row.data('medicine-side-effects') || '');
            $('#edit_precautions_and_warnings').val(row.data('medicine-precautions') || '');
            $('#edit_drug_interactions').val(row.data('medicine-drug-interactions') || '');
            $('#edit_food_interactions').val(row.data('medicine-food-interactions') || '');
            $('#edit_in_case_of_overdose').val(row.data('medicine-overdose') || '');
            $('#edit_missed_dose').val(row.data('medicine-missed-dose') || '');
            $('#edit_storage_or_disposal').val(row.data('medicine-storage') || '');
            $('#edit_quick_tips').val(row.data('medicine-tips') || '');
            
            // Update image preview if exists
            var imageUrl = row.data('medicine-image-url');
            if (imageUrl && imageUrl !== '') {
                var imagePreview = '<div class="mb-2"><img src="' + imageUrl + '" alt="' + row.data('medicine-name') + '" style="max-width: 200px; max-height: 200px; border: 1px solid #ddd; padding: 5px; border-radius: 4px;" onerror="this.style.display=\'none\';" /></div>';
                $('#edit_image').closest('.form-group').find('.mb-2').remove();
                $('#edit_image').before(imagePreview);
            } else {
                $('#edit_image').closest('.form-group').find('.mb-2').remove();
            }
            
            // Reset tabs to first tab
            $('.nav-tabs a[href="#edit-basic-info"]').tab('show');
            
            // Destroy existing CKEditor instances first
            destroyEditModalEditors();
            
            // Initialize CKEditor for edit modal after a short delay to ensure fields are populated
            setTimeout(function() {
                initEditModalEditors();
                
                // Set CKEditor content after initialization
                setTimeout(function() {
                    if (CKEDITOR.instances['edit_medicine_description']) {
                        CKEDITOR.instances['edit_medicine_description'].setData(row.data('medicine-description') || '');
                    }
                    if (CKEDITOR.instances['edit_ingredients']) {
                        CKEDITOR.instances['edit_ingredients'].setData(row.data('medicine-ingredients') || '');
                    }
                    if (CKEDITOR.instances['edit_uses']) {
                        CKEDITOR.instances['edit_uses'].setData(row.data('medicine-uses') || '');
                    }
                    if (CKEDITOR.instances['edit_how_to_use']) {
                        CKEDITOR.instances['edit_how_to_use'].setData(row.data('medicine-how-to-use') || '');
                    }
                    if (CKEDITOR.instances['edit_when_not_to_use']) {
                        CKEDITOR.instances['edit_when_not_to_use'].setData(row.data('medicine-when-not-to-use') || '');
                    }
                    if (CKEDITOR.instances['edit_side_effects']) {
                        CKEDITOR.instances['edit_side_effects'].setData(row.data('medicine-side-effects') || '');
                    }
                    if (CKEDITOR.instances['edit_precautions_and_warnings']) {
                        CKEDITOR.instances['edit_precautions_and_warnings'].setData(row.data('medicine-precautions') || '');
                    }
                    if (CKEDITOR.instances['edit_drug_interactions']) {
                        CKEDITOR.instances['edit_drug_interactions'].setData(row.data('medicine-drug-interactions') || '');
                    }
                    if (CKEDITOR.instances['edit_food_interactions']) {
                        CKEDITOR.instances['edit_food_interactions'].setData(row.data('medicine-food-interactions') || '');
                    }
                    if (CKEDITOR.instances['edit_in_case_of_overdose']) {
                        CKEDITOR.instances['edit_in_case_of_overdose'].setData(row.data('medicine-overdose') || '');
                    }
                    if (CKEDITOR.instances['edit_missed_dose']) {
                        CKEDITOR.instances['edit_missed_dose'].setData(row.data('medicine-missed-dose') || '');
                    }
                    if (CKEDITOR.instances['edit_storage_or_disposal']) {
                        CKEDITOR.instances['edit_storage_or_disposal'].setData(row.data('medicine-storage') || '');
                    }
                    if (CKEDITOR.instances['edit_quick_tips']) {
                        CKEDITOR.instances['edit_quick_tips'].setData(row.data('medicine-tips') || '');
                    }
                }, 200);
            }, 300);
        });
        
        // Prevent form submission if action is not set correctly
        $('#editMedicineForm').on('submit', function(e) {
            var formAction = $(this).attr('action');
            var medicineId = $('#hidden_medicine_id').val();
            
            console.log('Form submitting to:', formAction, 'Medicine ID:', medicineId);
            
            // Check if action is set correctly
            if (!formAction || formAction === '#' || formAction === 'javascript:void(0);' || !formAction.includes('/update/')) {
                e.preventDefault();
                alert('Error: Form action not set correctly. Please close and reopen the edit modal.');
                console.error('Invalid form action:', formAction);
                return false;
            }
            
            // Extract ID from URL and verify
            var urlParts = formAction.split('/update/');
            if (urlParts.length < 2 || !urlParts[1] || urlParts[1] === '0' || urlParts[1] === '') {
                e.preventDefault();
                alert('Error: Medicine ID not found in URL. Please try again.');
                console.error('Invalid medicine ID in URL:', formAction);
                return false;
            }
        });
        
        // Reset form when modal is closed
        $('#editMedicineModal').on('hidden.bs.modal', function () {
            // Destroy CKEditor instances before resetting form
            destroyEditModalEditors();
            $('#editMedicineForm')[0].reset();
            $('#edit_image').closest('.form-group').find('.mb-2').remove();
            currentMedicineId = null;
        });
      } );
</script>
@endpush

