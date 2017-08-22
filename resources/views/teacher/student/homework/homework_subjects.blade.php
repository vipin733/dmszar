@extends('layouts.app')
@section('nav')
@include('teacher.teacher_nav')
@stop
@section('content')
<div class="row">
  <div class="col-md-12">       
    <div class="panel panel-default">
      <div class="panel-heading">
      <button class="btn btn-primary btn-block">Academic Homework(Choose Subject and Action)</button>
      </div>
      <div class="panel-body">

          <div class="table-responsive text-center col-sm-12">
              <table class="table table-bordered  table-hover">
                <thead>
                   <tr>
                     <th class="text-center">Class</th>
                     <td class="text-center">{{$course->name}}</td>
                     <th class="text-center">Section</th>
                     <td class="text-center">{{$section->name}}</td>
                   </tr>
                </thead>
              </table>
          </div>  

          <div class="table-responsive text-center col-sm-12">
              <table class="table table-bordered  table-hover">
                  <thead>
                   <tr>
                     <th class="text-center">Serial no.</th>
                     <th class="text-center">Subject</th>
                     <th class="text-center">Upload Homework</th>
                     <th class="text-center">View Last Homework</th>
                   </tr>
                  </thead>
                  <tbody class="text-center">
                      <?php $i = 0 ?>
                    @foreach($subjectnames as $subject)
                      <?php $i++ ?>
                      <tr>
                        <td>{{ $i }}</td>
                        <td>{{ $subject['name'] }}</td>
                        <td>
                          <a class="btn btn-success" href="/teacher/student/{{$course->id}}/{{$section->id}}/{{$subject->id}}/homework_upload_form">
                          <i class="fa fa-upload" aria-hidden="true"></i>
                          </a>
                        </td>
                        <td>
                          <a class="btn btn-primary" href="/teacher/student/homework_index">
                          <i class="fa fa-eye faa-pulse animated" aria-hidden="true"></i>
                          </a>
                        </td>
                      </tr>
                    @endforeach
                  </tbody>
              </table>
          </div>  

      </div>
    </div>                       
  </div>
</div>

@stop
                           