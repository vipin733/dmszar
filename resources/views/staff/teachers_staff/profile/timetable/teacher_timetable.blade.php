@extends('layouts.app')
@section('nav')
@include('staff.staff_nav')
@stop
@section('content')

    <div class="row">
       
       @include('staff.teachers_staff.profile.profile_detail')
	    
    </div>

    <div class="row">
	    <div class="panel panel-default">
	        <div class="panel-heading">
	         <button class="btn btn-primary btn-block">
	            Teacher Time Table Session Wise
	         </button>
	        </div>
	        <div class="panel-body">
		        <div class="table-responsive col-md-8 col-md-offset-2">
		            <table class=" table table-bordered  table-hover" id="userstable">
			            <thead>
			              <tr>
			                <th class="text-center">Serial No.</th>
			                <th class=" text-center">Session</th>
			                <th class=" text-center">View</th>
			                <th class=" text-center">Print</th>
			              </tr>
			            </thead>
			            <tbody class="text-center">
			             
			                    <?php $i = 0 ?>
			                @foreach($timetables as $timetable)
				                <?php $i++ ?>
				                <tr>
				                    <td>{{ $i }}</td>
	                                <td>{{ $timetable->asessions['name'] or '' }}</td>
	                                <td>
		                                <a class="btn btn-primary" href="/teacher/{{$timetable->asessions['id']}}/{{$teacher->reg_no}}/teacher_timetable/view">
		                                   <i class="fa fa-eye fa-lg faa-pulse animated" aria-hidden="true"></i>
		                                </a>
	                                </td>
	                                <td>
		                                <a class="btn btn-success" href="/teacher/{{$timetable->asessions['id']}}/{{$teacher->reg_no}}/teacher_timetable/print">
		                                  <i class="fa fa-print" aria-hidden="true"></i>
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

@endsection
