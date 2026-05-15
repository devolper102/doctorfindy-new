@extends('back-end.master')
@push('backend_stylesheets')
<style type="text/css">
	#vaccination thead tr th{
        width: 100%;
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
                            <h2>Manage Team Members</h2>
                        </div>
                        @if ($teams->count() > 0)
                           <div class="dc-dashboardboxcontent dc-categoriescontentholder">
                                <table  id="vaccination"  class="table table-bordered table-hover dt-responsive nowrap table-responsive"cellspacing="0">
                                    <thead>
                                        <tr>
                                            <th>Name</th>
                                            <th>designation</th>
                                            <th class="action">{{{ trans('lang.action') }}}</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @php $counter = 0; @endphp
                                        @foreach ($teams as $key => $team)
                                            <tr>
                                                
                                                <td>{{$team->full_name}}</td>
                                                <td>{!! $team->designation !!}</td>                                               
                                                <td>
                                                    <div class="dc-actionbtn">
                                                        <a href="{{action('SiteTeamController@edit',$team->id) }}" class="dc-addinfo dc-skillsaddinfo">
                                                            <i class="lnr lnr-pencil"></i>
                                                        </a>
                                                
                                                    <delete :title="'{{trans("lang.ph_delete_confirm_title")}}'" :id="'{{ intVal(clean($team->id)) }}'" :message="'{{trans("Team Member Deleted Successfully")}}'" :url="'{{url('admin/site-team/delete')}}'" :redirect_url="'{{url('admin/site-team')}}'"></delete>

                                                    </div>
                                                </td>
                                            </tr>
                                            @php $counter++; @endphp
                                        @endforeach
                                    </tbody>
                                </table>
                                @if ( method_exists($teams,'links') )
                                    {{ $teams->links('pagination.custom') }}
                                @endif
                            </div>
                        @else
                            @include('errors.no-record')
                        @endif
                    </div>
                </div>
    <div class="row">
        <div class="col-xs-12 col-sm-12 col-md-12 col-lg-7 col-xl-6">
        <div class="dc-dashboardbox mt-5">
            <div class="dc-dashboardboxtitle dc-titlewithsearch dc-titlewithdel">

                        	<h2>Add New Team Member</h2>
                <div class="dc-dashboardboxtitle">

                    <form action="{{ url('admin/store-site-team') }}"method="post"> 
                        {{csrf_field()}}
                        <div class="form-group">
                                <div class="form-group">
                                    <input type="text" name="full_name" class="form-control" placeholder="Full Name" />
                                    @if ($errors->has('full_name'))  
                                           <p class="text-danger">{{$errors->first('full_name')}}</p>   
                                    @endif  
                                </div>
                                <div class="form-group">
                                    <input type="text" name="designation" class="form-control" placeholder="Enter Designation" />
                                    @if ($errors->has('designation'))  
                                           <p class="text-danger">{{$errors->first('designation')}}</p>   
                                    @endif  
                                </div>
                                 <div class="form-group">
                                    {!! Form::textarea( 'description', null, ['id' => 'description','class' =>'form-control', 'placeholder' => trans('Enter Some Details')] ) !!}
                                </div> 
                                    <div class="dc-settingscontent form-group">
                                    <div class = "dc-formtheme dc-userform"style="float: left;">
                                        <upload-media
                                                :img="'team_image'"
                                                :img_id="'team_image'"
                                                :img_name="'team_image'"
                                                :img_ref="'team_image'"
                                                :img_hidden_name="'team_image'"
                                                img_hidden_id="'team_image'"
                                                :url="'{{ url("media/upload-temp-image/team/team_image/team") }}'"
                                        >
                                        </upload-media>
                                    </div>
                                </div>
                                <div class="form-group dc-btnarea">
                                       <button type="submit" name="submit" class="dc-btn">Create Team Member</button>
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
        $('#vaccination').DataTable();
      } );
</script>
@endpush
