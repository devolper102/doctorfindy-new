@extends('back-end.master')
@push('backend_stylesheets')
<style type="text/css">
    #medicine-subcategory thead tr th{
        min-width: 190px !important;
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
                            <h2>Manage Medicine Subcategory</h2>
                            <div class="dc-rightarea form_head">
                                <button type="button" class="dc-btn" data-toggle="modal" data-target="#addSubcategoryModal">
                                    <i class="fa fa-plus"></i> Add New
                                </button>
                            </div>
                        </div>  
                        @if ($subcategories->count() > 0)
                           <div class="dc-dashboardboxcontent dc-categoriescontentholder">
                                <table id="medicine-subcategory"  class="table table-bordered table-hover dt-responsive nowrap table-responsive"cellspacing="0">
                                    <thead>
                                        <tr>
                                            <th>Name</th>
                                            <th>Category</th>
                                            <th>Slug</th>
                                            <th>Status</th>
                                            <th class="action">{{{ trans('lang.action') }}}</th>
                                            <th>Created Date</th>
                                            <th>Updated Date</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @php $counter = 0; @endphp
                                        @foreach ($subcategories as $key => $subcategory)
                                            <tr class="del-{{{ $subcategory->id }}}">
                                        <td>
                                          {{$subcategory->name}}
                                        </td>
                                        <td>
                                            {{optional($subcategory->category)->name}}
                                        </td>
                                        <td>
                                            {{$subcategory->slug}}
                                        </td>
                                        <td>
                                            {{ucfirst($subcategory->status)}}
                                        </td>
                                                <td>
                                                    <div class="dc-actionbtn">
                                                        <a href="{{action('Admin\MedicineSubcategoryController@edit',$subcategory->id) }}" class="dc-addinfo dc-skillsaddinfo">
                                                            <i class="lnr lnr-pencil"></i>
                                                        </a>
                                                    <delete :title="'{{trans("lang.ph_delete_confirm_title")}}'" :id="'{{ intVal(clean($subcategory->id)) }}'" :message="'{{trans("Medicine Subcategory Deleted Successfully")}}'" :url="'{{url('admin/medicine-subcategory/delete')}}'" :redirect_url="'{{url('admin/medicine-subcategory')}}'"></delete>
                                                    </div>
                                                </td>
                                                <td>{{ $subcategory->created_at->format('M d, Y, H:i A') }}</td>
                                                <td>{{ $subcategory->updated_at->format('M d, Y, H:i A') }}</td>
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

    <!-- Add Subcategory Modal -->
    <div class="modal fade" id="addSubcategoryModal" tabindex="-1" role="dialog" aria-labelledby="addSubcategoryModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="addSubcategoryModalLabel">Add New Medicine Subcategory</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <form action="{{ url('admin/store-medicine-subcategory') }}" method="post">
                    {{csrf_field()}}
                    <div class="modal-body">
                        <div class="form-group">
                            <label for="name">Name <span class="text-danger">*</span></label>
                            <input type="text" name="name" id="name" value="{{ old('name') }}" class="form-control" placeholder="Enter Name" required />
                            @if ($errors->has('name'))  
                                <p class="text-danger">{{$errors->first('name')}}</p>   
                            @endif  
                        </div>
                        <div class="form-group">
                            <label for="category_id">Medicine Category <span class="text-danger">*</span></label>
                            <select name="category_id" id="category_id" class="form-control" required>
                                <option value="">Select Medicine Category</option>
                                @foreach ($categories as $key => $category)
                                    <option value="{{$category->id}}" {{ old('category_id') == $category->id ? 'selected' : '' }}>{{$category->name}}</option>
                                @endforeach
                            </select>
                            @if ($errors->has('category_id'))  
                                <p class="text-danger">{{$errors->first('category_id')}}</p>   
                            @endif
                        </div>
                        <div class="form-group">
                            <label for="subcategory_description">Description</label>
                            <textarea name="description" id="subcategory_description" class="form-control" placeholder="Enter Description" rows="3">{{ old('description') }}</textarea>
                        </div>
                        <div class="form-group">
                            <label for="meta_title">Meta Title</label>
                            <input type="text" name="meta_title" id="meta_title" value="{{ old('meta_title') }}" class="form-control" placeholder="Meta Title" />
                        </div>
                        <div class="form-group">
                            <label for="meta_description">Meta Description</label>
                            <textarea name="meta_description" id="meta_description" class="form-control" placeholder="Meta Description" rows="2">{{ old('meta_description') }}</textarea>
                        </div>
                        <div class="form-group">
                            <label for="status">Status</label>
                            <select name="status" id="status" class="form-control">
                                <option value="active" {{ old('status') == 'active' ? 'selected' : '' }}>Active</option>
                                <option value="inactive" {{ old('status') == 'inactive' ? 'selected' : '' }}>Inactive</option>
                            </select>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                        <button type="submit" class="dc-btn">Create Medicine Subcategory</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    @if(isset($subcategory) && request()->is('admin/medicine-subcategory/edit/*'))
    <!-- Edit Subcategory Modal -->
    <div class="modal fade" id="editSubcategoryModal" tabindex="-1" role="dialog" aria-labelledby="editSubcategoryModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="editSubcategoryModalLabel">Edit Medicine Subcategory</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <form action="{{ url('admin/medicine-subcategory/update/'.$subcategory->id) }}" method="post">
                    {{csrf_field()}}
                    <div class="modal-body">
                        <div class="form-group">
                            <label for="edit_name">Name <span class="text-danger">*</span></label>
                            <input type="text" name="name" id="edit_name" value="{{ $subcategory->name }}" class="form-control" placeholder="Enter Name" required />
                            @if ($errors->has('name'))  
                                <p class="text-danger">{{$errors->first('name')}}</p>   
                            @endif  
                        </div>
                        <div class="form-group">
                            <label for="edit_category_id">Medicine Category <span class="text-danger">*</span></label>
                            <select name="category_id" id="edit_category_id" class="form-control" required>
                                <option value="">Select Medicine Category</option>
                                @foreach ($categories as $key => $category)
                                    <option value="{{$category->id}}" {{ $subcategory->category_id == $category->id ? 'selected' : '' }}>{{$category->name}}</option>
                                @endforeach
                            </select>
                            @if ($errors->has('category_id'))  
                                <p class="text-danger">{{$errors->first('category_id')}}</p>   
                            @endif
                        </div>
                        <div class="form-group">
                            <label for="edit_subcategory_description">Description</label>
                            <textarea name="description" id="edit_subcategory_description" class="form-control" placeholder="Enter Description" rows="3">{{ $subcategory->description }}</textarea>
                        </div>
                        <div class="form-group">
                            <label for="edit_meta_title">Meta Title</label>
                            <input type="text" name="meta_title" id="edit_meta_title" value="{{ $subcategory->meta_title }}" class="form-control" placeholder="Meta Title" />
                        </div>
                        <div class="form-group">
                            <label for="edit_meta_description">Meta Description</label>
                            <textarea name="meta_description" id="edit_meta_description" class="form-control" placeholder="Meta Description" rows="2">{{ $subcategory->meta_description }}</textarea>
                        </div>
                        <div class="form-group">
                            <label for="edit_status">Status</label>
                            <select name="status" id="edit_status" class="form-control">
                                <option value="active" {{ $subcategory->status == 'active' ? 'selected' : '' }}>Active</option>
                                <option value="inactive" {{ $subcategory->status == 'inactive' ? 'selected' : '' }}>Inactive</option>
                            </select>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                        <button type="submit" class="dc-btn">Update Medicine Subcategory</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
    <script>
        $(document).ready(function() {
            $('#editSubcategoryModal').modal('show');
        });
    </script>
    @endif                    	
    </div>
       </section>                  	
</div>
@endsection
@push('scripts')
@stack('backend_scripts')
<script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.0/dist/js/bootstrap.bundle.min.js"></script>
<script type="text/javascript">
      $(document).ready(function() {
        $('#medicine-subcategory').DataTable();
      } );
</script>
<script src="//cdn.ckeditor.com/4.13.1/standard/ckeditor.js"></script>
<script type="text/javascript">
    if (document.getElementById('subcategory_description')) {
        CKEDITOR.replace('subcategory_description');
    }
    if (document.getElementById('edit_subcategory_description')) {
        CKEDITOR.replace('edit_subcategory_description');
    }
</script>
@endpush

