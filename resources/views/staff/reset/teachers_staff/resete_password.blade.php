@extends('layouts.app')
@section('nav')
@include('staff.staff_nav')
@stop
@section('content')

 <div class="row">
   <div class="col-md-6 col-md-offset-3">       
            <div class="panel panel-default">
                <div class="panel-heading">
                  <button class="btn btn-primary btn-block">Reset Teacher/Staff Password</button>
                </div>
                <div class="panel-body">
                  <form class="form-horizontal" method="POST" action="/staff/resete/teacher_staff" data-parsley-validate ="">
                        {{ csrf_field() }} {{ method_field('PATCH') }}

                        <div class="form-group{{ $errors->has('reg_no') ? ' has-error' : '' }}">
                            <label for="reg_no" class="col-md-6 control-label">Teacher/Staff Registration No </label>

                            <div class="col-md-6">
                                <input id="reg_no" type="text" class="form-control" name="reg_no" value="{{ old('reg_no') }}"  required="" placeholder="TRA20178883">

                                @if ($errors->has('reg_no'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('reg_no') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                  	     <div class="form-group">
                            <div class="col-md-6 col-md-offset-3">
                                <button type="submit" class="btn btn-primary btn-block">
                                    Reset
                                </button>
                            </div>
                        </div>
                  </form>
                </div>
            </div>
    </div>            
 </div>

@stop 
@section('script')
<script src="https://cdnjs.cloudflare.com/ajax/libs/parsley.js/2.7.0/parsley.min.js" type="text/javascript"></script>

@endsection