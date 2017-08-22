@extends('layouts.app')
@section('nav')
@include('staff.staff_nav')
@stop
@section('content')

    <div class="row">

        <div class="col-md-8">
          	<div class="panel panel-default">
          	   <div class="panel-heading">
			    <button class="btn btn-primary btn-block">
			     <b>Mark Sheet Request Details</b>
			   </button>
		       </div>
			  <div class="panel-body">
			    <div class="table-responsive">
			          <table class=" table table-bordered  table-hover">
			             <thead >          
			                 <tr>
			                  <th class="col-sm-3">Reg. No.</th>
			                  <td>{{ $marksheetrequest->students['reg_no']}}</td> 
			                 </tr>
			                 <tr>
			                  <th class="col-sm-3">Course</th>
			                  <td>{{ $marksheetrequest->courses['name']}}</td> 
			                 </tr>
			                 <tr>
			                 <tr>
			                  <th class="col-sm-3">Request Date</th>
			                  <td>{{ $marksheetrequest['created_at']->format('d/m/Y') }}</td> 
			                 </tr>

			                 <tr>
			                  <th class="col-sm-3">Ticket No.</th>
			                  <td>{{ $marksheetrequest['ticket_no'] }}</td> 
			                 </tr>

			                  @if($marksheetrequest->description)
			                 <tr>
			                  <th class="col-sm-3">Description</th>
			                  <td>
			                  {{$marksheetrequest->description}}
			                  </td> 
			                 </tr>  		                         			
			                 @endif 

			                 <tr>
			                    <th>Status</th>
			                 	<td>
			                       @if($marksheetrequest->status == 1)
			                         Ready
			                        @else
			                        Awaiting
			                      @endif 
			                    </td>
			                 </tr>

			                 @if(!$marksheetrequest->created_at == $marksheetrequest->updated_at)
			                 <tr>
			                  <th class="col-sm-3">Updated At</th>
			                  <td>
			                  {{$marksheetrequest['created_at']->format('d/m/Y h:i A') }}}}
			                  </td> 
			                 </tr>  		                         			
			                 @endif

			                 @if($marksheetrequest->updated_by_id)
			                 <tr>
			                  <th class="col-sm-3">Updated By</th>
			                  <td>
			                  {{$marksheetrequest->updated_by['name'] }}({{$marksheetrequest->updated_by['reg_no'] }})
			                  </td> 
			                 </tr>  		                         			
			                 @endif

			                  @if($marksheetrequest->remarks)
			                 <tr>
			                  <th class="col-sm-3">Remarks</th>
			                  <td>
			                  {{$marksheetrequest['remarks'] }}
			                  </td> 
			                 </tr>  		                         			
			                 @endif

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
				        <form method="post" action="/staff/student/{{$marksheetrequest['ticket_no']}}/{{$marksheetrequest['id']}}/{{strtotime($marksheetrequest['created_at'])}}/mark_sheet_save" data-parsley-validate ="">
				         {{ csrf_field() }}
					      	<div class="form-group">
					      	    <label>Status</label>
					      		<select class="form-control" name="status" required="">
					      		  @if($marksheetrequest['status'] == 1)
					      		    <option value="1">Ready</option>
					      			<option value="0">Awaiting</option>
					      		  @else
					      			<option value="0">Awaiting</option>
					      			<option value="1">Ready</option>
					      		  @endif	
					      		</select>
					      	</div>
					      	<div class="form-group">
						      	<label for="remarks" class="">Remarks</label>
						      	<textarea class="form-control" name="remarks"></textarea>
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

@stop   

@section('script')
 <script src="https://cdnjs.cloudflare.com/ajax/libs/parsley.js/2.7.0/parsley.min.js" type="text/javascript"></script>
@stop       