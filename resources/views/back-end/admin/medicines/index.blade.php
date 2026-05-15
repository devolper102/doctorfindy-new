@extends('back-end.master')
@push('backend_stylesheets')
<style type="text/css">
    #medicine thead tr th{
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
                            <h2>Manage Medicine</h2>
                        </div>  
                        @if ($medicines->count() > 0)
                           <div class="dc-dashboardboxcontent dc-categoriescontentholder">
                                <table id="medicine"  class="table table-bordered table-hover dt-responsive nowrap table-responsive"cellspacing="0">
                                    <thead>
                                        <tr>
                                          
                                            <th>Name</th>
                                            <th>Speciality Name</th>
                                            <th class="action">{{{ trans('lang.action') }}}</th>
                                            <th>Created Date</th>
                                            <th>Updated Date</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @php $counter = 0; @endphp
                                        @foreach ($medicines as $key => $medicine)
                                            <tr class="del-{{{ $medicine->id }}}">
                                        <td>
                                          {{$medicine->name}}
                                        </td>
                                        <td>
                                            {{optional($medicine->specialities)->title}}
                                        </td>
                                                <td>
                                                    <div class="dc-actionbtn">
                                                        <a href="{{action('MedicineController@edit',$medicine->id) }}" class="dc-addinfo dc-skillsaddinfo">
                                                            <i class="lnr lnr-pencil"></i>
                                                        </a>
                                                    <delete :title="'{{trans("lang.ph_delete_confirm_title")}}'" :id="'{{ intVal(clean($medicine->id)) }}'" :message="'{{trans("Medicine Deleted Successfully")}}'" :url="'{{url('admin/medicine/delete')}}'" :redirect_url="'{{url('admin/medicine')}}'"></delete>
                                                    </div>
                                                </td>
                                                <td>{{ $medicine->created_at->format('M d, Y, H:i A') }}</td>
                                                <td>{{ $medicine->created_at->format('M d, Y, H:i A') }}</td>
                                            </tr>
                                            @php $counter++; @endphp
                                        @endforeach
                                    </tbody>
                                </table>
                                @if ( method_exists($medicines,'links') )
                                    {{ $medicines->links('pagination.custom') }}
                                @endif
                            </div>
                        @else
                            @include('errors.no-record')
                        @endif
                    </div>
                </div>
            </div>    

    <div class="row">       
        <div class="col-xs-12 col-sm-12 col-md-12 col-lg-7 col-xl-6">
        <div class="dc-dashboardbox mt-5">
            <div class="dc-dashboardboxtitle dc-titlewithsearch dc-titlewithdel">

                        	<h2>Add Medicine</h2>
                <div class="dc-dashboardboxtitle">

                    <form action="{{ url('admin/store-medicine') }}"method="post"> 
                        {{csrf_field()}}
                        <div class="form-group">
                              <div class="form-group">
                                    <input type="text" name="name"  class="form-control" placeholder="Enter Name" />
                                    @if ($errors->has('name'))  
                                          <br>
                                           <p class="text-danger">{{$errors->first('name')}}</p>   
                                    @endif  
                                </div>
                                <div class="form-group">
                                     <span class="dc-select">
                                    <select name="category_id" id="category_id" class="form-control">
                                       <option value="">Select Medicine Category</option>
                                       @foreach ($categories as $key => $category)
                                        <option value="{{$category->id}}">{{$category->name}}</option>
                                       @endforeach
                                    </select>
                                </span>
                                    @if ($errors->has('category_id'))  
                                           <p class="text-danger">{{$errors->first('category_id')}}</p>   
                                    @endif
                                </div>
                                <div class="form-group">
                                     <span class="dc-select">
                                    <select name="subcategory_id" id="subcategory_id" class="form-control">
                                       <option value="">Select Medicine Sub Category</option>
                                       @foreach ($subcategories as $key => $subcategory)
                                        <option value="{{$subcategory->id}}">{{$subcategory->name}}</option>
                                       @endforeach
                                    </select>
                                </span>
                                    @if ($errors->has('subcategory_id'))  
                                           <p class="text-danger">{{$errors->first('subcategory_id')}}</p>   
                                    @endif
                                </div>
                                <div class="form-group">
                                     <span class="dc-select">
                                    <select name="speciality_id" id="speciality_id" class="form-control">
                                       <option value="">Select Speciality</option>
                                       @foreach ($specialities as $key => $speciality)
                                        <option value="{{$speciality->id}}">{{$speciality->title}}</option>
                                        @endforeach
                                        
                                    </select>
                                </span>
                                    @if ($errors->has('speciality_id'))  
                                           <p class="text-danger">{{$errors->first('speciality_id')}}</p>   
                                    @endif
                                     
                                </div>
                              
                                <div class="form-group dc-btnarea">
                                       <button type="submit" name="submit" class="dc-btn">Create Medicine</button>
                                </div>      
                                   
                        </div> 

                    </form>
                </div>
            </div>
        </div>
        </div>
    </div>                    	
    </div>
       </section>                  	
</div>
@endsection
@push('scripts')
@stack('backend_scripts')
<script type="text/javascript">
      $(document).ready(function() {
        $('#medicine').DataTable();
      } );
</script>
@endpush
