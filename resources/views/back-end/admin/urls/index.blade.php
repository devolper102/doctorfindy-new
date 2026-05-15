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
                		 <div class="dc-dashboardbox dc-offered-holder">
                		 <div class="dc-dashboardboxtitle dc-titlewithsearch dc-titlewithdel">
                            <h2>Manage Pages</h2>
                        </div>
                		 @if ($urls->count() > 0)
                            <div class="dc-dashboardboxcontent dc-categoriescontentholder table-responsive">
                                <table id="urls"  class="table table-bordered table-hover dt-responsive nowrap"cellspacing="0">
                                    <thead>
                                        <tr>
                                          
                                            <th>Name</th>
                                             <th>Slug</th>
                                            <th>Meta Title</th>
                                            <th>Meta Description</th>
                                            <th>URL</th>
                                            <th class="action">{{{ trans('lang.action') }}}</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @php $counter = 0; @endphp
                                        @foreach ($urls as $key => $url)
                                            <tr>
                                                <td>{{$url->title}}</td>
                                                <td>{{$url->slug}}</td>
                                                <td>{{$url->meta_title}}</td>
                                                <td>{{$url->meta_description}}</td>
                                                <td>{{$url->url}}</td>
                                                <td>
                                                    <div class="dc-actionbtn">
                                                        <a href="{{action('UrlController@edit',$url->id) }}" class="dc-addinfo dc-skillsaddinfo">
                                                            <i class="lnr lnr-pencil"></i>
                                                        </a>

                                                        <delete :title="'{{trans("lang.ph_delete_confirm_title")}}'" :id="'{{ $url->id }}'" :message="'{{'Page Deleted Successfully'}}'" :url="'{{url('admin/url/delete')}}'" :redirect_url="'{{url('admin/url')}}'"></delete>

                                                        <a href="{{action('UrlController@show',$url->id) }}" class="dc-addinfo dc-skillsaddinfo"><i class="lnr lnr-eye"></i></a>
                                                    </div>
                                                </td>
                                            </tr>
                                            @php $counter++; @endphp
                                        @endforeach
                                    </tbody>
                                </table>
                                @if ( method_exists($urls,'links') )
                                    {{ $urls->links('pagination.custom') }}
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
        <div class="dc-dashboardbox">
            <div class="dc-dashboardboxtitle dc-titlewithsearch dc-titlewithdel">

                        	<h2>Add New Page</h2>
                <div class="dc-dashboardboxtitle">

                    <form action="{{ url('admin/store-url') }}"method="post"> 
                        {{csrf_field()}}
                        <div class="form-group">
                                <div class="form-group">
                                    <input type="text" name="title" id="tag2" class="form-control" placeholder="Enter Name" />
                                    @if ($errors->has('title'))  
                                          <br>
                                           <p class="text-danger">{{$errors->first('title')}}</p>   
                                    @endif  
                                    
                                </div>
                                <div class="form-group">
                                    <input type="text" name="url" id="tag2" class="form-control" placeholder="Enter URL" />
                                     @if ($errors->has('url'))  
                                          <br>
                                           <p class="text-danger">{{$errors->first('url')}}</p>   
                                    @endif  
                                </div>
                                  <div class="form-group">
                                    <input type="text" name="meta_title" id="tag2" class="form-control" placeholder="Enter Meta Title" />
                                </div>
                                  <div class="form-group">
                                    <textarea cols="5"name ="meta_description"class="form-control"placeholder="Enter Meta Description" ></textarea>
                                </div>
                                 <div class="form-group">
                                    {!! Form::textarea( 'description', null, ['id' => 'description','class' =>'form-control', 'placeholder' => trans('lang.ph.desc')] ) !!}
                                </div> 
                                <div class="form-group dc-btnarea">
                                       <button type="submit" name="submit" class="dc-btn">Create Page</button>
                                </div>      
                                   
                        </div> 

                    </form>
                </div>
            </div>
        </div>
        </div>
        <div class="col-xs-12 col-sm-12 col-md-12 col-lg-7 col-xl-6">
        </div>
                        	
    </div>
       </section>                  	
</div>
@endsection
@push('scripts')
@stack('backend_scripts')
<script type="text/javascript">
      $(document).ready(function() {
        $('#urls').DataTable();
      } );
</script>
@endpush
