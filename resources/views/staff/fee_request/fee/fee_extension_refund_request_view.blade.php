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
			     <b>Fee Extension/Refund Request Details</b>
			   </button>
		       </div>
			<div class="panel-body">

			    <div class="table-responsive">
			          <table class=" table table-bordered  table-hover">
			             <thead >          
			                 <tr>
			                  <th class="col-sm-3">Reg. No.</th>
			                  <td>{{ $feerequest->students['reg_no'] }}</td> 
			                 </tr>
			                 <tr>
			                 <tr>
			                  <th class="col-sm-3">Request Date</th>
			                  <td>{{ $feerequest['created_at']->format('d/m/Y') }}</td> 
			                 </tr>
			                 <tr>
			                  <th class="col-sm-3">Category</th>
			                  <td>{{ $feerequest->feerequestcategories['name'] }}</td> 
			                 </tr>
			                  <tr>
			                  <th class="col-sm-3">Description</th>
			                  <td>
			                  @if($feerequest['description'])
			                  {{ $feerequest['description'] }}
			                  @else
			                  N/A
			                  @endif
			                  </td> 
			                 </tr>
			                 @if(!$feerequest->created_at == $feerequest->updated_at)
			                 <tr>
			                  <th class="col-sm-3">Updated At</th>
			                  <td>{{ $feerequest['updated_at']->format('d/m/Y h:i A') }}</td> 
			                 </tr>
			                 @endif
			                 @if($feerequest->remarks) 
			                 <tr>
			                  <th class="col-sm-3">Remarks</th>
			                  <td>{{ $feerequest['remarks'] }}</td> 
			                 </tr> 
			                 <tr>
			                 @endif
			                 @if($feerequest->action_taken_by_id)
			                  <th class="col-sm-3">Updated By</th>
			                  <td>
			                  {{ $feerequest->action_taken_by['name'] }}
			                  ({{ $feerequest->action_taken_by['reg_no'] }})
			                  </td> 
			                 </tr> 
			                 @endif 
			                 <tr>
			                  <th class="col-sm-3">Status</th>
			                  <td>
			                   @if($feerequest->status == 1)
		                         Awaiting
		                         @elseif($feerequest->status == 2)
		                         Aproved
		                        @else
		                        Rejected
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
				      	  <form action="/staff/fee/extensions/refund/{{$feerequest['ticket_no']}}/{{$feerequest['id']}}/{{strtotime($feerequest->created_at)}}/request_save" method="post" data-parsley-validate ="">
				      	  {{ csrf_field() }}
					      	<div class="form-group">
					      	    <label>Status</label>
					      		<select class="form-control" name="status" required="">
					      		@if($feerequest->status == 1)
					      			<option value="1">Awaiting</option>
					      			<option value="2">Approved</option>
					      			<option value="3">Reject</option>
					      	    @elseif($feerequest->status == 2)
					      	    <option value="2">Approved</option>
					      	    <option value="1">Awaiting</option>
					      	    <option value="3">Reject</option>
					      	    @else
					      	    <option value="3">Reject</option>
					      	     <option value="2">Approved</option>
					      	    <option value="1">Awaiting</option>
					      	    @endif		
					      		</select>
					      	</div>
					      	<div class="form-group">
						      	<label for="remarks" class="">Reply</label>
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
@endsection