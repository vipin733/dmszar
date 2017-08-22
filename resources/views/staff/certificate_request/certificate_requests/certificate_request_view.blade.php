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
			     <b>Certificate Request Details</b>
			   </button>
		       </div>
			  <div class="panel-body">
			    <div class="table-responsive">
			          <table class=" table table-bordered  table-hover">
			             <thead >          
			                 <tr>
			                  <th class="col-sm-3">Reg. No.</th>
			                  <td>{{ $ccrequest->students['reg_no'] }}</td> 
			                 </tr>
			                 <tr>
			                 <tr>
			                  <th class="col-sm-3">Request Date</th>
			                  <td>{{ $ccrequest['created_at']->format('d/m/Y') }}</td> 
			                 </tr>
			                 <tr>
			                 <tr>
			                  <th class="col-sm-3">Ticket no.</th>
			                  <td>{{ $ccrequest['ticket_no'] }}</td> 
			                 </tr>
			                 <tr>
			                  <th class="col-sm-3">Request For</th>
			                  <td>{{ $ccrequest->certificatecategories['name'] }}</td> 
			                 </tr>
			                 <tr>
			                  <th class="col-sm-3">Certificate Fee</th>
			                  <td>
			                  <i class="fa fa-inr" aria-hidden="true"></i> 
			                  {{ $ccrequest->certificatecategories['cfee'] }}
			                  </td> 
			                 </tr>
			                 <tr>
			                  <th class="col-sm-3">Description</th>
			                  <td>
			                  	@if( $ccrequest['description'])
			                  	{{ $ccrequest['description'] }}
			                  	@else
			                  	N/A
			                  	@endif
			                  </td> 
			                 </tr>
			                 <tr>
			                  <th class="col-sm-3">Status</th>
			                  <td>
			                  	@if($ccrequest->status == 0)
		                         Awaiting
		                         @else
		                        Ready
		                        @endif
			                  </td> 
			                 </tr> 
			                 <tr>
			                  <th class="col-sm-3">Certificate Fee Status</th>
			                  <td>
			                  	@if($ccrequest->fee_status == 0)
		                         Not Paid
		                         @else
		                          Paid
		                      @endif
			                  </td> 
			                 </tr> 
			                 
			                 @if(!$ccrequest->created_at == $ccrequest->updated_at)
			                 <tr>
			                  <th class="col-sm-3">Updated At</th>
			                  <td>{{ $ccrequest['updated_at']->format('d/m/Y h:i A') }}</td> 
			                 </tr>
			                 @endif
			                 @if($ccrequest->updated_by_id)
			                 <tr>
			                  <th class="col-sm-3">Updated By</th>
			                  <td>{{ $ccrequest->updated_by['name'] }}({{ $ccrequest->updated_by['reg_no'] }})</td> 
			                 </tr>
			                 @endif
			                 @if($ccrequest->remarks)
			                 <tr>
			                  <th class="col-sm-3">Remarks</th>
			                  <td>{{ $ccrequest['remarks'] }}</td> 
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
				      <form method="post" action="/staff/student/certificate/{{$ccrequest['ticket_no'] }}/{{$ccrequest['id']}}/{{strtotime($ccrequest['created_at'])}}/request/save" data-parsley-validate ="">
				      {{ csrf_field() }}
					      	<div class="form-group">
					      	    <label for="status">Status</label>
					      		<select class="form-control" name="status" required="">
					      		 @if($ccrequest['status'] == 0)
					      			<option value="0">Awaiting</option>
					      			<option value="1">Ready</option>
					      		@else
					      		<option value="1">Ready</option>
					      		<option value="0">Awaiting</option>
					      		@endif	
					      		</select>
					      	</div>
					      	<div class="form-group">
					      	    <label for="fee_status">Fee Status</label>
					      		<select class="form-control" name="fee_status" required="">
					      		 @if($ccrequest['fee_status'] == 0)
					      			<option value="0">Not Paid</option>
					      			<option value="1">Paid</option>
					      	     @else
					      	     <option value="1">Paid</option>
					      	     <option value="0">Not Paid</option>
					      	     @endif		
					      		</select>
					      	</div>
					      	<div class="form-group">
						      	<label for="remarks">Reply</label>
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