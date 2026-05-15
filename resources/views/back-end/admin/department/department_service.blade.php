@extends('back-end.master')
@push('backend_stylesheets')
<style type="text/css">
	#department_service thead tr th{
        min-width: 190px;
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
                            <h2>Manage Department Service</h2>
                        </div>
                        @if ($department_services->count() > 0)
                           <div class="dc-dashboardboxcontent dc-categoriescontentholder">
                                <table id="department_service"  class="table table-bordered table-hover dt-responsive nowrap table-responsive"cellspacing="0">
                                    <thead>
                                        <tr>
                                          
                                            <th>Department Title</th>
                                            <th>Service</th>
                                            <th>Description</th>
                                            <th class="action">{{{ trans('lang.action') }}}</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @php $counter = 0; @endphp
                                        @foreach ($department_services as $key => $department_service)
                                            <tr>
                                        <td>
                                            {{optional($department_service->departments)->title}}
                                        </td>
                                                <td>{{$department_service->service}}</td>
                                                <td>{!! $department_service->description !!}</td>
                                                <td>
                                                    <div class="dc-actionbtn">
                                                        <a href="{{action('DepartmentServiceController@edit',$department_service->id) }}" class="dc-addinfo dc-skillsaddinfo">
                                                            <i class="lnr lnr-pencil"></i>
                                                        </a>
                                                    <delete :title="'{{trans("lang.ph_delete_confirm_title")}}'" :id="'{{ intVal(clean($department_service->id)) }}'" :message="'{{trans("Department Service Deleted Successfully")}}'" :url="'{{url('admin/department-service/delete')}}'" :redirect_url="'{{url('admin/department-service')}}'"></delete>
                                                    </div>
                                                </td>
                                            </tr>
                                            @php $counter++; @endphp
                                        @endforeach
                                    </tbody>
                                </table>
                                @if ( method_exists($department_services,'links') )
                                    {{ $department_services->links('pagination.custom') }}
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

                        	<h2>Add Department Service</h2>
                <div class="dc-dashboardboxtitle">

                    <form action="{{ url('admin/store-department-service') }}"method="post"> 
                        {{csrf_field()}}
                        <div class="form-group">
                                <div class="form-group">
                                     <span class="dc-select">
                                    <select name="department_id" id="department_id" class="form-control">
                                       <option value="">Select Department</option>
                                       @foreach ($departments as $key => $department)
                                        <option value="{{$department->id}}">{{$department->title}}</option>
                                        @endforeach
                                        
                                    </select>
                                </span>
                                    @if ($errors->has('department_id'))  
                                           <p class="text-danger">{{$errors->first('department_id')}}</p>   
                                    @endif
                                     
                                </div>
                                <div class="form-group">
                                    <input type="text" name="service" id="tag2" class="form-control" placeholder="Enter Service" />
                                    @if ($errors->has('service'))  
                                          <br>
                                           <p class="text-danger">{{$errors->first('service')}}</p>   
                                    @endif  
                                    
                                </div>
                                 <div class="form-group">
                                    {!! Form::textarea( 'description', null, ['id' => 'description','class' =>'form-control', 'placeholder' => trans('lang.ph.desc')] ) !!}
                                </div> 
                                <div class="form-group dc-btnarea">
                                       <button type="submit" name="submit" class="dc-btn">Create Department Service</button>
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
        $('#department_service').DataTable();
      } );
</script>
@endpush
