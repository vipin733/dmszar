@extends('layouts.app')
@section('nav')
@include('staff.staff_nav')
@stop
@section('content')

<div class="row">
  <div class="col-md-4 col-md-offset-4">
    <div class="text-center">
          <div class="dropdown btn-group">
            <a class="btn dropdown-toggle btn-primary" data-toggle="dropdown" href="#">
              --Select Class
            </a>
            <ul class="dropdown-menu">
            @foreach($courses as $course)
              <li><a href="/staff/section_student/{{$course->id}}/{{strtotime($course->created_at)}}/attach">{{ $course->name }}</a></li>
             @endforeach 
            </ul>
          </div>
    </div>       	
  </div>
</div>

@stop
