@extends('layouts.app')
@section('nav')
@include('student.student_nav')
@stop
@section('content')

<div class="row">

    <div class="col-md-5">  	  
        <div class="panel panel-default">
            <div class="panel-heading">
			    <button class="btn btn-primary btn-block">
			     <b>Fee Request Form</b>
			   </button>
		    </div>
          	<form action="/student/fee/request" method="post" data-parsley-validate ="">   
          	{{ csrf_field() }}
			    <div class="panel-body">                 	                  
			        <div class="table-responsive">				       
			            <table class=" table table-bordered  table-hover">			         
			             <thead >	
			                 <tr>
			                  <th>Select Category</th>
			                  <td>
						          <select class="form-control" id="category" name="category" required="">
						            <option value="">---Select Category</option>
							            @foreach($feerequestcategories as $key=>$value)
							             @if (Input::old('permanent_district') == $key)
							             <option value="{{ $key }}" selected>{{ $value }}</option>
							             @else
							            <option value="{{ $key }}">{{ $value }}</option>
							            @endif
							           @endforeach
						          </select>
						       </td>
			                 </tr>
			                 <tr>
			                  <th>Description</th>
			                  <td>
			                    <textarea class="form-control" name="description" id="description"  
			                     required="">{{ Input::old('description') }}</textarea> 
						      </td> 
			                 </tr>	                         			                              
			             </thead>			 
			            </table>          
			        </div>
			        <div class="col-sm-6 col-sm-offset-3">
	        	     <button class="btn btn-success btn-block">Submit</button>
	                 </div>
                  </div>
            </form>     
        </div>        
    </div>

    <div class="col-md-7">  	  
        <div class="panel panel-default">
               <div class="panel-heading">
			    <button class="btn btn-primary btn-block">
			     <b>View Fee Request</b>
			   </button>
		        </div>
			    <div class="panel-body">                 	                  
			        <div class="table-responsive">				       
			            <table class=" table table-bordered  table-hover">			         
			             <thead >
			                <tr>
			                	<th class="text-center">Ticket no.</th>
			                	<th class="text-center">Date</th>
			                	<th class="text-center">Category</th>
			                	<th class="text-center">Status</th>
			                	<th class="text-center">View</th>
			                </tr> 
			             </thead>
			             <tbody>
			             @foreach($feerequests as $feerequest)
			             	<tr class="text-center">
			             		<td>{{ $feerequest['ticket_no'] }}</td>
			             		<td>{{ $feerequest['created_at']->format('d/m/Y') }}</td>
			             		<td>{{ $feerequest->feerequestcategories['name'] }}</td>
			             		<td>
			             			@if($feerequest->status == 1)
			             			 Awaiting
			             			 @elseif($feerequest->status == 2)
			             			 Approved
			             			@else
			             			Rejected
			             			@endif 
			             		</td>
			             		<td>
			             		 <a href="" data-toggle="modal" data-target="#{{$feerequest['id']}}" class="btn btn-primary btn-xs"> <i class="fa fa-eye faa-pulse animated" aria-hidden="true"></i></a>
			             		  @include('student.fee.modal.fee_request_modal')
			             		</td>
			             	</tr>
			             @endforeach 	
			             </tbody>			 
			            </table>          
			        </div>
			    </div>

			    {{ $feerequests->links() }}       
        </div>        
    </div>

</div>        

@stop

@section('script')
<script src="https://cdnjs.cloudflare.com/ajax/libs/parsley.js/2.7.0/parsley.min.js" type="text/javascript"></script>

@stop