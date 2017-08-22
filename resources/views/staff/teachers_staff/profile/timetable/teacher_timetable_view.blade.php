@extends('layouts.app')
@section('nav')
@include('staff.staff_nav')
@stop
@section('content')

    <div class="row">
       
       @include('staff.teachers_staff.profile.profile_detail')
	    
    </div>

    <div class="row">

        <div class="panel panel-primary">
            <div class="panel-heading text-center"><b>Time Table({{ $session['name'] }})</b></div>
            <div class="panel-body">

		        <div class="col-md-12">
		            <div class="table-responsive">
			            <table class=" table table-bordered  table-hover">
				            <thead>
				              <tr>
				               
				                <th class="text-center">Lunch Break Start</th>              
				                <td class="text-center">
				                  @if($lunchtime['start'])
				                  {{$lunchtime['start']->format('h:i A')}}
				                  @else
				                  N/A
				                  @endif
				                </td>

				                <th class="text-center">Lunch Break End</th>              
				                <td class="text-center">
				                  @if($lunchtime['end'])
				                  {{$lunchtime['end']->format('h:i A')}}
				                  @else
				                  N/A
				                  @endif
				                </td>

				              </tr>
				            </thead>
			            </table>
		            </div>
		        </div>  

		        <div class="col-md-12">
		            <div class="table-responsive">
			            <table class=" table table-bordered  table-hover">
				            <thead>
				                <tr>
				                  <th colspan="2" class="text-center">Timing</th>
				                  <th colspan="7" class="text-center">
				                    Day
				                    <b class="pull-left">S = Subject, C = Class, Se = Section, R = Remarks</b>
				                  </th>
				                </tr>
				                <tr>                                  
				                  <th class="text-center">Start</th>
				                  <th class="text-center">End</th>                                
				                  @foreach($days as $day)
				                   <th  class="text-center">{{ $day->name }}</th>
				                  @endforeach                          
				                </tr>
				            </thead>

				            <tbody>

				            @foreach($timetables as $timetable)
				              <tr class="text-center">

				                  <td>{{$timetable['start']->format('h:i A')}}</td>
				                  <td>{{$timetable['end']->format('h:i A')}}</td>
				                   <td>
				                     @if($timetable->sunday_teacher_id == $teacher->id)
					                     S-{{ $timetable->sundaysubjects['name'] }}<br>
					                     C-{{ $timetable->courses['name'] }}<br>
					                     Se-{{ $timetable->sections['name'] }}<br>
					                     @if($timetable->sunday_remarks)
					                     R-{{ $timetable->sunday_remarks }}
					                     @endif
					                 @endif    
				                  </td>
				                  <td>
				                    @if($timetable->monday_teacher_id == $teacher->id)
					                     S-{{ $timetable->mondaysubjects['name'] }}<br>
					                     C-{{ $timetable->courses['name'] }}<br>
					                     Se-{{ $timetable->sections['name'] }}<br>
					                     @if($timetable->monday_remarks)
					                     R-{{ $timetable->tuesday_remarks }}
					                     @endif
					                @endif      
				                  </td>
				                  <td>
				                    @if($timetable->tuesday_teacher_id == $teacher->id)
					                     S-{{ $timetable->tuesdaysubjects['name'] }}<br>
					                     C-{{ $timetable->courses['name'] }}<br>
					                     Se-{{ $timetable->sections['name'] }}<br>
					                     @if($timetable->tuesday_remarks)
					                     R-{{ $timetable->tuesday_remarks }}
					                     @endif
					                @endif   
				                  </td>
				                  <td>
				                      @if($timetable->wednesday_teacher_id == $teacher->id)
					                     S-{{ $timetable->wednesdaysubjects['name'] }}<br>
					                     C-{{ $timetable->courses['name'] }}<br>
					                     Se-{{ $timetable->sections['name'] }}<br>
					                     @if($timetable->wednesday_remarks)
					                     R-{{ $timetable->wednesday_remarks }}
					                     @endif
					                   @endif   
				                  </td>
				                  <td>
				                      @if($timetable->thursday_teacher_id == $teacher->id)
					                     S-{{ $timetable->thursdaysubjects['name'] }}<br>
					                     C-{{ $timetable->courses['name'] }}<br>
					                     Se-{{ $timetable->sections['name'] }}<br>
					                     @if($timetable->thursday_remarks)
					                     R-{{ $timetable->thursday_remarks }}
					                     @endif
					                  @endif    
				                  </td>
				                  <td>
				                     @if($timetable->friday_teacher_id == $teacher->id)
					                     S-{{ $timetable->fridaysubjects['name'] }}<br>
					                     C-{{ $timetable->courses['name'] }}<br>
					                     Se-{{ $timetable->sections['name'] }}<br>
					                     @if($timetable->friday_remarks)
					                     R-{{ $timetable->friday_remarks }}
					                     @endif
					                 @endif   
				                  </td>
				                  <td>
				                    @if($timetable->saturday_teacher_id == $teacher->id)
					                     S-{{ $timetable->saturdaysubjects['name'] }}<br>
					                     C-{{ $timetable->courses['name'] }}<br>
					                     Se-{{ $timetable->sections['name'] }}<br>
					                     @if($timetable->saturday_remarks)
					                     R-{{ $timetable->saturday_remarks }}
					                     @endif
					                 @endif     
				                  </td>
				                </tr>
				              @endforeach
				            </tbody>
			            </table>
			        </div>    
		        </div>

            </div>
        </div> 

        <div class="col-md-6 col-md-offset-3 text-center">
        	<a href="/teacher/{{$session['id']}}/{{$teacher->reg_no}}/teacher_timetable/print" class="btn btn-warning ">Print</a>    
        </div>

    </div>
    <br>

@stop
