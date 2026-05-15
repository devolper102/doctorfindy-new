<div class="dc-changepassword dc-tabsinfo">
    <div class="dc-tabscontenttitle">
        <h3>{{ trans('lang.change_password') }}</h3>
    </div>
    {!! Form::open(['url' => url('profile/settings/request-password'), 'class' =>'dc-formtheme dc-userform dc-sidepadding'])!!}
        <fieldset>
            <div class="form-group">
                {!! Form::password('old_password', ['class' => 'form-control'.($errors->has('old_password') ? ' is-invalid' : ''),
                    'placeholder' => trans('lang.ph.oldpass'),'id' => 'oldpass']) !!}
                @if ($errors->has('old_password'))
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $errors->first('old_password') }}</strong>
                    </span>
                @endif
            </div>
            <div class="form-group">
                                <input type="checkbox" id="show" onclick="showPass()"> <label for="show" id="changeText"> Show Password</label> 
            </div>
            <div class="form-group">
                {!! Form::password('confirm_password', ['class' => 'form-control','placeholder' => trans('lang.ph.newpass'),'id' => 'newpass']) !!}
            </div>
            <div class="form-group">
                {!! Form::password('confirm_new_password', ['class' => 'form-control','placeholder' => trans('lang.ph.confirm_new_pass'),'id' => 'confirmpass']) !!}
            </div>
            {!! Form::hidden('user_id', !empty(Auth::user()) ? Auth::user()->id : null) !!}
        </fieldset>
        <div class="dc-updatall la-updateall-holder">
            {!! Form::submit(trans('lang.btn_save'), ['class' => 'dc-btn']) !!}
        </div>
    {!! Form::close() !!}
</div>
@push('backend_stylesheets')
<script>
function  showPass() {
         var elementsArray = document.querySelectorAll("#oldpass, #newpass ,#confirmpass")
        elementsArray.forEach(element => {
        if (element.type === "password") {
            element.type = "text";
            document.getElementById('changeText').innerHTML ="Hide Password"; 
          } else {
            element.type = "password";
             document.getElementById('changeText').innerHTML ="Show Password"; 
          }
      });
  }
</script>
@endpush