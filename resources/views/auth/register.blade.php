@extends('layouts.app')
@section('nav')
@include('layouts.login_register_nav')
@stop
@section('content')

    <div class="row">
        <h2 class=" text-center">
          Find a plan that&rsquo;s right for <strong>you</strong>.
        </h2>
        <h4 class="sub-heading text-center">
          All of our plans offer free update unlimited sms, unlimited students, teachers, staff.
        </h4>
        <div class="col-md-8 col-md-offset-2">
            <div class="panel panel-default">
                <div class="panel-heading text-center"><h4>Register(All plan included 30 day's free) </h4></div>
                <div class="panel-body">
                
                    <form class="form-horizontal" role="form" method="POST" action="{{ url('/register') }}" data-parsley-validate ="">
                        {{ csrf_field() }}

                        <div class="form-group{{ $errors->has('name') ? ' has-error' : '' }}">
                            <label for="name" class="col-md-4 control-label">Name</label>

                            <div class="col-md-6">
                                <input id="name" type="text" class="form-control" name="name" value="{{ old('name') }}" required="">

                                @if ($errors->has('name'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('name') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                         <div class="form-group{{ $errors->has('school_name') ? ' has-error' : '' }}">
                            <label for="school_name" class="col-md-4 control-label">School Name</label>

                            <div class="col-md-6">
                                <input id="school_name" type="text" class="form-control" name="school_name" value="{{ old('school_name') }}" required="">

                                @if ($errors->has('school_name'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('school_name') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>


                        <div class="form-group{{ $errors->has('email') ? ' has-error' : '' }}">
                            <label for="email" class="col-md-4 control-label">E-Mail Address</label>

                            <div class="col-md-6">
                                <input id="email" type="email" class="form-control" name="email" value="{{ old('email') }}" required="">

                                @if ($errors->has('email'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('email') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group{{ $errors->has('mobile_no') ? ' has-error' : '' }}">
                            <label for="mobile_no" class="col-md-4 control-label">Mobile No.</label>

                            <div class="col-md-6">
                                {{-- <span class="input-group-addon">+91</span> --}}
                                <input id="mobile_no" type="text" class="form-control" name="mobile_no" value="{{ old('mobile_no') }}" required="">

                                @if ($errors->has('mobile_no'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('mobile_no') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group{{ $errors->has('password') ? ' has-error' : '' }}">
                            <label for="password" class="col-md-4 control-label">Password</label>

                            <div class="col-md-6">
                                <input id="password" type="password" class="form-control" name="password" required="">

                                @if ($errors->has('password'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('password') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group">
                            <label for="password-confirm" class="col-md-4 control-label">Confirm Password</label>

                            <div class="col-md-6">
                                <input id="password-confirm" type="password" class="form-control" name="password_confirmation" required="">
                            </div>
                        </div>

                        <div class="form-group{{ $errors->has('plan') ? ' has-error' : '' }}">
                            <label for="plan" class="col-md-4 control-label">Select Plan</label>

                            <div class="col-md-6">
                                <select name="plan" class="form-control" required="">
                                    <option value="">--Select Plan</option>
                                    <option value="0">Basic</option>
                                    <option value="1">Professional</option>
                                </select>

                                @if ($errors->has('plan'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('plan') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>



                        <div class="col-md-10 col-md-offset-1">
                            <p>
                            By clicking Register, you agree to our <a href="/terms_conditions">Terms of use</a> and confirm that you have read our <a href="/privacy_policy">Policy</a>, including our <a href="/privacy_policy">Cookie Use Policy.</a> You may receive SMS message notifications from DMSZar and can opt out at any time.
                        </p>
                        </div>
                        
                        <div class="col-md-6 col-md-offset-3 text-center {{ $errors->has('g-recaptcha-response') ? ' has-error' : '' }}">
                            {!! Recaptcha::render() !!}
                             @if ($errors->has('g-recaptcha-response'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('g-recaptcha-response') }}</strong>
                                    </span>
                                @endif
                         </div>
                        
                        
                            <div class="col-md-6 col-md-offset-3">
                            <br>
                                <button type="submit" class="btn btn-primary btn-block">
                                    Register
                                </button>
                            </div>
                      

                        
                    </form>
                </div>
            </div>
        </div>

       {{--  <div class="col-md-4">
            <div class="row">

                <div class="col-sm-12">
                    <div class="panel panel-default">
                        <div class="panel-heading"><h3 class="text-center">Basic</h3></div>
                        <div class="panel-body">
                        </div>
                    </div>        
                </div>

                <div class="col-sm-12">
                    <div class="panel panel-default">
                        <div class="panel-heading"><h3 class="text-center">Professional</h3></div>
                        <div class="panel-body">
                        </div>
                    </div>
                </div>

            </div>
        </div> --}}

    </div>

@endsection

@section('script')
<script src="https://cdnjs.cloudflare.com/ajax/libs/parsley.js/2.7.0/parsley.min.js" type="text/javascript"></script>
@endsection
