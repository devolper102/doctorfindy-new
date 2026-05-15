@extends('back-end.master')
@push('backend_stylesheets')
<style type="text/css">
    #medicine-category thead tr th{
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
                            <h2>Manage Medicine Category</h2>
                            <div class="dc-rightarea form_head">
                                <button type="button" class="dc-btn" data-toggle="modal" data-target="#addCategoryModal">
                                    <i class="fa fa-plus"></i> Add New
                                </button>
                            </div>
                        </div>  
                        @if ($categories->count() > 0)
                           <div class="dc-dashboardboxcontent dc-categoriescontentholder">
                                <table id="medicine-category"  class="table table-bordered table-hover dt-responsive nowrap table-responsive"cellspacing="0">
                                    <thead>
                                        <tr>
                                            <th>Image</th>
                                            <th>Name</th>
                                            <th>Slug</th>
                                            <th>Status</th>
                                            <th class="action">{{{ trans('lang.action') }}}</th>
                                            <th>Created Date</th>
                                            <th>Updated Date</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @php $counter = 0; @endphp
                                        @foreach ($categories as $key => $category)
                                            <tr class="del-{{{ $category->id }}}"
                                                data-category-id="{{ $category->id }}"
                                                data-category-name="{{ $category->name }}"
                                                data-category-slug="{{ $category->slug }}"
                                                data-category-description="{{ $category->description ?? '' }}"
                                                data-category-meta-title="{{ $category->meta_title ?? '' }}"
                                                data-category-meta-description="{{ $category->meta_description ?? '' }}"
                                                data-category-status="{{ $category->status }}"
                                                data-category-image="{{ $category->image ?? '' }}"
                                                data-category-image-url="{{ $category->image_url ?? '' }}">
                                        <td>
                                            @if($category->image)
                                                <img src="{{ $category->image_url }}" alt="{{ $category->name }}" style="max-width: 50px; max-height: 50px; border: 1px solid #ddd; padding: 2px; border-radius: 4px;" onerror="this.src='data:image/svg+xml,%3Csvg xmlns=\'http://www.w3.org/2000/svg\' width=\'50\' height=\'50\'%3E%3Crect width=\'50\' height=\'50\' fill=\'%23ddd\'/%3E%3Ctext x=\'50%25\' y=\'50%25\' text-anchor=\'middle\' dy=\'.3em\' fill=\'%23999\'%3ENo Image%3C/text%3E%3C/svg%3E';" />
                                            @else
                                                <span class="text-muted">No Image</span>
                                            @endif
                                        </td>
                                        <td>
                                          {{$category->name}}
                                        </td>
                                        <td>
                                            {{$category->slug}}
                                        </td>
                                        <td>
                                            {{ucfirst($category->status)}}
                                        </td>
                                                <td>
                                                    <div class="dc-actionbtn">
                                                        <a href="javascript:void(0);" class="dc-addinfo dc-skillsaddinfo" data-toggle="modal" data-target="#editCategoryModal" data-category-id="{{ $category->id }}">
                                                            <i class="lnr lnr-pencil"></i>
                                                        </a>
                                                        <delete :title="'{{trans("lang.ph_delete_confirm_title")}}'" :id="'{{ intVal(clean($category->id)) }}'" :message="'{{trans("Medicine Category Deleted Successfully")}}'" :url="'{{url('admin/medicine-category/delete')}}'" :redirect_url="'{{url('admin/medicine-category')}}'"></delete>
                                                    </div>
                                                </td>
                                                <td>{{ $category->created_at->format('M d, Y, H:i A') }}</td>
                                                <td>{{ $category->updated_at->format('M d, Y, H:i A') }}</td>
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

    <!-- Add Category Modal -->
    <div class="modal fade" id="addCategoryModal" tabindex="-1" role="dialog" aria-labelledby="addCategoryModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="addCategoryModalLabel">Add New Medicine Category</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <form action="{{ url('admin/store-medicine-category') }}" method="post" enctype="multipart/form-data">
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
                            <label for="category_image">Image</label>
                            <input type="file" name="image" id="category_image" class="form-control" accept="image/*" />
                            <small class="form-text text-muted">Upload category image (JPG, PNG, GIF)</small>
                            @if ($errors->has('image'))  
                                <p class="text-danger">{{$errors->first('image')}}</p>   
                            @endif  
                            <div id="category_image_preview" class="mt-2" style="display: none;">
                                <img id="category_image_preview_img" src="" alt="Preview" style="max-width: 200px; max-height: 200px; border: 1px solid #ddd; padding: 5px; border-radius: 4px;" />
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="category_description">Description</label>
                            <textarea name="description" id="category_description" class="form-control" placeholder="Enter Description" rows="3">{{ old('description') }}</textarea>
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
                        <button type="submit" class="dc-btn">Create Medicine Category</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <!-- Edit Category Modal -->
    <div class="modal fade" id="editCategoryModal" tabindex="-1" role="dialog" aria-labelledby="editCategoryModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="editCategoryModalLabel">Edit Medicine Category</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <form action="" method="post" id="editCategoryForm" enctype="multipart/form-data">
                    {{csrf_field()}}
                    <div class="modal-body">
                        <div class="form-group">
                            <label for="edit_name">Name <span class="text-danger">*</span></label>
                            <input type="text" name="name" id="edit_name" class="form-control" placeholder="Enter Name" required />
                            @if ($errors->has('name'))  
                                <p class="text-danger">{{$errors->first('name')}}</p>   
                            @endif  
                        </div>
                        <div class="form-group">
                            <label for="edit_category_image">Image</label>
                            <div id="edit_category_current_image" class="mb-2" style="display: none;">
                                <img id="edit_category_current_image_img" src="" alt="Current Image" style="max-width: 200px; max-height: 200px; border: 1px solid #ddd; padding: 5px; border-radius: 4px;" />
                                <p class="text-muted small mt-1">Current Image</p>
                            </div>
                            <input type="file" name="image" id="edit_category_image" class="form-control" accept="image/*" />
                            <small class="form-text text-muted">Upload new image to replace current one (JPG, PNG, GIF)</small>
                            @if ($errors->has('image'))  
                                <p class="text-danger">{{$errors->first('image')}}</p>   
                            @endif  
                            <div id="edit_category_image_preview" class="mt-2" style="display: none;">
                                <img id="edit_category_image_preview_img" src="" alt="Preview" style="max-width: 200px; max-height: 200px; border: 1px solid #ddd; padding: 5px; border-radius: 4px;" />
                                <p class="text-muted small mt-1">New Image Preview</p>
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="edit_category_description">Description</label>
                            <textarea name="description" id="edit_category_description" class="form-control" placeholder="Enter Description" rows="3"></textarea>
                        </div>
                        <div class="form-group">
                            <label for="edit_meta_title">Meta Title</label>
                            <input type="text" name="meta_title" id="edit_meta_title" class="form-control" placeholder="Meta Title" />
                        </div>
                        <div class="form-group">
                            <label for="edit_meta_description">Meta Description</label>
                            <textarea name="meta_description" id="edit_meta_description" class="form-control" placeholder="Meta Description" rows="2"></textarea>
                        </div>
                        <div class="form-group">
                            <label for="edit_status">Status</label>
                            <select name="status" id="edit_status" class="form-control">
                                <option value="active">Active</option>
                                <option value="inactive">Inactive</option>
                            </select>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                        <button type="submit" class="dc-btn">Update Medicine Category</button>
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
<script type="text/javascript">
      $(document).ready(function() {
        $('#medicine-category').DataTable();
      } );
