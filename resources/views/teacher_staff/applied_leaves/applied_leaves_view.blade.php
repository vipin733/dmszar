@extends('layouts.app')
@section('nav')
@include('staff.staff_nav')
@stop
@section('content')
 @if($teacherleave)
    <div class="row">

        <div class="col-md-8">
          	<div class="panel panel-default">
          	    <div class="panel-heading">
			        <button class="btn btn-primary btn-block">
			          <b>Applied  Leave Details</b>
			        </button>
		        </div>
			    <div class="panel-body">
			        <div class="table-responsive">
			           <table class=" table table-bordered  table-hover">
			                <thead >

				                <tr>
				                    <th class="col-sm-3">Applied By</th>
				                    <td>
					                    <a href="/st/teacher_staff/{{$teacherleave->teachers->reg_no or ''}}">
					                    	 {{ $teacherleave->teachers->name or ''}}
					                    </a>
				                    </td>
				                </tr>

				                <tr>
				                    <th class="col-sm-3">Leave Type</th>
				                    <td>

				                         @if($teacherleave->leave_type == 1)
			                            Full Day
			                            @else
			                            Half Day
			                            @endif
				                    </td>
				                </tr>
				                @if($teacherleave->leave_type == 1)

					                <tr>
					                    <th class="col-sm-3">Leave Date Start</th>
					                    <td>{{ $teacherleave['leave_start']->format('d/m/Y') }}</td>
					                </tr>

					                <tr>
					                    <th class="col-sm-3">Leave Date End</th>
					                    <td>{{ $teacherleave['leave_end']->format('d/m/Y') }}</td>
					                </tr>

                                @else

				                 <tr>
				                    <th class="col-sm-3">Leave Time Start</th>
				                    <td>{{ $teacherleave['leave_time_start']->format('h:i A') }}</td>
				                </tr>

				                <tr>
				                    <th class="col-sm-3">Leave Time End</th>
				                    <td>{{ $teacherleave['leave_time_end']->format('h:i A') }}</td>
				                </tr>

				                @endif

				                <tr>
					                <th class="col-sm-3">Apply Date</th>
					                <td>{{ $teacherleave['created_at']->format('d/m/Y') }}</td>
				                </tr>

				                <tr>
					                <th class="col-sm-3">Session</th>
					                <td>{{ $teacherleave->asessions['name'] or ''}}</td>
				                </tr>

				                <tr>
				                    <th class="col-sm-3">Reason</th>
				                    <td>{{ $teacherleave['reason'] }}</td>
				                </tr>

				                <tr>
				                    <th class="col-sm-3">Status</th>
				                    <td>
					                  	@if($teacherleave['status'] == 1)
			                            Pending
			                            @elseif($teacherleave['status'] == 2)
			                            Rejected
			                            @else
			                            Approved
			                            @endif
				                    </td>
				                </tr>

				                <tr>
				                    <th class="col-sm-3">Action Taken By</th>
				                    <td>{{ $teacherleave->actiontakenby['name'] or ''}}</td>
				                </tr>

				                <tr>
				                    <th class="col-sm-3">Action At</th>
				                    <td>
				                    	@if($teacherleave['created_at'] == $teacherleave['updated_at'])
					                    N/A
					                    @else
					                    {{ $teacherleave['updated_at']->format('d/m/Y, h:i A') }}
					                    @endif
				                    </td>
				                </tr>

                                <tr>
                                    <th class="col-sm-3">Remarks</th>
					                <td>
					                    @if($teacherleave->remarks)
					                    {{ $teacherleave->remarks }}
					                    @else
					                    N/A
					                    @endif
				                    </td>
			                    </tr>

			                </thead>
			            </table>
			        </div>
			    </div>
		    </div>
        </div>

        <div class="col-md-4">
            <div class="panel panel-default">
                <div class="panel-heading">
					<button class="btn btn-primary btn-block">
					     <b>Action</b>
					</button>
				</div>
                <div class="panel-body">

				    <form method="post" action="/teacher_staff/applied/{{$teacherleave->id}}/update" data-parsley-validate ="">
				        {{ csrf_field() }} {{ method_field('PATCH') }}

					    <div class="form-group">
					      	<label for="status">Status</label>
				      		<select class="form-control" name="status" required="">
					      		@if($teacherleave['status'] == 1)
					      			<option value="1">Pending</option>
					      			<option value="2">Rejected</option>
					      			<option value="3">Approved</option>
					      		@elseif($teacherleave['status'] == 2)
					      		    <option value="1">Rejected</option>
					      			<option value="2">Pending</option>
					      			<option value="3">Approved</option>
					      		@else
					      		    <option value="3">Approved</option>
			                        <option value="1">Pending</option>
					      			<option value="2">Rejected</option>
					      		@endif
				      		</select>
					    </div>

				      	<div class="form-group">
					      	<label for="remarks">Remarks</label>
					      	<textarea class="form-control" name="remarks">{{old('remarks',$teacherleave->remarks)}}</textarea>
					     </div>

					     <div>
					     	<button type="submit" class="btn btn-success btn-block">
					     		Submit
					     	</button>
					     </div>

					</form>
				</div>
		    </div>
	    </div>


    </div>
@endif
@stop

@section('script')
 <script src="https://cdnjs.cloudflare.com/ajax/libs/parsley.js/2.7.0/parsley.min.js" type="text/javascript"></script>
@stop
