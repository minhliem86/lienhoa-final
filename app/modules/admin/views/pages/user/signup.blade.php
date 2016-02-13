@extends('admin::layouts.default')

@section('content')
<div class="content-wrapper">
    <div class="container">
        <div class="row">
                <form method="POST" action="{{{ route('admin.user.store') }}}" accept-charset="UTF-8">
                    <input type="hidden" name="_token" value="{{{ Session::getToken() }}}">
                    <fieldset>
                        @if (Cache::remember('username_in_confide', 5, function() {
                            return Schema::hasColumn(Config::get('auth.table'), 'username');
                        }))
                            <div class="form-group">
                                <label for="username">{{{ Lang::get('confide::confide.username') }}}</label>
                                <input class="form-control" placeholder="{{{ Lang::get('confide::confide.username') }}}" type="text" name="username" id="username" value="{{{ Input::old('username') }}}">
                            </div>
                        @endif
                        <div class="form-group">
                            <label for="email">{{{ Lang::get('confide::confide.e_mail') }}} <small>{{ Lang::get('confide::confide.signup.confirmation_required') }}</small></label>
                            <input class="form-control" placeholder="{{{ Lang::get('confide::confide.e_mail') }}}" type="text" name="email" id="email" value="{{{ Input::old('email') }}}">
                        </div>
                        <div class="form-group">
                            <label for="password">{{{ Lang::get('confide::confide.password') }}}</label>
                            <input class="form-control" placeholder="{{{ Lang::get('confide::confide.password') }}}" type="password" name="password" id="password">
                        </div>
                        <div class="form-group">
                            <label for="password_confirmation">{{{ Lang::get('confide::confide.password_confirmation') }}}</label>
                            <input class="form-control" placeholder="{{{ Lang::get('confide::confide.password_confirmation') }}}" type="password" name="password_confirmation" id="password_confirmation">
                        </div>
                        <div class="form-group">
                            <label for="password_confirmation">Choose Role</label>
                            {{Form::select('role',array('--'=>'Choose a role') + $role,\Input::old('role'),array('class'=>'form-control') )}}
                        </div>

                        @if (Session::get('error'))
                            <div class="alert alert-error alert-danger">
                                @if (is_array(Session::get('error')))
                                    {{ head(Session::get('error')) }}
                                @endif
                            </div>
                        @endif

                        @if (Session::get('notice'))
                            <div class="alert">{{ Session::get('notice') }}</div>
                        @endif

                        <div class="form-actions form-group">
                          <button type="submit" class="btn btn-primary">{{{ Lang::get('confide::confide.signup.submit') }}}</button>
                        </div>

                    </fieldset>
                </form>
</div>
</div>
</div>

@stop