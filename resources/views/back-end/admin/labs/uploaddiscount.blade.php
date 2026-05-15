@extends(file_exists(resource_path('views/extend/back-end/master.blade.php')) ? 'extend.back-end.master' : 'back-end.master')
@push('backend_stylesheets')
<link href="{{ asset('css/basictable.css') }}" rel="stylesheet">
<link rel="stylesheet" type="text/css" href="/media/css/site-examples.css?_=2335fc41d55494e8cfce6bcc069c6419">
<link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.10.23/css/jquery.dataTables.min.css">
<link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/rowreorder/1.2.7/css/rowReorder.dataTables.min.css">
<link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/responsive/2.2.7/css/responsive.dataTables.min.css">
@endpush
@section('content')
<section class="dc-haslayout" id="account_settings">
   @if (Session::has('message'))
   <div class="flash_msg">
      <flash_messages :message_class="'success'" :time ='5' :message="'{{{ Session::get('message') }}}'" v-cloak></flash_messages>
   </div>
   @elseif (Session::has('error'))
   <div class="flash_msg">
      <flash_messages :message_class="'danger'" :time ='5' :message="'{{{ Session::get('error') }}}'" v-cloak></flash_messages>
   </div>
   @endif
   <div class="dc-preloader-section" v-if="is_loading" v-cloak>
      <div class="dc-preloader-holder">
         <div class="dc-loader"></div>
      </div>
   </div>
   <div class="card bg-light mt-3">
        <div class="card-header">
            Upload Discount Labs Code
        </div>
        <div class="card-body">
            <form action="{{ route('import-lab-code') }}" method="POST" enctype="multipart/form-data">
                @csrf
                <input type="file" name="file" class="form-control" required>
                <br>
                
                <button class="btn btn-success">Import User Data</button>
                <!-- <a class="btn btn-warning" href="{{ route('export-lab-tests') }}">Export User Data</a> -->
            </form>
        </div>
    </div>
   	<!-- <div class="dc-dashboardbox">
        <div class="dc-dashboardboxtitle dc-titlewithsearch">
			<div class="page-header">
			  	<div class="row">
				     <div class="col-sm-12">
				        <h3>Upload Discount Labs Code</h3>
				     </div>
			  	</div>
			</div>
			<div class="dc-settingscontent form-group pt-5">
				<div class="dc-formtheme dc-userform">
					<div class="dc-profilephotocontent">
						<div class="dc-formtheme dc-formprojectinfo dc-formcategory">
							<fieldset>
								<div class="form-group form-group-label">
									<div class="la-upload-holder">
										<div id="disease_image" class="vue-dropzone dropzone dz-clickable">
											<div class="dz-message">
												<div class="form-group form-group-label">
													<label class="dc-labelgroup" for="file">
														<label for="file">
															<span class="dc-btn">Select Files
															</span>
														</label>
														<span>Drop Files</span>
									<input class="dc-btn" type="file" name="disease_image" id="file" style="display: none;">
													</label>
												</div>
											</div>
										</div>
									</div>
								</div>
							</fieldset>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div> -->

</section>
@endsection
@push('scripts')
@stack('backend_scripts')
@endpush