</script>
<script src="//cdn.ckeditor.com/4.13.1/standard/ckeditor.js"></script>
<script type="text/javascript">
    if (document.getElementById('category_description')) {
        CKEDITOR.replace('category_description');
    }
    if (document.getElementById('edit_category_description')) {
        CKEDITOR.replace('edit_category_description');
    }

    // Image preview for add modal
    document.getElementById('category_image').addEventListener('change', function(e) {
        var file = e.target.files[0];
        if (file) {
            var reader = new FileReader();
            reader.onload = function(e) {
                document.getElementById('category_image_preview_img').src = e.target.result;
                document.getElementById('category_image_preview').style.display = 'block';
            }
            reader.readAsDataURL(file);
        } else {
            document.getElementById('category_image_preview').style.display = 'none';
        }
    });

    // Image preview for edit modal
    document.getElementById('edit_category_image').addEventListener('change', function(e) {
        var file = e.target.files[0];
        if (file) {
            var reader = new FileReader();
            reader.onload = function(e) {
                document.getElementById('edit_category_image_preview_img').src = e.target.result;
                document.getElementById('edit_category_image_preview').style.display = 'block';
            }
            reader.readAsDataURL(file);
        } else {
            document.getElementById('edit_category_image_preview').style.display = 'none';
        }
    });

    // Handle edit category modal
    var currentCategoryId = null;
    
    // Set form action immediately when edit button is clicked
    $(document).on('click', 'a[data-category-id][data-target="#editCategoryModal"]', function(e) {
        e.preventDefault();
        currentCategoryId = $(this).data('category-id');
        if (currentCategoryId) {
            var updateUrl = '{{ url("admin/medicine-category/update") }}/' + currentCategoryId;
            $('#editCategoryForm').attr('action', updateUrl);
            console.log('Form action set to:', updateUrl);
        }
    });
    
    // Populate edit modal when it opens
    $('#editCategoryModal').on('show.bs.modal', function (event) {
        var button = $(event.relatedTarget);
        currentCategoryId = button.data('category-id');
        var row = button.closest('tr');
        
        if (!currentCategoryId || !row.length) {
            console.error('Category ID not found');
            return;
        }
        
        // Set form action
        var updateUrl = '{{ url("admin/medicine-category/update") }}/' + currentCategoryId;
        $('#editCategoryForm').attr('action', updateUrl);
        $('#editCategoryForm').attr('method', 'POST');
        
        console.log('Loading category ID:', currentCategoryId);
        
        // Populate form fields from data attributes
        $('#edit_name').val(row.data('category-name') || '');
        $('#edit_category_description').val(row.data('category-description') || '');
        $('#edit_meta_title').val(row.data('category-meta-title') || '');
        $('#edit_meta_description').val(row.data('category-meta-description') || '');
        $('#edit_status').val(row.data('category-status') || 'active');
        
        // Update CKEditor if it exists
        if (typeof CKEDITOR !== 'undefined' && CKEDITOR.instances['edit_category_description']) {
            CKEDITOR.instances['edit_category_description'].setData(row.data('category-description') || '');
        }
        
        // Handle current image display
        var imageUrl = row.data('category-image-url');
        var currentImageDiv = $('#edit_category_current_image');
        var currentImageImg = $('#edit_category_current_image_img');
        
        if (imageUrl && imageUrl !== '') {
            currentImageImg.attr('src', imageUrl);
            currentImageDiv.show();
        } else {
            currentImageDiv.hide();
        }
        
        // Reset image preview
        $('#edit_category_image_preview').hide();
        $('#edit_category_image').val('');
        
        // Double-check action is set
        setTimeout(function() {
            var verifyAction = $('#editCategoryForm').attr('action');
            if (verifyAction !== updateUrl) {
                console.warn('Action was changed, resetting to:', updateUrl);
                $('#editCategoryForm').attr('action', updateUrl);
            }
        }, 50);
    });
    
    // Reset form when modal is closed
    $('#editCategoryModal').on('hidden.bs.modal', function () {
        $('#editCategoryForm')[0].reset();
        $('#edit_category_current_image').hide();
        $('#edit_category_image_preview').hide();
        if (typeof CKEDITOR !== 'undefined' && CKEDITOR.instances['edit_category_description']) {
            CKEDITOR.instances['edit_category_description'].setData('');
        }
        currentCategoryId = null;
    });
</script>
@endpush

