@extends('back-end.master')
@push('backend_stylesheets')
<style type="text/css">
	#vaccination_alert thead tr th{
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
                            <h2>Manage Vaccination Alerts</h2>
                        </div>
                        @if ($vaccination_alerts->count() > 0)
                           <div class="dc-dashboardboxcontent dc-categoriescontentholder">
                                <table class="table table-bordered table-hover dt-responsive nowrap table-responsive"cellspacing="0" id="vaccination_alert">
                                    <thead>
                                        <tr>
                                            <th>Title</th>
                                            <th>Vaccination</th>
                                            <th>Start Date</th>
                                            <th>End Date</th>
                                            
                                            <th class="action">{{{ trans('lang.action') }}}</th>
                                            <th class="none">Start Time</th>
                                            <th class="none">End Time</th>
                                            <th class="none">Read More</th>
                                            <th class="none">Alert All Parents</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @php $counter = 0; @endphp
                                        @foreach ($vaccination_alerts as $key => $vaccination_alert)
                                            <tr>
                                                
                                                <td>{{$vaccination_alert->title}}</td>
                                                <td>{{optional($vaccination_alert->vaccinations)->title}}</td>
                                                 <td>{{$vaccination_alert->start_date}}</td>
                                                 <td>{{$vaccination_alert->end_date}}</td>
                                                 
                                                <td>
                                                    <div class="dc-actionbtn">
                                                        <a href="{{action('VaccinationAlertController@edit',$vaccination_alert->id) }}" class="dc-addinfo dc-skillsaddinfo">
                                                            <i class="lnr lnr-pencil"></i>
                                                        </a>
                                                
                                                    <delete :title="'{{trans("lang.ph_delete_confirm_title")}}'" :id="'{{ intVal(clean($vaccination_alert->id)) }}'" :message="'{{trans("Vaccination Alert Deleted Successfully")}}'" :url="'{{url('admin/vaccination-alert/delete')}}'" :redirect_url="'{{url('admin/vaccination-alert')}}'"></delete>

                                                    </div>
                                                </td>
                                                 <td>{{$vaccination_alert->start_time}}</td>
                                                 <td>{{$vaccination_alert->end_time}}</td>
                                                 <td>{{$vaccination_alert->url}}</td>
                                                 @if( $vaccination_alert->alert_parents == 'on')
                                                 <td>{{$vaccination_alert->alert_parents}}</td>
                                                 @else
                                                 <td>Off</td>
                                                 @endif
                                            </tr>
                                            @php $counter++; @endphp
                                        @endforeach
                                    </tbody>
                                </table>
                                @if ( method_exists($vaccination_alerts,'links') )
                                    {{ $vaccination_alerts->links('pagination.custom') }}
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

                        	<h2>Add New Vaccination Alert</h2>
                <div class="dc-dashboardboxtitle">

                    <form action="{{ url('admin/store-vaccination-alert') }}"method="post"> 
                        {{csrf_field()}}
                        <div class="form-group">
                             <div class="form-group">
                                    <input type="text" name="title" id="tag2" class="form-control" placeholder="Enter Title" />
                                    @if ($errors->has('title'))  
                                           <p class="text-danger">{{$errors->first('title')}}</p>   
                                    @endif  
                                </div>
                              <div class="form-group">
                                    <span class="dc-select">
                                    <select name="vaccination_id" id="vaccination_id" class="form-control">
                                       <option value="">Select Vaccination</option>
                                       @foreach ($vaccinations as $key => $vaccination)
                                        <option value="{{$vaccination->id}}">{{$vaccination->title}}</option>
                                        @endforeach
                                        
                                    </select>
                                </span>
                                    @if ($errors->has('vaccination_id'))  
                                           <p class="text-danger">{{$errors->first('vaccination_id')}}</p>   
                                    @endif
                                </div>
                                <div class="form-group">
                                   <input type="date" name="start_date" class="form-control" placeholder="Enter Start Time"/>
                                    @if ($errors->has('start_date'))  
                                           <p class="text-danger">{{$errors->first('start_date')}}</p>   
                                    @endif  
                                </div>
                                <div class="form-group">
                                   <input type="date" name="end_date" class="form-control" placeholder="Enter Start Time"/>
                                    @if ($errors->has('end_date'))  
                                           <p class="text-danger">{{$errors->first('end_date')}}</p>   
                                    @endif  
                                </div>
                            
                                
                                  <div class="form-group">
                                   <input type="time" id="start_time" name="start_time" class="form-control" placeholder="Enter Start Time"/>
                                    @if ($errors->has('start_time'))  
                                           <p class="text-danger">{{$errors->first('start_time')}}</p>   
                                    @endif  
                                </div>
                                  <div class="form-group">
                                   <input type="time" id="end_time" name="end_time"class="form-control" placeholder="Enter End Time"/>
                                    @if ($errors->has('end_time'))  
                                           <p class="text-danger">{{$errors->first('end_time')}}</p>   
                                    @endif  
                                </div>
                                <div class="form-group">
                                    <input type="text" name="url" id="tag2" class="form-control" placeholder="Enter URL"  />
                                    @if ($errors->has('url'))  
                                           <p class="text-danger">{{$errors->first('url')}}</p>   
                                    @endif  
                                </div>
                                <div class="form-group">
                                      <input type="checkbox" id="alert_parents" name="alert_parents" value="on"> <label for="alert_parents"> Send Alert to All Parents </label>
                                </div>

                              
                                <div class="form-group dc-btnarea">
                                       <button type="submit" name="submit" class="dc-btn">Create Vaccination Alert</button>
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
        $('#vaccination_alert').DataTable();
      } );

</script>
@endpush
