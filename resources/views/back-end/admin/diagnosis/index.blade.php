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
                            <h2>Manage Diagnoses</h2>
                        </div>
                        @if ($diagnoses->count() > 0)
                           <div class="dc-dashboardboxcontent dc-categoriescontentholder">
                                <table id="tests"  class="table table-bordered table-hover dt-responsive nowrap table-responsive"cellspacing="0">
                                    <thead>
                                        <tr>
                                          
                                            <th>Title</th>
                                            <th>Speciality Name</th>
                                            <th class="action">{{{ trans('lang.action') }}}</th>
                                            <th>Created Date</th>
                                            <th>Updated Date</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @php $counter = 0; @endphp
                                        @foreach ($diagnoses as $key => $diagnose)
                                            <tr>
                                        <td>
                                          {{$diagnose->title}}
                                        </td>
                                        <td>
                                            {{optional($diagnose->specialities)->title}}
                                        </td>
                                                <td>
                                                    <div class="dc-actionbtn">
                                                        <a href="{{action('DiagnoseController@edit',$diagnose->id) }}" class="dc-addinfo dc-skillsaddinfo">
                                                            <i class="lnr lnr-pencil"></i>
                                                        </a>
                                                    <delete :title="'{{trans("lang.ph_delete_confirm_title")}}'" :id="'{{ intVal(clean($diagnose->id)) }}'" :message="'{{trans("Diagnose Deleted Successfully")}}'" :url="'{{url('admin/diagnose/delete')}}'" :redirect_url="'{{url('admin/diagnose')}}'"></delete>
                                                    </div>
                                                </td>
                                                <td>{{ $diagnose->created_at->format('M d, Y, H:i A') }}</td>
                                                <td>{{ $diagnose->updated_at->format('M d, Y, H:i A') }}</td>
                                            </tr>
                                            @php $counter++; @endphp
                                        @endforeach
                                    </tbody>
                                </table>
                                @if ( method_exists($diagnoses,'links') )
                                    {{ $diagnoses->links('pagination.custom') }}
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

                        	<h2>Add Diagnose</h2>
                <div class="dc-dashboardboxtitle">

                    <form action="{{ url('admin/store-diagnose') }}"method="post"> 
                        {{csrf_field()}}
                        <div class="form-group">
                              <div class="form-group">
                                    <input type="text" name="title"  class="form-control" placeholder="Enter Title" />
                                    @if ($errors->has('title'))  
                                          <br>
                                           <p class="text-danger">{{$errors->first('title')}}</p>   
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
                                       <button type="submit" name="submit" class="dc-btn">Create Diagnose</button>
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
        $('#tests').DataTable();
      } );
</script>
@endpush
