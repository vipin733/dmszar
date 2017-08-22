@extends('layouts.app')
@section('nav')
@include('staff.staff_nav')
@stop
@section('content')
  @include('partial.errors')
  <div class="row">
     <form class="form-horizontal" method="POST" action="/st/teacher/profile/{{ $teacher->uuid }}/{{$teacher->reg_no}}/update" data-parsley-validate ="" enctype="multipart/form-data">
                        {{ csrf_field() }} {{ method_field('PATCH') }}

       <div class="col-md-12">
            @include('staff.teachers_staff.edit.teacher_staff_edit_avatar')
        </div>                

         <div class="col-md-6">          
            <div class="panel panel-primary">
             <div class="panel-heading">
               @if($teacher->isStaff())
                 Staff Profile
                @else
                 Teacher Profile
                @endif
             </div>
             <div class="panel-body">
                <div class="col-sm-10 col-sm-offset-1">
                  @include('staff.teachers_staff.edit.tprofile_edit')
                </div>  
             </div>  
            </div>   
         </div>

          <div class="col-md-6">
            <div class="panel panel-primary">
                <div class="panel-heading">
                @if($teacher->isStaff())
                 Staff Personal
                @else
                 Teacher Personal
                @endif
                </div>
                <div class="panel-body">
                <div class="col-sm-10 col-sm-offset-1">
                  @include('teacher.edit.tpersonal_edit')
                  </div>
                </div>  
             </div>     
         </div>

         <div class="col-md-12">
            <div class="panel panel-primary">
                <div class="panel-heading">
                 @if($teacher->isStaff())
                 Staff Address
                @else
                 Teacher Address
                @endif
                </div>
                <div class="panel-body">
                  @include('teacher.edit.taddress_edit')
                </div>  
             </div>     
         </div> 

         <div class="col-md-6 col-md-offset-3">

           <div class="form-group">
              <label for="bio">@if($teacher->isStaff()) Staff @else Teacher @endif Bio(if any)</label>
              <textarea  class="form-control" id="bio" name="bio"  placeholder="" >{{old('bio',$teacher->bio) }}</textarea>
            </div>

          </div>


        <div class="col-md-6 col-md-offset-3">
          <button type="submit" class="btn btn-primary btn-lg btn-block">
            Submit          
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
 @include('partial.students_same_address')
 @include('partial.datepicker')
@include('teacher_staff_student.javascript.javascript')

@endsection
