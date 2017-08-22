<div class="col-md-12">
    <div class="panel panel-default">
        <div class="panel-heading">
            <button class="btn btn-primary btn-block">
                @if($teacher->isStaff()) Staff @else Teacher @endif Details 
            </button>
        </div>
        <div class="panel-body">
	       <div class="table-responsive">
	            <table class=" table table-bordered  table-hover">
		            <thead>
		                <tr>
			                <th class="text-center">Reg. No.</th>
			                <th class="text-center">
		                      @if($teacher->isStaff())
		                       Staff Name
		                       @else
		                       Teacher Name
		                       @endif
	                         </th>
	                    
			                <th class="text-center">Father Name</th>
	                        <th class="text-center">View Profile</th>
			                <th class="text-center">Attendance Details</th>
			                <th class="text-center">Take Attendance</th>
			                <th class="text-center">Applied Leaves</th>
		                </tr>
		            </thead>
		            <tbody>
		                <tr class="text-center">
		                    <td>{{ $teacher->reg_no }}</td>
		                    <td>{{ $teacher->name }}</td>
                            <td>{{ $teacher->father_name }}</td>
                            <td>
		                        <div class="text-center">
		                         <a class="btn btn-success" href="/st/teacher_staff/{{$teacher->reg_no}}"><i class="fa fa-eye fa-lg faa-pulse animated" aria-hidden="true"></i>
		                         </a>
		                        </div>
	                        </td>
		                 			               
		                    <td>
			                    <div class="text-center">
			                     <a class="btn btn-success" href="/st/teacher_staff/take_attendence/{{$teacher->uuid}}/{{$teacher->reg_no}}/details"><i class="fa fa-eye fa-lg faa-pulse animated" aria-hidden="true"></i>
			                     </a>
			                    </div>
		                    </td>

		                    <td>
			                    <div class="text-center">
			                     <a class="btn btn-success" href="/st/teacher_staff/take_attendence/{{$teacher->uuid}}/{{$teacher->reg_no}}"><i class="fa fa-eye fa-lg faa-pulse animated" aria-hidden="true"></i>
			                     </a>
			                    </div>
		                    </td>

		                    <td>
			                    <div class="text-center">
			                     <a class="btn btn-primary" href="/teacher_staff/{{$teacher->reg_no}}/applied_leave"><i class="fa fa-eye fa-lg faa-pulse animated" aria-hidden="true"></i>
			                     </a>
			                    </div>
		                    </td>

		                </tr>
		            </tbody>
	            </table>
	        </div>
        </div>
    </div>
</div>