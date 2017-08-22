@extends('layouts.app')
@section('nav')
@include('layouts.login_register_nav')
@stop
@section('content')
<div class="container" style="margin-top: 7%;">
    <div class="row">
        <div class="col-md-8 col-md-offset-2">
            <div class="panel panel-primary">
                <div class="panel-heading text-center">Login</div>
                <div class="panel-body">
                    <form class="form-horizontal" role="form" method="POST" action="{{ url('/superadmin/login') }}" data-parsley-validate ="">
                        {{ csrf_field() }}

                        <div class="form-group{{ $errors->has('reg_no') ? ' has-error' : '' }}">
                            <label for="reg_no" class="col-md-4 control-label">Registarion No</label>

                            <div class="col-md-6">
                                <input id="reg_no" type="reg_no" class="form-control" name="reg_no" value="{{ old('reg_no') }}" required autofocus>

                                @if ($errors->has('reg_no'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('reg_no') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group{{ $errors->has('password') ? ' has-error' : '' }}">
                            <label for="password" class="col-md-4 control-label">Password</label>

                            <div class="col-md-6">
                                <input id="password" type="password" class="form-control" name="password" required>

                                @if ($errors->has('password'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('password') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group">
                            <div class="col-md-8 col-md-offset-4">
                                <button type="submit" class="btn btn-primary">
                                    Login
                                </button>
                            </div>
                        </div>
                    </form>
                    
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@section('script')
<script src="https://cdnjs.cloudflare.com/ajax/libs/parsley.js/2.7.0/parsley.min.js" type="text/javascript"></script>
@endsection
