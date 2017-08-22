@extends('layouts.app')
@section('nav')
@include('staff.staff_nav')
@stop
@section('content')

  @include('partial.errors')
  <div class="row">
     <form class="form-horizontal" id="" role="" method="POST" action="{{ url('/st/student/register') }}" data-parsley-validate ="" enctype="multipart/form-data">
                        {{ csrf_field() }} 

        <div class="col-md-6 col-md-offset-3">
            <div class="panel panel-primary">
                <div class="panel-heading">Login Details</div>
                <div class="panel-body">
                    @include('student.create.slogin')               
                </div>
            </div>
        </div>

        <div class="col-md-12">
            @include('teacher_staff_student.avatar.student_teacher_staff_avatar')
        </div>
        

         <div class="col-md-6">          
            <div class="panel panel-primary">
             <div class="panel-heading">Student Profile</div>
             <div class="panel-body">
                <div class="col-sm-10 col-sm-offset-1">
                  @include('staff.students.create.sprofile')
                </div>  
             </div>  
            </div>   
         </div>

          <div class="col-md-6">
            <div class="panel panel-primary">
                <div class="panel-heading">Student Personal</div>
                <div class="panel-body">
                <div class="col-sm-10 col-sm-offset-1">
                  @include('student.create.spersonal')
                  </div>
                </div>  
             </div>     
         </div>

         <div class="col-md-12">
            <div class="panel panel-primary">
                <div class="panel-heading">Student Address</div>
                <div class="panel-body">
                  @include('student.create.saddress')
                </div>  
             </div>     
         </div> 

          <div class="col-md-6 col-md-offset-3">

           <div class="form-group">
              <label for="bio">Student Bio(if any)</label>
              <textarea  class="form-control" id="bio" name="bio"  placeholder="">{{ Input::old('bio') }}</textarea>
            </div>    

          </div>


        <div class="col-md-6 col-md-offset-3">
          <button type="submit" class="btn btn-primary btn-lg btn-block">
            Register          
          </button>
           <br>
        </div>

     </form>                         
    </div>

 <br>
@endsection

@section('script')
<script type="text/javascript" src = "/js/video.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/parsley.js/2.7.0/parsley.min.js" type="text/javascript"></script>
   <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.6.4/js/bootstrap-datepicker.min.js"></script>
   @include('staff_auth.district_state')
 @include('partial.datepicker')
@include('teacher_staff_student.javascript.javascript')


@endsection
