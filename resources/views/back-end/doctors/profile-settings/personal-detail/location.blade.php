<div class="dc-tabscontenttitle">
        <h3>{{ trans('lang.your_loc') }}</h3>
    </div>
    <div class="dc-sidepadding dc-tabsinfo">
        <div class="dc-formtheme dc-userform">
            <fieldset>
                <div class="row">
                    <div class="col-12 col-lg-6 col-md-6">
                      <div class="form-group">
                            <select name="location" id="userLocation" class="select2 form-control">
                                @if($user->location)
                                    <option value="{{$user->location->id}}" selected> {{$user->location->title}} </option>
                                @else
                                    <option value="" data-tokens="" selected disabled>Choose City</option>
                                @endif
                                @foreach($allLocations as $location)
                                    <option value="{{$location->id}}">{{$location->title}}</option>
                                @endforeach
                            </select>
                        </div>  
                    </div>
                    <!-- <div class="col-12 col-lg-6 col-md-6">
                        <div class="form-group">
                            <select name="area" id="address" class="select2 form-control" data-live-search="true">
                                @if($user->area)
                                    <option value="{{$user->area->id}}" selected> {{$user->area->title}} </option>
                                @endif
                            </select>
                        </div>
                    </div> -->
                </div>
                <div class="form-group">
                    <textarea name="des" id="address" cols="30" rows="10">{{$user->profile->address}}</textarea>
                </div>
                 <!-- <div class="form-group form-group-half">
                    {!! Form::hidden( 'address_lat', e($add_latitude), ['class' =>'form-control', 'id'=>'address_lat', 'placeholder' => trans('lang.enter_latitude')]) !!}
                </div>
                <div class="form-group form-group-half">
                    {!! Form::hidden( 'address_long', e($add_longitude), ['class' =>'form-control','id'=>'address_long','placeholder' => trans('lang.enter_longitude')]) !!}
                </div>
                <div class="form-group form-group-half">
                    {!! Form::text( 'latitude', e($latitude), ['class' =>'form-control','id' => 'latitude', 'placeholder' => trans('lang.enter_latitude')]) !!}
                </div>
                <div class="form-group form-group-half">
                    {!! Form::text( 'longitude', e($longitude), ['class' =>'form-control','id' => 'longitude', 'placeholder' => trans('lang.enter_longitude')]) !!}
                </div> -->

            </fieldset>
        </div>
    </div>

