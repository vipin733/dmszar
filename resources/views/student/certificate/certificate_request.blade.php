@extends('layouts.app')
@section('nav')
@include('student.student_nav')
@stop
@section('content')

<div class="row">

    <div class="col-md-4">  	  
        <div class="panel panel-default">
            <div class="panel-heading">
			    <button class="btn btn-primary btn-block">
			     <b>Certificate Request Form</b>
			   </button>
		    </div>

          	<form action="/student/cetrificate/request" method="post" data-parsley-validate ="">   
          	{{ csrf_field() }}
			    <div class="panel-body">   
			         <p style="color: #e13b3b; text-align: justify;" >
			                  <b>Note:Please before applying for the certificates, pay the due fees; otherwise we can proceed further request.</b>
			          </p>              	                  
			        <div class="table-responsive">				       
			            <table class=" table table-bordered  table-hover">			         
			             <thead >	
			                 <tr>
			                  <th>Select a Certificate</th>
			                  <td>
						          <select class="form-control" id="category" name="category" required="">
						            <option value="">---Select a Certificate</option>
							           @foreach($ccategories as $ccategory)
							             @if (Input::old('category') == $ccategory->id)
							             <option value="{{ $ccategory->id }}" selected>{{ $ccategory->name }}</option>
							             @else
							            <option value="{{ $ccategory->id }}">{{ $ccategory->name }}</option>
							            @endif
							           @endforeach
						          </select>
						       </td>
			                 </tr>
			                 <tr>
			                  <th>Description</th>
			                  <td>
			                    <textarea class="form-control" name="description" id="description"  
			                     >{{ Input::old('description') }}</textarea> 
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

    <div class="col-md-8">  	  
        <div class="panel panel-default">
               <div class="panel-heading">
			    <button class="btn btn-primary btn-block">
			     <b>View Certificate Request</b>
			   </button>
		        </div>
			    <div class="panel-body">                 	                  
			        <div class="table-responsive">				       
			            <table class=" table table-bordered  table-hover">			         
			             <thead >
			                <tr>
			                	<th class="text-center">Ticket no.</th>
			                	<th class="text-center">Date</th>
			                	<th class="text-center">Request For</th>
			                	<th class="text-center">Status</th>
			                	<th class="text-center">Fee Status</th>
			                	<th class="text-center col-sm-1">Certificate Fee</th>
			                	<th class="text-center">View</th>
			                </tr> 
			             </thead>
			             <tbody>
			             @foreach($ccrequests as $ccrequest)
			             	<tr class="text-center">
			             		<td>{{ $ccrequest['ticket_no'] }}</td>
			             		<td>{{ $ccrequest['created_at']->format('d/m/Y') }}</td>
			             		<td>{{ $ccrequest->certificatecategories['name'] }}</td>
			             		<td>
			             			@if($ccrequest->status == 0)
			             			 Awaiting
			             			 @else
			             			Ready
			             			@endif 
			             		</td>
			             		<td>
			             			@if($ccrequest->fee_status == 0)
			             			 Not Paid
			             			 @else
			             			Paid
			             			@endif 
			             		</td>
			             		<td class="col-sm-1"><i class="fa fa-inr" aria-hidden="true"></i>  {{ $ccrequest->certificatecategories['cfee'] }}</td>
			             		<td>
			             		 <a href="" data-toggle="modal" data-target="#{{$ccrequest->id}}" class="btn btn-primary btn-xs"> <i class="fa fa-eye faa-pulse animated" aria-hidden="true"></i></a>
			             		  @include('student.certificate.modal.certificate_request_modal')
			             		</td>
			             	</tr>
			             @endforeach 	
			             </tbody>			 
			            </table>          
			        </div>
			    </div>

			    {{ $ccrequests->links() }}     
        </div>        
    </div>

</div>        

@stop

@section('script')
<script src="https://cdnjs.cloudflare.com/ajax/libs/parsley.js/2.7.0/parsley.min.js" type="text/javascript"></script>

@stop