@extends('back-end.master')
@push('backend_stylesheets')
<style type="text/css">
	#department thead tr th{
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
                            <h2>Manage Departments</h2>
                        </div>
                        @if ($departments->count() > 0)
                           <div class="dc-dashboardboxcontent dc-categoriescontentholder">
                                <table id="department"  class="table table-bordered table-hover dt-responsive nowrap table-responsive"cellspacing="0">
                                    <thead>
                                        <tr>
                                            <th>Title</th>
                                            <th>Description</th>
                                            <th class="action">{{{ trans('lang.action') }}}</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @php $counter = 0; @endphp
                                        @foreach ($departments as $key => $department)
                                            <tr>
                                                <td>{{$department->title}}</td>
                                                <td>{!! $department->description !!}</td>
                                                <td>
                                                    <div class="dc-actionbtn">
                                                        <a href="{{action('DepartmentController@edit',$department->id) }}" class="dc-addinfo dc-skillsaddinfo">
                                                            <i class="lnr lnr-pencil"></i>
                                                        </a>
                                                
                                                    <delete :title="'{{trans("lang.ph_delete_confirm_title")}}'" :id="'{{ intVal(clean($department->id)) }}'" :message="'{{trans("Department Deleted Successfully")}}'" :url="'{{url('admin/department/delete')}}'" :redirect_url="'{{url('admin/department')}}'"></delete>

                                                    </div>
                                                </td>
                                            </tr>
                                            @php $counter++; @endphp
                                        @endforeach
                                    </tbody>
                                </table>
                                @if ( method_exists($departments,'links') )
                                    {{ $departments->links('pagination.custom') }}
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

                        	<h2>Add New Department</h2>
                <div class="dc-dashboardboxtitle">

                    <form action="{{ url('admin/store-department') }}"method="post"> 
                        {{csrf_field()}}
                        <div class="form-group">
                                <div class="form-group">
                                    <input type="text" name="title"  class="form-control" placeholder="Enter Department" />
                                    @if ($errors->has('title'))  
                                           <p class="text-danger">{{$errors->first('title')}}</p>   
                                    @endif  
                                    
                                </div>
                              
                                 <div class="form-group">
                                    {!! Form::textarea( 'description', null, ['id' => 'description','class' =>'form-control', 'placeholder' => trans('lang.ph.desc')] ) !!}
                                </div> 
                                <div class="form-group dc-btnarea">
                                       <button type="submit" name="submit" class="dc-btn">Create Department</button>
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
        $('#department').DataTable();
      } );
</script>
@endpush
