@extends('layouts.app')
@section('nav')
@include('layouts.nav')
@stop
@section('content')

    <div class="row">
        <div class="col-md-12">
            <div class="panel panel-primary">
                <div class="panel-heading text-center">Update App Profile</div>
                <div class="panel-body">
                    <form class="form-horizontal" role="form" method="POST" action="{{ url('/auth/app/profile/update') }}" data-parsley-validate ="">
                        {{ csrf_field() }} {{ method_field('PATCH') }}

                         <div class="form-group{{ $errors->has('app_name') ? ' has-error' : '' }}">
                            <label for="app_name" class="col-md-8 control-label">App Name(which you want to be display as on navbar ex.- DMSZar) </label>

                            <div class="col-md-4">
                                <input id="app_name" type="text" class="form-control" name="app_name" value="{{ old('app_name',$user->appprofile['app_name']) }}"  required="" placeholder="DMSZar">

                                @if ($errors->has('app_name'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('app_name') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group{{ $errors->has('reg_prefix_student') ? ' has-error' : '' }}">
                            <label for="reg_prefix_student" class="col-md-8 control-label">Prefix name for student registration(It will appear before student registration name ex.- GRA will be like GRA20172238)</label>

                            <div class="col-md-4">
                                
                              <input id="reg_prefix_student" type="text" class="form-control" name="reg_prefix_student" value="{{ old('reg_prefix_student',$user->appprofile['reg_prefix_student']) }}"  required="" placeholder="GRA">

                                @if ($errors->has('reg_prefix_student'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('reg_prefix_student') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group{{ $errors->has('reg_prefix_teacher') ? ' has-error' : '' }}">
                            <label for="reg_prefix_teacher" class="col-md-8 control-label">Prefix name for teacher/staff registration(It will appear before teacher/staff registration name ex.- TGRA will be like TGRA20172238)</label>

                            <div class="col-md-4">
                                
                              <input id="reg_prefix_teacher" type="text" class="form-control" name="reg_prefix_teacher" value="{{ old('reg_prefix_teacher',$user->appprofile['reg_prefix_teacher']) }}"  required="" placeholder="TGRA">

                                @if ($errors->has('reg_prefix_teacher'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('reg_prefix_teacher') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>


                        <div class="form-group">
                            <div class="col-md-6 col-md-offset-3">
                                <button type="submit" class="btn btn-primary btn-block">
                                    Submit
                                </button>
                            </div>
                        </div>

                        
                    </form>
                </div>
            </div>
        </div>
    </div>

@endsection

@section('script')
<script src="https://cdnjs.cloudflare.com/ajax/libs/parsley.js/2.7.0/parsley.min.js" type="text/javascript"></script>

@endsection

