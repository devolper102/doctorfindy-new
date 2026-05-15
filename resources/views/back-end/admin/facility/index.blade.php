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
                            <h2>Manage Facilities</h2>
                        </div>
                        @if ($facilities->count() > 0)
                           <div class="dc-dashboardboxcontent dc-categoriescontentholder">
                                <table id="facility"  class="table table-bordered table-hover dt-responsive nowrap table-responsive"cellspacing="0">
                                    <thead>
                                        <tr>
                                            <th>Title</th>
                                            <th>Description</th>
                                            <th class="action">{{{ trans('lang.action') }}}</th>
                                            <th>Created Date</th>
                                            <th>Updated Date</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @php $counter = 0; @endphp
                                        @foreach ($facilities as $key => $facility)
                                            <tr class="del-{{{ $facility->id }}}">
                                                
                                                <td>{{$facility->title}}</td>
                                                <td>{!!$facility->description!!}</td>
                                               
                                                <td>
                                                    <div class="dc-actionbtn">
                                                        <a href="{{action('FacilityController@edit',$facility->id) }}" class="dc-addinfo dc-skillsaddinfo">
                                                            <i class="lnr lnr-pencil"></i>
                                                        </a>
                                                
                                                    <delete :title="'{{trans("lang.ph_delete_confirm_title")}}'" :id="'{{ intVal(clean($facility->id)) }}'" :message="'{{trans("Facility Deleted Successfully")}}'" :url="'{{url('admin/facility/delete')}}'" :redirect_url="'{{url('admin/facility')}}'"></delete>

                                                    </div>
                                                </td>
                                                <td>{{ $facility->created_at->format('M d, Y, H:i A') }}</td>
                                                <td>{{ $facility->updated_at->format('M d, Y, H:i A') }}</td>
                                            </tr>
                                            @php $counter++; @endphp
                                        @endforeach
                                    </tbody>
                                </table>
                                @if ( method_exists($facilities,'links') )
                                    {{ $facilities->links('pagination.custom') }}
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

                        	<h2>Add New Facility</h2>
                <div class="dc-dashboardboxtitle">

                    <form action="{{ url('admin/store-facility') }}"method="post"> 
                        {{csrf_field()}}
                        <div class="form-group">
                                <div class="form-group">
                                    <input type="text" name="title"  class="form-control" placeholder="Enter Facility" />
                                    @if ($errors->has('title'))  
                                           <p class="text-danger">{{$errors->first('title')}}</p>   
                                    @endif  
                                    
                                </div>
                              
                                 <div class="form-group">
                                    {!! Form::textarea( 'description', null, ['id' => 'description','class' =>'form-control', 'placeholder' => trans('lang.ph.desc')] ) !!}
                                </div> 
                                <div class="form-group dc-btnarea">
                                       <button type="submit" name="submit" class="dc-btn">Create Facility</button>
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
        $('#facility').DataTable();
      } );
</script>
@endpush
