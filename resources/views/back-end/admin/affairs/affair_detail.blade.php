@extends('back-end.master')
@push('backend_stylesheets')

<style>
    #affairdetails thead tr th{
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
                            <h2>Manage Affairs Details</h2>
                        </div>
                        @if ($affair_detail->count() > 0)
                           <div class="dc-dashboardboxcontent dc-categoriescontentholder">
                                <table id="affairdetails"  class="table table-bordered table-hover dt-responsive nowrap table-responsive"cellspacing="0">
                                    <thead>
                                        <tr>
                                          
                                            <th>Affair Title</th>
                                            <th>Affair Topic</th>
                                            <th>type</th>
                                            <th>status</th>
                                            <th>URL</th>
                                            <th class="action">{{{ trans('lang.action') }}}</th>
                                            <th class="none">Description</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @php $counter = 0; @endphp
                                        @foreach ($affair_detail as $key => $affairdetails)
                                            <tr class="del-{{{ $affairdetails->id }}}">

                                               <td>{{optional($affairdetails->affairs)->title}}</td>

                                                <td>{{$affairdetails->title}}</td>
                                                <td>{{$affairdetails->type}}</td>
                                                @if($affairdetails->status =='1')
                                                <td>Active</td>
                                                @else
                                                <td>Inactive</td>
                                                @endif
                                                <td>{{$affairdetails->url}}</td>
                                                <td>
                                                    <div class="dc-actionbtn">
                                                        <a href="{{action('AffairDetailController@edit',$affairdetails->id) }}" class="dc-addinfo dc-skillsaddinfo">
                                                            <i class="lnr lnr-pencil"></i>
                                                        </a>
                                                    <delete :title="'{{trans("lang.ph_delete_confirm_title")}}'" :id="'{{ intVal(clean($affairdetails->id)) }}'" :message="'{{trans("Affair Detail Deleted Successfully")}}'" :url="'{{url('admin/affairs-details/delete')}}'" :redirect_url="'{{url('admin/affair-details')}}'"></delete>
                                                    </div>
                                                </td>
                                                <td>{!! $affairdetails->description !!}</td>

                                            </tr>
                                            @php $counter++; @endphp
                                        @endforeach
                                    </tbody>
                                </table>
                                @if ( method_exists($affair_detail,'links') )
                                    {{ $affair_detail->links('pagination.custom') }}
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
           
                <div class="dc-dashboardboxtitle">

                        	<h2>Add New Affair Details</h2>
                </div>
                <div class="dc-dashboardboxcontent dc-addspeciality">

                    <form action="{{ url('admin/store-affair-details') }}"method="post"enctype="multipart/form-data"> 
                        {{csrf_field()}}
                        <div class="form-group">
                                 <div class="form-group">
                                     <span class="dc-select">
                                    <select name="affairs_id" id="affairs_id" class="form-control">
                                       <option value="">Select Affair Title</option>
                                       @foreach ($affairs as $key => $affair)
                                        <option value="{{$affair->id}}">{{$affair->title}}</option>
                                        @endforeach
                                        
                                    </select>
                                </span>
                                    @if ($errors->has('affairs_id'))  
                                          <br>
                                           <p class="text-danger">{{$errors->first('affairs_id')}}</p>   
                                    @endif
                                     
                                </div>
                                <div class="form-group">
                                    <input type="text" name="title"  class="form-control" placeholder="Affair Topic" />
                                    @if ($errors->has('title'))  
                                          <br>
                                           <p class="text-danger">{{$errors->first('title')}}</p>   
                                    @endif  
                                    
                                </div>
                                <div class="form-group">
                                     <span class="dc-select">
                                    <select name="type" id="type" class="form-control">
                                        <option value="">Select Type</option>
                                        <option value="artical">Artical</option>
                                        <option value="non-artical">Non Artical</option>
                                        
                                    </select>
                                </span>
                                    @if ($errors->has('type'))  
                                          <br>
                                           <p class="text-danger">{{$errors->first('type')}}</p>   
                                    @endif
                                     
                                </div>
                                 <div class="form-group">
                                    <span class="dc-select">
                                     <select name="status" id="staturlus" class="form-control">
                                        
                                        <option value="">Select Status</option>
                                        <option value="1">Active</option>
                                        <option value="0">Inactive</option>
                                        
                                    </select>
                                </span>
                                    @if ($errors->has('status'))  
                                          <br>
                                           <p class="text-danger">{{$errors->first('status')}}</p>   
                                    @endif
                                </div> 
                                <div class="form-group">
                                    <input type="text" name="url" id="tag2" class="form-control" placeholder="Url" />
                                    @if ($errors->has('url'))  
                                          <br>
                                           <p class="text-danger">{{$errors->first('url')}}</p>   
                                    @endif  
                                    
                                </div>
                                  <div class="form-group">
                                    {!! Form::textarea( 'description', null, ['id' => 'description','class' =>'form-control', 'placeholder' => trans('lang.ph.desc')] ) !!}
                                </div>
                                
                                 <div class="dc-settingscontent form-group">
                                    <div class = "dc-formtheme dc-userform form-group">
                                         <upload-media
                                                :img="'affair_image'"
                                                :img_id="'affair_image'"
                                                :img_name="'affair_image'"
                                                :img_ref="'affair_image'"
                                                :img_hidden_name="'affair_image'"
                                                img_hidden_id="'affair_image'"
                                                :url="'{{ url("media/upload-temp-image/affairs/affair_image/affair") }}'"
                                        >
                                        </upload-media>

                                    </div>
                                </div>
                              
                                <div class="form-group dc-btnarea">
                                       <button type="submit" name="submit" class="dc-btn">Create Affair Detail</button>
                                </div>      
                                   
                        </div> 

                    </form>
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
        $('#affairdetails').DataTable( {
        "order": []
    } );
      } );
</script>
@endpush
