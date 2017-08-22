@extends('layouts.app')
@section('nav')
@include('staff.staff_nav')
@stop
@section('content')

<div class="row">     
    <div class="col-md-12">
        <div class="panel panel-default">
            <div class="panel-heading">
               <button class="btn btn-primary btn-block">Make Time Table({{$activesession->name}})</button>
            </div>
            <div class="panel-body">

                <div class="col-sm-12">
	                <div class="table-responsive">
			            <table class=" table table-bordered  table-hover">
				            <thead>
				                <tr>
				                    <th class="text-center">Class</th>              
					                <td class="text-center">{{$course->name}}</td>
				               
				                    <th class="text-center">Section</th>              
					                <td class="text-center">{{$section->name}}</td>

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

					                <th class="text-center">Print</th>              
					                <td class="text-center">
						                <a href="/staff/acadmic/{{$course->id}}/{{strtotime($course->created_at)}}/{{$section->id}}/{{strtotime($section->created_at)}}/print_timetable" class="btn btn-success btn-xs">
						                   <i class="fa fa-print faa-pulse animated" aria-hidden="true"></i>
						                </a>
					                </td>
				                </tr>
				            </thead>
	                    </table>
	                </div>
                </div>

                <div class="col-sm-12">
                	

                	<div class="table-responsive">
			            <table class=" table table-bordered  table-hover" data-form="deleteForm">

				            <thead>
				                <tr>
			                        <th colspan="2" class="text-center">Timing</th>
			                        <th colspan="7" class="text-center">
			                          Day
			                          <b class="pull-left">S = Subject, T = Teacher, R = Remarks</b>
			                        </th>
			                        <th rowspan="2" class="text-center">Action</th>
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
				            	       @if( $timetable->sundaysubjects['name'])
				            	         S-{{ $timetable->sundaysubjects['name'] }}<br>
				            	       @endif
				            	       @if( $timetable->sundayteachers['name'])
				            	         T-{{ $timetable->sundayteachers['name'] }}<br>
				            	       @endif
				            	       @if($timetable->sunday_remarks)
				            	         R-{{ $timetable->sunday_remarks }}
				            	       @endif
				            	    </td>
				            	    <td>
				            	       @if( $timetable->mondaysubjects['name'] )
				            	         S-{{ $timetable->mondaysubjects['name'] }}<br>
				            	       @endif
				            	       @if( $timetable->mondayteachers['name'])
				            	         T-{{ $timetable->mondayteachers['name'] }}<br>
				            	       @endif
				            	       @if($timetable->monday_remarks)
				            	         R-{{ $timetable->monday_remarks }}
				            	       @endif
				            	    </td>
				            	    <td>
				            	       @if( $timetable->tuesdaysubjects['name'] )
				            	         S-{{ $timetable->tuesdaysubjects['name'] }}<br>
				            	       @endif
				            	       @if( $timetable->tuesdayteachers['name'])
				            	         T-{{ $timetable->tuesdayteachers['name'] }}<br>
				            	       @endif
				            	       @if($timetable->tuesday_remarks)
				            	         R-{{ $timetable->tuesday_remarks }}
				            	       @endif
				            	    </td>
				            	    <td>
				            	       @if( $timetable->wednesdaysubjects['name'] )
				            	         S-{{ $timetable->wednesdaysubjects['name'] }}<br>
				            	       @endif
				            	       @if( $timetable->wednesdayteachers['name'])
				            	         T-{{ $timetable->wednesdayteachers['name'] }}<br>
				            	       @endif
				            	       @if($timetable->wednesday_remarks)
				            	         R-{{ $timetable->wednesday_remarks }}
				            	       @endif
				            	    </td>
				            	    <td>
				            	       @if( $timetable->thursdaysubjects['name'] )
				            	         S-{{ $timetable->thursdaysubjects['name'] }}<br>
				            	       @endif
				            	       @if( $timetable->thursdayteachers['name'])
				            	         T-{{ $timetable->thursdayteachers['name'] }}<br>
				            	       @endif
				            	       @if($timetable->thursday_remarks)
				            	         R-{{ $timetable->thursday_remarks }}
				            	       @endif
				            	    </td>
				            	    <td>
				            	       @if( $timetable->fridaysubjects['name'] )
				            	         S-{{ $timetable->fridaysubjects['name'] }}<br>
				            	       @endif
				            	       @if( $timetable->fridayteachers['name'])
				            	         T-{{ $timetable->fridayteachers['name'] }}<br>
				            	       @endif
				            	       @if($timetable->friday_remarks)
				            	         R-{{ $timetable->friday_remarks }}
				            	       @endif
				            	    </td>
				            	    <td>
				            	       @if( $timetable->saturdaysubjects['name'] )
				            	         S-{{ $timetable->saturdaysubjects['name'] }}<br>
				            	       @endif
				            	       @if( $timetable->saturdayteachers['name'])
				            	         T-{{ $timetable->saturdayteachers['name'] }}<br>
				            	       @endif
				            	       @if($timetable->saturday_remarks)
				            	         R-{{ $timetable->saturday_remarks }}
				            	       @endif
				            	    </td>
				            	    <td>
				            	        @include('staff.acadmic.time_table.partial.timetable_delete_form')
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


    <div class="col-md-12 ">
        <button type="button" class="btn btn-primary btn-block">
           Class Time Table Generator({{$activesession->name}})
        </button>
            @include('partial.errors')
	        <div class="table-responsive">
	            <table class=" table table-bordered  table-hover">

	                <thead>
	                    <tr>
	                        <th colspan="" class="text-center">Timing</th>
	                        <th colspan="7" class="text-center">
	                           Day
	                           
	                        </th>
	                    </tr>
	                    <tr>                                  
	                        <th class="text-center">Start/End</th>
	                        
	                      @foreach($days as $day)
	                        <th  class="text-center">{{ $day->name }}</th>
	                      @endforeach
	                    </tr>
	                </thead>

	                <tbody>

	                <form method="post" action="/staff/acadmic/{{$course->id}}/{{strtotime($course->created_at)}}/{{$section->id}}/{{strtotime($section->created_at)}}/make_timetable_store" data-parsley-validate ="">
				      {{ csrf_field() }}
	                    <tr class="text-center">

	                        <td class="col-sm-1">
	                         <br>
	                            <div class="form-group">
		                          <input type="text" class="form-control" id="start" name="start" value="{{ old('start') }}" required="" />
	                            </div>
                               <br>
	                            <div class="form-group">					                        		
	                                <input type="text" class=" form-control" id="end" name="end" value="{{ old('end') }}" required="" >
	                            </div>
	                        </td> 

	                                                    
	                        <td>

	                            @component('staff.acadmic.time_table.partial.select_component')

	                              @slot('subject_nameid')
	                               sunday_subject
	                              @endslot
	                              @slot('teacher_nameid')
	                                sunday_teacher
	                              @endslot
	                              @slot('remarks_nameid')
	                                sunday_remarks
	                              @endslot

	                            @endcomponent

	                        </td>

	                         <td>

	                            @component('staff.acadmic.time_table.partial.select_component')

	                              @slot('subject_nameid')
	                               monday_subject
	                              @endslot
	                              @slot('teacher_nameid')
	                                monday_teacher
	                              @endslot
	                              @slot('remarks_nameid')
	                                monday_remarks
	                              @endslot

	                            @endcomponent

	                        </td>

	                        <td>

	                            @component('staff.acadmic.time_table.partial.select_component')

	                              @slot('subject_nameid')
	                               tuesday_subject
	                              @endslot
	                              @slot('teacher_nameid')
	                                tuesday_teacher
	                              @endslot
	                              @slot('remarks_nameid')
	                                 tuesday_remarks
	                              @endslot

	                            @endcomponent
	                            
	                        </td>

	                        <td>
	                        
	                             @component('staff.acadmic.time_table.partial.select_component')

	                              @slot('subject_nameid')
	                               wednesday_subject
	                              @endslot
	                              @slot('teacher_nameid')
	                                wednesday_teacher
	                              @endslot
	                              @slot('remarks_nameid')
	                                 wednesday_remarks
	                              @endslot

	                            @endcomponent

	                        </td>

	                        <td>

	                            @component('staff.acadmic.time_table.partial.select_component')

	                              @slot('subject_nameid')
	                               thursday_subject
	                              @endslot
	                              @slot('teacher_nameid')
	                                thursday_teacher
	                              @endslot
	                              @slot('remarks_nameid')
	                                 thursday_remarks
	                              @endslot

	                            @endcomponent
	                            
	                        </td>

	                        <td>
	                            
	                             @component('staff.acadmic.time_table.partial.select_component')

	                              @slot('subject_nameid')
	                               friday_subject
	                              @endslot
	                              @slot('teacher_nameid')
	                                friday_teacher
	                              @endslot
	                              @slot('remarks_nameid')
	                                friday_remarks
	                              @endslot

	                            @endcomponent

	                        </td>
	                        <td>

	                             @component('staff.acadmic.time_table.partial.select_component')

	                              @slot('subject_nameid')
	                               saturday_subject
	                              @endslot
	                              @slot('teacher_nameid')
	                                saturday_teacher
	                              @endslot
	                              @slot('remarks_nameid')
	                                saturday_remarks
	                              @endslot

	                            @endcomponent
	                            

	                        </td>
	                        
	                    </tr>	                    

	                </tbody>

	            </table>


	        <div class="col-sm-6 col-sm-offset-3">

	           <button type="submit" class="btn btn-primary btn-block">Submit</button>
	        	
	        </div>

            </form>
	        </div>         
   
    </div>

</div>
<br>

@stop 

@section('script')

<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.18.1/moment.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/parsley.js/2.7.0/parsley.min.js" type="text/javascript"></script>
<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datetimepicker/4.17.47/js/bootstrap-datetimepicker.min.js"></script>
@include('staff.add.destroy_modal_javascript')

 <script type="text/javascript">      

      $(document).ready(function(){

	    $(function () {
	        $('#start').datetimepicker({
	           format: 'LT',
	           stepping:5
	        });
	    });

	    $(function () {
	        $('#end').datetimepicker({
	          format: 'LT',
	          stepping:5
	        });
	    });

	    $(function () {
	        $('#break_start').datetimepicker({
	           format: 'LT',
	           stepping:5
	        });
	    });

	    $(function () {
	        $('#break_end').datetimepicker({
	          format: 'LT',
	          stepping:5
	        });
	    });
	})   



</script>

@include('staff.acadmic.time_table.partial.javascript_timetable')

@stop 
