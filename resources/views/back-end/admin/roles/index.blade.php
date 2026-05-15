@extends('back-end.master')
@push('backend_stylesheets')
<style type="text/css">
	
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
                            <h2 style="margin: 15px;">Manage Roles</h2>
                        </div>
                        @if ($roles->count() > 0)
                           <div class="dc-dashboardboxcontent dc-categoriescontentholder">
                                <table id="department"  class="table table-striped table-bordered dt-responsive nowrap table-responsive"cellspacing="0">
                                    <thead>
                                        <tr>
                                            <th>Name</th>
                                            <th>Role Type</th>
                                            <th>Guard Name</th>
                                            <th class="action">{{{ trans('lang.action') }}}</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @php $counter = 0; @endphp
                                        @foreach ($roles as $key => $role)
                                            <tr>
                                                <td>{{$role->name}}</td>
                                                <td>{{$role->role_type}}</td>
                                                <td>{{$role->guard_name}}</td>
                                                <td>
                                                    <div class="dc-actionbtn">
                                                        <a href="{{action('RolesController@edit',$role->id) }}" class="dc-addinfo dc-skillsaddinfo">
                                                            <i class="lnr lnr-pencil"></i>
                                                        </a>
                                                
                                                    <delete :title="'{{trans("lang.ph_delete_confirm_title")}}'" :id="'{{ intVal(clean($role->id)) }}'" :message="'{{trans("Role Deleted Successfully")}}'" :url="'{{url('admin/role/delete')}}'" :redirect_url="'{{url('admin/role')}}'"></delete>

                                                    </div>
                                                </td>
                                            </tr>
                                            @php $counter++; @endphp
                                        @endforeach
                                    </tbody>
                                </table>
                                @if ( method_exists($roles,'links') )
                                    {{ $roles->links('pagination.custom') }}
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
        <div class="dc-dashboardbox mt-4">
            <div class="dc-dashboardboxtitle dc-titlewithsearch dc-titlewithdel">

                        	<h2 style="margin: 15px;">Add New Role</h2>
                <div class="dc-dashboardboxtitle">

                    <form action="{{ url('admin/store-role') }}"method="post"> 
                        {{csrf_field()}}
                        <div class="form-group">
                                <div class="form-group">
                                    <input type="text" name="name" class="form-control" placeholder="Enter Role Name" />
                                    @if ($errors->has('name'))  
                                           <p class="text-danger">{{$errors->first('name')}}</p>   
                                    @endif  
                                </div>
                              
                             <div class="form-group">
                                    <input type="text" name="role_type" id="tag2" class="form-control" placeholder="Enter Role Type" />
                                    @if ($errors->has('role_type'))  
                                           <p class="text-danger">{{$errors->first('role_type')}}</p>   
                                    @endif  
                                </div>
                                <div class="form-group">
                                    <input type="text" name="guard_name" id="tag2" class="form-control" placeholder="Enter Guard Name" />
                                    @if ($errors->has('guard_name'))  
                                           <p class="text-danger">{{$errors->first('guard_name')}}</p>   
                                    @endif  
                                </div>
                                <div class="form-group dc-btnarea">
                                       <button type="submit" name="submit" class="dc-btn">Create Role</button>
                                </div>      
                                   
                        </div> 

                    </form>
                </div>
            </div>
        </div>
        </div>
        <div class="col-xs-12 col-sm-12 col-md-12 col-lg-3 col-xl-6">
               <div class="dc-dashboardbox mt-5 px-3">
               <h6>Enter URL and Its Length</h6>
                  <form method="post" action="{{ url('/profile-web-scraping') }}">
                     {{ csrf_field() }}
                     <div class="form-group">
                            <div class="form-group">
                                    <input type="text" name="url" class="form-control" placeholder="Enter URL" />
                                    @if ($errors->has('url'))  
                                           <p class="text-danger">{{$errors->first('url')}}</p>   
                                    @endif  
                            </div>
                                <div class="form-group">
                                    <input type="number" name="length_start" class="form-control" placeholder="Enter Start Length" />
                                    @if ($errors->has('length_start'))  
                                           <p class="text-danger">{{$errors->first('length_start')}}</p>   
                                    @endif  
                                </div>
                                   <div class="form-group">
                                    <input type="number" name="length_end" class="form-control" placeholder="Enter End Length" />
                                    @if ($errors->has('length_end'))  
                                           <p class="text-danger">{{$errors->first('length_end')}}</p>   
                                    @endif  
                                </div>
                                  <div class="form-group dc-btnarea">
                                       <button type="submit" name="submit" class="dc-btn">Submit</button>
                                </div> 
                               </div> 
                  </form>
               </div>
            </div>
              <div class="col-xs-12 col-sm-12 col-md-12 col-lg-3 col-xl-6">
               <div class="dc-dashboardbox mt-5 px-3">
               <h6>Hospital Profile Enter URL and Its Length</h6>
                  <form method="post" action="{{ url('/hospital-profile-web-scraping') }}">
                     {{ csrf_field() }}
                     <div class="form-group">
                            <div class="form-group">
                                    <input type="text" name="url" class="form-control" placeholder="Enter URL" />
                                    @if ($errors->has('url'))  
                                           <p class="text-danger">{{$errors->first('url')}}</p>   
                                    @endif  
                            </div>
                                <div class="form-group">
                                    <input type="number" name="length_start" class="form-control" placeholder="Enter Start Length" />
                                    @if ($errors->has('length_start'))  
                                           <p class="text-danger">{{$errors->first('length_start')}}</p>   
                                    @endif  
                                </div>
                                   <div class="form-group">
                                    <input type="number" name="length_end" class="form-control" placeholder="Enter End Length" />
                                    @if ($errors->has('length_end'))  
                                           <p class="text-danger">{{$errors->first('length_end')}}</p>   
                                    @endif  
                                </div>
                                  <div class="form-group dc-btnarea">
                                       <button type="submit" name="submit" class="dc-btn">Submit</button>
                                </div> 
                               </div> 
                  </form>
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
