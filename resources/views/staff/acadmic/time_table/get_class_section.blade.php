@extends('layouts.app')
@section('nav')
@include('staff.staff_nav')
@stop
@section('content')

 <div class="row">
    <div class="col-md-12">
      <div class="panel panel-default">       
        <div class="panel-body">

            <div class="col-sm-8 col-sm-offset-2 text-center">
                <div class="panel-heading">
                  <button class="btn btn-default btn-block">School Lunch Break Time</button>
                </div>

                @if($lunchtime)
            	<div class="table-responsive">
		            <table class=" table table-bordered  table-hover">
			            <thead>
			                <th class="text-center">Start</th>              
			                <th class="text-center">End</th>
			                <th class="text-center">Edit</th>
			            </thead>		             
		                <tbody class="text-center">
		                    <tr>
		                    	<td>{{$lunchtime->start->format('h:i A')}}</td>
		                    	<td>{{$lunchtime->end->format('h:i A')}}</td>
		                    	<td>
		                    	  @include('staff.acadmic.lunchtime.lunch_time_update_modal')
		                    	</td>
		                    </tr>
		                </tbody>
		            </table>
		        </div>
		        @else
                   @include('staff.acadmic.lunchtime.lunch_time_store_modal')
		        @endif

            </div>

	        <div class="col-sm-12">
	            <div class="panel-heading">
	                <button class="btn btn-primary btn-block">Select Course Section</button>
	            </div>
				<div class="table-responsive">
		            <table class=" table table-bordered  table-hover">
			            <thead>
			                <th class="text-center col-sm-2">Course</th>              
			                <th colspan="{{$sections}}" class="text-center">
			                     Section                   
			                </th>
			            </thead>
		             
		                <tbody class="text-center">
			               @if($courses)
			               @foreach($courses as $course)
			                <tr>             
			                    <td>{{ $course->name }}</td>
			                     @foreach($course->sections as $section)
			                      <td><a href="/staff/acadmic/{{$course->id}}/{{strtotime($course->created_at)}}/{{$section->id}}/{{strtotime($section->created_at)}}/make_timetable" class="btn btn-primary btn-sm">{{ $section['name'] }}</a>
			                      </td>
			                     @endforeach
			                </tr> 
			               @endforeach
			               @endif 
		                </tbody>                                                             	           
		            </table>
		        </div>
		    </div>    

	    </div>
	  </div>           
	</div>	    	
 </div>

@stop

@section('script')

<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.18.1/moment.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/parsley.js/2.7.0/parsley.min.js" type="text/javascript"></script>
<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datetimepicker/4.17.47/js/bootstrap-datetimepicker.min.js"></script>

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

  })

</script>


@stop 


