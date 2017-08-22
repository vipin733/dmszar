@extends('layouts.app')
@section('nav')
@include('staff.staff_nav')
@stop
@section('content')

<div class="row">
 @if(count($teachers))
  <div class="col-md-8 col-md-offset-2 text-center">
      
      <h3>Total Teachers/Staff: <strong>{{$teachers->total()}}</strong></h3>

  </div>

  <div class="col-md-12">
    <div class="panel panel-default">
      <div class="panel-heading">
        <button class="btn btn-primary btn-block">
         <b>Teacher/Staff Information</b>
        </button>
      </div>  
      <div class="panel-body"> 

        <div class="form-group">
            <form  method="get">
              <input name="query" class="form-control" placeholder="Search...">
            </form>
        </div>
        <div class="table-responsive">
          <table class="table table-bordered table-hover">
            <thead>

              <tr>
                <th class="text-center">Serial No.</th>
                <th class="text-center">Teacher Name</th>
                <th class="text-center">Reg. No.</th>
                <th class="text-center">Father Name</th>
                <th class="text-center">Mother Name</th>
                <th class="text-center">Type</th>
                <th class="text-center">Take Attendance</th>
                <th class="text-center">Attendance Details</th>
                <th class="text-center">View Profile</th>
              </tr>
            </thead>
            <tbody>
            <?php $i = 0 ?>
             @foreach($teachers as $s)
              <?php $i++ ?>
         
                <tr class="text-center">

                  <td>{{ $i }}</td>
                  <td><a href="{{ URL::to('/st/teacher_staff/' . $s->reg_no) }}">{{ $s->name  }}</a></td>
                  <td>{{ $s->reg_no }}</td>
                  <td>{{ $s->father_name }}</td>
                  <td>{{ $s->mother_name }}</td>
                  <td>
                   @if($s->isStaff())
                     Staff
                    @else
                    Teacher
                    @endif 
                  </td>
                  <td>
                    <div class="text-center">
                    <a class="btn btn-primary" href="/st/teacher_staff/take_attendence/{{$s->uuid}}/{{$s->reg_no}}"><i class="fa fa-eye faa-pulse animated" aria-hidden="true"></i></a>
                   </div>
                  </td>
                  <td>
                    <div class="text-center">
                    <a class="btn btn-primary" href="/st/teacher_staff/take_attendence/{{$s->uuid}}/{{$s->reg_no}}/details"><i class="fa fa-eye faa-pulse animated" aria-hidden="true"></i></a>
                   </div>
                  </td>
                  <td>
                    <div class="text-center">
                    <a class="btn btn-primary" href="{{ URL::to('/st/teacher_staff/' . $s->reg_no) }}"><i class="fa fa-eye faa-pulse animated" aria-hidden="true"></i></a>
                   </div>
                  </td>

                </tr>
            @endforeach
            </tbody>

          </table>
        </div>
      </div>
    </div>
    {{ $teachers->appends(request()->only(['query']))->links() }}
  </div>
 @else
 <h1 class="text-center">No Teacher/staff Found!</h1>
@endif
</div>

@stop
