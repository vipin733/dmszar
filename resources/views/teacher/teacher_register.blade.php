@extends('layouts.app')
@section('nav')
@include('layouts.nav')
@stop
@section('content')
  @include('partial.errors')
    <div class="row">
    @if($user->schoolprofile['transport_service'])
    @if($user->appprofile['reg_prefix_teacher'])
      <form class="form-horizontal" role="" method="POST" action="{{ url('/teacher/register') }}" " data-parsley-validate ="" enctype="multipart/form-data">
                        {{ csrf_field() }}

        <div class="col-md-8 col-md-offset-2">
            <div class="panel panel-primary">
                <div class="panel-heading">Login Details</div>
                <div class="panel-body">
                  @include('teacher.create.tlogin')
                </div>
            </div>
        </div>

        <div class="col-md-12">
            @include('teacher_staff_student.avatar.student_teacher_staff_avatar')
        </div>

        <div class="col-md-6">
            <div class="panel panel-primary">
             <div class="panel-heading">Teacher/Staff Profile</div>
             <div class="panel-body">
                <div class="col-sm-10 col-sm-offset-1">
                  @include('teacher.create.tprofile')
                </div>
             </div>
            </div>
        </div>

        <div class="col-md-6">
            <div class="panel panel-primary">
             <div class="panel-heading">Teacher/Staff Personal</div>
             <div class="panel-body">
                <div class="col-sm-10 col-sm-offset-1">
                  @include('teacher.create.tpersonal')
                </div>
             </div>
            </div>
        </div>

        <div class="col-md-12">
            <div class="panel panel-primary">
                <div class="panel-heading">Teacher/Staff Address</div>
                <div class="panel-body">
                  @include('teacher.create.taddress')
                </div>
             </div>
         </div>


        <div class="col-md-6 col-md-offset-3">
            <div class="panel panel-primary">
                <div class="panel-heading">Teacher/Staff Bio(if any)</div>
                <div class="panel-body">
                  <div class="form-group">
                    <textarea  class="form-control" id="bio" name="bio"  placeholder="">{{old('bio') }}</textarea>
                  </div>
                </div>
            </div>      
        </div>

     <div class="col-md-6 col-md-offset-3">
        <button type="submit" class="btn btn-primary btn-lg btn-block">
          Register
        </button>
         <br>
     </div>

     </form>
     @else
        <h1 class="text-center">Please Update <a href="/auth/app/profile/edit">App Profile</a></h1>
     @endif
     @else
        <h1 class="text-center">Please Update <a href="/auth/school_profile/edit">School Profile</a></h1>
     @endif
</div>

@endsection


@section('script')
<script type="text/javascript" src = "/js/video.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/parsley.js/2.7.0/parsley.min.js" type="text/javascript"></script>
   <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.6.4/js/bootstrap-datepicker.min.js"></script>
@include('staff_auth.district_state')
 @include('partial.datepicker')

  @include('teacher_staff_student.javascript.javascript')

@endsection
