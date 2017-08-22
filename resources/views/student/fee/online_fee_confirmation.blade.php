@extends('layouts.app')
@section('nav')
@include('student.student_nav')
@stop
@section('content')
  
  <div class="row">

    <div class="col-md-4">
  	   <button class="btn btn-primary btn-block">
	   <b>Confirmation of Online Fee Deposit</b>
      </button>
      <form action="/student/online_fee/confirmation" method="post" data-parsley-validate ="" >
      {{ csrf_field() }}
      
          	<div class="panel panel-default">
          	   <div class="panel-heading">
			    <a class="btn btn-primary btn-xs btn-block">
			     <b>Payment Mode Details</b>
			   </a>
		       </div>
			  <div class="panel-body">
			    <div class="table-responsive">
			          <table class=" table table-bordered  table-hover">
			             <thead >
			                 <tr>
			                  <th colspan="2" style="color: #e13b3b;">
			                  Note:Please check your Fee status, if receipts are updated, no need to fill the information.
			                  </th>			                
			                 </tr> 
			                 <tr>
			                  <th>Select Class</th>
			                  <td>
						        <select class="form-control" id="course" name="course" required="">
						        	<option value="">--Select Class</option>
						        	@foreach($courses as $course)
						             @if (Input::old('course') == $course->courses['id'])
						             <option value="{{ $course->courses['id'] }}" selected>{{ $course->courses['name'] }}</option>
						             @else
						            <option value="{{ $course->courses['id'] }}">{{ $course->courses['name'] }}</option>
						            @endif
						           @endforeach
						        </select>
						      </td> 
			                 </tr>         
			                 <tr>
			                  <th>Deposit Date</th>
			                  <td>
						        <input class="form-control" name="deposit_date" id="date_pic"  value="{{ old('deposit_date') }}" placeholder="ex-DD/MM/YYYY" required="" data-date-format="dd/mm/yyyy">
						      </td> 
			                 </tr> 	
			                 <tr>
			                  <th>Select Bank Name</th>
			                  <td>
						        <select class="form-control" id="bank_name" name="bank_name">
						            <option value="">--Select Bank</option>
						            @foreach($banknames as $bankname)
						             @if (Input::old('bank_name') == $bankname->banknames['id'])
						             <option value="{{ $bankname->banknames['id'] }}" selected>{{ $bankname->banknames['name'] }}</option>
						             @else
						             <option value="{{ $bankname->banknames['id'] }}">
						             {{ $bankname->banknames['name'] }}
						             </option>
						             @endif
						            @endforeach
						        </select>
						       </td>
			                 </tr>
			                 <tr>
			                  <th>Select App/Wallet Name</th>
			                  <td>
						        <select class="form-control" id="app_name" name="app_name">
						            <option value="">---Select App/Wallet</option>
						             @foreach($appnames as $appname)
						             @if (Input::old('app_name') == $appname->appnames['id'])
						             <option value="{{ $appname->appnames['id'] }}" selected>{{ $appname->appnames['name']}}</option>
						             @else
						             <option value="{{ $appname->appnames['id'] }}">{{ $appname->appnames['name']}}</option>
						             @endif
						             @endforeach
						        </select>
						       </td>
			                 </tr>
			                 <tr>
			                  <th>Transaction no.</th>
			                  <td>
			                    <input class="form-control" name="transaction_no" id="transaction_no"  
			                    value="{{ old('transaction_no') }}" placeholder="ex-2440444" required="">
						      </td> 
			                 </tr>	                         			                              
			             </thead>			 
			          </table>          
			    </div>
			  
		   
          	   <div class="panel-heading">
			    <a class="btn btn-primary btn-xs btn-block">
			     <b>Nature of Fee Deposit</b>
			   </a>
		       </div>
			 
			    <div class="table-responsive">
			          <table class=" table table-bordered  table-hover">
			             <thead >
			                          
			                 <tr>
			                  <th>Tuition Fee</th>
			                  <td>
						        <input type="text" class="form-control txt" name="tution_fee" id="tution_fee" 
						           data-parsley-type="number" />
						      </td> 
			                 </tr>
			                  @if(!Auth::user()->owner->schoolprofile['hostel_service'] == 0)  	
			                 <tr>
			                  <th>Hostel Fee</th>
			                  <td>
						            <input type="text" class="form-control txt" name="hostel_fee" id="hostel_fee"  
						              data-parsley-type="number" />
						      </td>
			                 </tr>
			                 @endif
			                @if(!Auth::user()->owner->schoolprofile['transport_service'] == 0)
			                 <tr>
			                  <th>Transport Fee</th>
			                  <td>
			                    <input type="text" class="form-control txt" name="transport_fee" id="transport_fee" 
			                      data-parsley-type="number" />
						      </td> 
			                 </tr>
			                 @endif	
			                 <tr>
			                  <th>Registration Fee</th>
			                  <td>
			                     <input type="text" class="form-control txt" name="registration_fee" id="registration_fee"
			                       data-parsley-type="number" />
						      </td> 
			                 </tr>
			                 <tr>
			                  <th>Late Fee</th>
			                  <td>
			                     <input type="text" class="form-control txt" name="late_fee" id="late_fee"
			                      data-parsley-type="number" />
						      </td> 
			                 </tr> 
			                 <tr>
			                  <th>Other Fee</th>
			                  <td>
			                     <input type="text" class="form-control txt" name="other_fee" id="other_fee"
			                      data-parsley-type="number" />
						      </td> 
			                 </tr>
			                 <tr>
			                  <th>Total</th>
			                  <td>			            
                                  <i class="fa fa-inr" aria-hidden="true"></i> <span id="sum">0</span>
						      </td> 
			                 </tr>
			                 <tr>
			                  <th>Remarks</th>
			                  <td>
			                     <textarea class="form-control" name="remarks" id="remarks"></textarea>
						      </td> 
			                 </tr>                        			                              
			             </thead>			 
			          </table>          
			    </div>
			    <div class="col-sm-8 col-sm-offset-2">
			  	 <button class="btn-success btn btn-block">Submit</button>
			    </div>
			  </div>

		    </div>
            
        </div>
    </form> 
    
    <div class="col-md-8">    
        <div class="panel panel-default">
          	   <div class="panel-heading">
			    <a class="btn btn-primary btn-block">
			     <b>Last Fee Confirmation Request</b>
			   </a>
		      </div>
			  <div class="panel-body">
			    <div class="table-responsive">
			          <table class=" table table-bordered  table-hover">
			             <thead >

			                 <tr>
			                   <th class="text-center">Date</th>
			                   <th class="text-center">Ticket no.</th>
			                   <th class="text-center">Transaction no.</th>
			                   <th class="text-center">Total</th>
			                   <th class="text-center">Status</th>
			                   <th class="text-center">View</th>
			                 </tr>	                         			                              
			             </thead>
			             <tbody>
			               @foreach($feeconfirmations as $feeconfirmation)
			             	<tr class="text-center">
			             		<td>
			             		{{ $feeconfirmation['created_at']->format('d/m/Y') }}
			             		</td>
			             		<td>{{ $feeconfirmation['ticket_no'] }}</td>
			             		<td>{{ $feeconfirmation['transaction_no'] }}</td>
			             		<td>
			             		   {{ $feeconfirmation['tution_fee'] + $feeconfirmation['hostel_fee'] + $feeconfirmation['transport_fee'] + $feeconfirmation['registration_fee'] + $feeconfirmation['late_fee'] + $feeconfirmation['other_fee'] }}
			             		 </td>
			             		 <td>
			             		 	@if($feeconfirmation->status == 1)
			             		 	Close
			             		 	@else
			             		 	Open
			             		 	@endif
			             		 </td>
			             		 <td>
			             		 	<a href="" data-toggle="modal" data-target="#{{$feeconfirmation['id']}}" class="btn btn-primary btn-xs"> <i class="fa fa-eye faa-pulse animated" aria-hidden="true"></i></a>
			             		  @include('student.fee.modal.online_fee_confirmation_modal')
			             		 </td>
			             	</tr>
			                @endforeach
			             </tbody>			 
			          </table> 
			    </div>

			    {{ $feeconfirmations->links() }}
			  </div>
		</div>            
    </div>   

</div>
    
@stop

@section('script')

<script>
  
	$(document).ready(function(){

		//iterate through each textboxes and add keyup
		//handler to trigger sum event
		$(".txt").each(function() {

			$(this).keyup(function(){
				calculateSum();
			});
		});

	});

	function calculateSum() {

		var sum = 0;
		//iterate through each textboxes and add the values
		$(".txt").each(function() {

			//add only if the value is number
			if(!isNaN(this.value) && this.value.length!=0) {
				sum += parseFloat(this.value);
			}

		});
		//.toFixed() method will roundoff the final sum to 2 decimal places
		$("#sum").html(sum.toFixed(2));
	}

   </script>
   <script src="https://cdnjs.cloudflare.com/ajax/libs/parsley.js/2.7.0/parsley.min.js" type="text/javascript"></script>
   <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.6.4/js/bootstrap-datepicker.min.js"></script>
 @include('partial.datepicker')
  

@endsection