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
	            Applied  Leaves
	         </button>
	        </div>
	        <div class="panel-body">

	            <div class="text-center"  id="sandbox-container">
	                <form method="" id="search-form" class="form-inline" role="form">

		                <div class="input-daterange form-group input-group" id="datepicker">
			                <span class="input-group-addon">From</span>
			                <input type="text" class="input-sm form-control" id="from" name="from">
			                <span class="input-group-addon">to</span>
			                <input type="text" class="input-sm form-control" id="to" name="to">
		                </div>

		                 <div class="form-group">
		                    <select  id="session" class="form-control" name="session" >
		                        <option value="">---Select Session</option>
		                       @foreach($asessions as $key=>$value)
		                        <option value="{{ $key }}">{{ $value }}</option>
		                        @endforeach
		                    </select>
		                </div>

		                <div class="form-group">
		                    <select  id="status" class="form-control" name="status" >
		                        <option value="">---Select Status</option>
		                        <option value="1">Pending</option>
						        <option value="2">Rejected</option>
						      	<option value="3">Approved</option>
		                    </select>
		                </div>
	                     
	                    <div class="form-group">
			                <button type="submit" class="form-control btn btn-primary"><i class="fa fa-eye faa-pulse animated" aria-hidden="true"></i> Search</button>
			                <a href="/teacher_staff/{{$teacher->reg_no}}/applied_leave" class="btn btn-warning">Refresh</a>
			            </div>    

	                </form>
	            </div>

		        <div class="table-responsive col-md-12">
		         <br>
		            <table class=" table table-bordered  table-hover" id="userstable">
			            <thead>
			              <tr>
			                <th class="text-center">Serial No.</th>
			                <th class=" text-center">Apply Date</th>
			                <th class=" text-center">Session</th>
			                <th class=" text-center">Leave Type</th>
			                <th class=" text-center">Status</th>
			                <th class=" text-center">Action Taken By</th>
			                <th class="text-center">View</th>
			              </tr>
			            </thead>
			            <tbody class="text-center">
			              <?php $i = 0 ?>
			              @foreach($teacherleaves as $teacherleave)
			                <?php $i++ ?>
			                <tr>

			                    <td>{{ $i }}</td>
			                   
			                    <td>{{ $teacherleave['created_at']->format('d/m/Y') }}</td>
			                    <td>{{ $teacherleave->asessions['name'] or '' }}</td>

			                     <td>
			                    	@if($teacherleave->leave_type == 1)
		                            Full Day
		                            @else
		                            Half Day
		                            @endif
			                    </td>

			                    <td>
			                    	@if($teacherleave['status'] == 1)
		                            Pending
		                            @elseif($teacherleave['status'] == 2)
		                            Rejected
		                            @else
		                            Approved
		                            @endif
			                    </td>

			                    <td>
				                    <a href="/st/teacher_staff/{{$teacherleave->actiontakenby['reg_no']}}">
				                    	 {{ $teacherleave->actiontakenby['name']}}
				                    </a>
			                    </td>

			                    <td> 
				                    <a class="btn btn-primary btn-xs" href="/teacher_staff/applied/{{$teacherleave->id}}/leave-view">
				                     <i class="fa fa-eye" aria-hidden="true"></i>
				                    </a>
			                    </td>
			                    
			                </tr>
			              @endforeach  
			            </tbody>
		            </table>
		        </div>

	        </div>
	    </div>
	  {{ $teacherleaves->appends(request()->only(['from','to','session','status']))->links() }}
    </div>

@endsection

@section('script')
	<script type="text/javascript">

	      $(document).ready(function(){
	        $('#sandbox-container .input-daterange').datepicker({
	    format: "dd/mm/yyyy",
	    forceParse: false,
	    autoclose: true
	});
	           $('#search-form').on('submit', function(e) {
	               oTable.draw();
	               e.preventDefault();
	           });
	     
	})
	</script>   

@stop 