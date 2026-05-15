@extends('back-end.master')
@push('backend_stylesheets')
<style type="text/css">
	#affair thead tr th{
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
                            <h2>Manage Affairs</h2>
                        </div>
                        @if ($affairs->count() > 0)
                           <div class="dc-dashboardboxcontent dc-categoriescontentholder">
                                <table id="affair" class="table table-bordered table-hover dt-responsive nowrap table-responsive"cellspacing="0">
                                    <thead>
                                        <tr>
                                            <th>Title</th>
                                            <th>Status</th>
                                            <th>Priority</th>
                                            <th class="action">{{{ trans('lang.action') }}}</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @php $counter = 0; @endphp
                                        @foreach ($affairs as $key => $affair)
                                            <tr>
                                                
                                                <td>{{$affair->title}}</td>
                                                  @if($affair->status =='1')
                                                <td>Active</td>
                                                @else
                                                <td>Inactive</td>
                                                @endif
                                               @if($affair->priority =='1')
                                                <td>High</td>
                                                @else
                                                <td>Low</td>
                                                @endif
                                                <td>
                                                    <div class="dc-actionbtn">
                                                        <a href="{{action('AffairController@edit',$affair->id) }}" class="dc-addinfo dc-skillsaddinfo">
                                                            <i class="lnr lnr-pencil"></i>
                                                        </a>
                                                       


                                                    <delete :title="'{{trans("lang.ph_delete_confirm_title")}}'" :id="'{{ intVal(clean($affair->id)) }}'" :message="'{{trans("Affair Deleted Successfully")}}'" :url="'{{url('admin/affairs/delete')}}'" :redirect_url="'{{url('admin/affairs')}}'"></delete>
                                                

                                                       

                                                    </div>
                                                </td>
                                            </tr>
                                            @php $counter++; @endphp
                                        @endforeach
                                    </tbody>
                                </table>
                                @if ( method_exists($affairs,'links') )
                                    {{ $affairs->links('pagination.custom') }}
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

                        	<h2>Add New Affair</h2>
                <div class="dc-dashboardboxtitle">

                    <form action="{{ url('admin/store-affair') }}"method="post"> 
                        {{csrf_field()}}
                        <div class="form-group">
                                <div class="form-group">
                                    <input type="text" name="title"  class="form-control" placeholder="Title" />
                                    @if ($errors->has('title'))  
                                          <br>
                                           <p class="text-danger">{{$errors->first('title')}}</p>   
                                    @endif  
                                    
                                </div>
                                <div class="form-group">
                                     <span class="dc-select">
                                    <select name="status" id="status" class="form-control">
                                       <option value="">Select Status</option>
                                        <option value="1">Active</option>
                                        <option value="0">Inactive</option>
                                        
                                    </select>
                                </span>
                                    @if ($errors->has('status'))  
                                           <p class="text-danger">{{$errors->first('status')}}</p>   
                                    @endif
                                     
                                </div>
                                 <div class="form-group">
                                     <span class="dc-select">
                                     <select name="priority" id="priority" class="form-control">
                                         <option value="">Select Priority</option>
                                        <option value="1">Hight Priority </option>
                                        <option value="0">Low Priority</option>
                                        
                                    </select>
                                </span>
                                    @if ($errors->has('priority'))  
                                           <p class="text-danger">{{$errors->first('priority')}}</p>   
                                    @endif
                                </div> 
                                <div class="form-group dc-btnarea">
                                       <button type="submit" name="submit"class="dc-btn"> Create Affair </button>
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
        $('#affair').DataTable({
        "order": []
    });
      } );
</script>
@endpush
