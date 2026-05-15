@extends('back-end.master')
@section('content')
    @include('includes.pre-loader')
    <div class="dc-locations" id="push-notification">
        @if (Session::has('message'))
            <div class="flash_msg">
                <flash_messages :message_class="'success'" :time='5' :message="'{{{ Session::get('message') }}}'" v-cloak>
                </flash_messages>
            </div>
        @elseif (Session::has('error'))
            <div class="flash_msg">
                <flash_messages :message_class="'danger'" :time='5' :message="'{{{ Session::get('error') }}}'" v-cloak>
                </flash_messages>
            </div>
        @endif
        <section class="dc-haslayout" >
            <div class="row">
              <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12 col-xl-12">
                   <div class="dc-dashboardbox">
                        <div class="dc-dashboardboxtitle dc-titlewithsearch dc-titlewithdel">
                            <h2>Manage Notifications</h2>
                        </div>
                        @if ($notifications->count() > 0)
                           <div class="dc-dashboardboxcontent dc-categoriescontentholder table-responsive">
                                <table id="notification"  class="table table-bordered table-hover dt-responsive nowrap"cellspacing="0">
                                    <thead>
                                        <tr>
                                          
                                            <th>Message</th>
                                            <th>Url</th>
                                            <th>User id</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @php $counter = 0; @endphp
                                        @foreach ($notifications as $key => $notification)
                                            <tr class="del-{{{ $notification->id }}}">
                                                
                                                <td>{{$notification->message}}</td>
                                                <td>{{$notification->url}}</td>
                                                <td>{{$notification->user_id}}</td>
                                               
                                             
                                            </tr>
                                            @php $counter++; @endphp
                                        @endforeach
                                    </tbody>
                                </table>
                                @if ( method_exists($notifications,'links') )
                                    {{ $notifications->links('pagination.custom') }}
                                @endif
                            </div>
                        @else
                            @include('errors.no-record')
                        @endif
                    </div>
                </div>
            </div>
            <div class="row">    
                <div class="col-xs-12 col-sm-12 col-md-12 col-lg-5 col-xl-6 dc-responsive-mt mt-lg-0 mt-xl-0">
                    <div class="dc-dashboardbox dc-offered-holder dc-addnewdisease mt-4 pt-4">
                        <div class="dc-dashboardboxtitle">
                            <h2>{{{ trans('lang.add_push_notifications') }}}</h2>
                        </div>
                        <form id="notification_form"  @submit.prevent="notificationForm" method="POST">
                            <div class="dc-dashboardboxcontent mb-0">
                                <fieldset>
                                    <div class="form-group">
                                        <input type="text" name="title" class="form-control" placeholder="Title"/>
                                    </div>

                                    <div class="form-group">
                                        <textarea name="message" cols="71" rows="130" placeholder="Message" class="w-100"></textarea>
                                    </div>

                                    <div class="form-group">
                                        <input type="text" name="url" class="form-control" placeholder="Url"/>
                                    </div>


                                    <div class="form-group dc-btnarea">
                                       <button type="submit" name="submit" class="dc-btn">Create Notification</button>
                                </div>
                                </fieldset>
                            </div>
                        </form>
                    </div>
                </div>
                 <div class="col-xs-12 col-sm-12 col-md-12 col-lg-5 col-xl-6 dc-responsive-mt mt-lg-0 mt-xl-0">
                 </div>
            </div>
        </section>
    </div>
@endsection
@push('scripts')
@stack('backend_scripts')
<script type="text/javascript">
      $(document).ready(function() {
        $('#notification').DataTable();
      } );
</script>
@endpush
