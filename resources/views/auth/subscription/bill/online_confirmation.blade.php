@extends('layouts.app')
@section('nav')
@include('layouts.nav')
@stop
@section('content')

 @if(count($invoice_latest))

    <div class="row">
        <div class="col-md-4">
	        <button class="btn btn-primary btn-block">
		       <b>Confirmation of Online Fee Deposit</b>
	        </button>
	        <form action="/auth/bill/online-confirmation" method="post" data-parsley-validate ="" >
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
				                  <th>Select Due Month</th>
				                  <td>
							        <select class="form-control" id="unpaid_month" name="unpaid_month" required="">
							        	<option value="">--Select Due Month</option>
							        	@foreach($unpaids as $unpaid)
							             @if (Input::old('unpaid_month') == $unpaid['id'])
							             <option value="{{ $unpaid['id'] }}" selected>{{ $unpaid['month']->format('F, Y') }}</option>
							             @else
							            <option value="{{ $unpaid['id'] }}">{{ $unpaid['month']->format('F, Y') }}</option>
							            @endif
							           @endforeach
							        </select>
							      </td> 
				                </tr>
				                <tr>
				                  <th>Select Bank/App</th>
				                  <td>
							        <select class="form-control" id="bank_app" name="bank_app" required="">
							        	<option value="">--Select Method</option>
							        	<option value="SBI">SBI</option>
							        	<option value="PAYTM">PAYTM</option>
							        	<option value="BHIM">BHIM</option>
							        </select>
							      </td> 
				                </tr>  
				                <tr>
				                  <th>Payment Date</th>
				                  <td>
							        <input class="form-control" name="payment_date" id="date_pic"  value="{{ old('payment_date') }}" placeholder="ex-DD/MM/YYYY" required="" data-date-format="dd/mm/yyyy">
							      </td> 
				                </tr>
				                <tr>
				                  <th>Payment Amount</th>
				                  <td>
							        <input class="form-control" name="payment_amount"  value="{{ old('payment_amount') }}" placeholder="5000" required="">
							      </td> 
				                </tr>
				                <tr>
				                  <th>Transaction No</th>
				                  <td>
							        <input class="form-control" name="transaction_no" value="{{ old('transaction_no') }}" placeholder="BSI00444" required="">
							      </td> 
				                </tr> 
				                <tr>
				                  <th>Remarks</th>
				                  <td>
							        <textarea class="form-control" name="remarks" value="" placeholder="My trnascation BHIM Id is dmszar@upi" >{{ old('remarks') }}</textarea>
							      </td> 
				                </tr> 
				             </thead>
				          </table>
				        </div>
				        <div class="col-sm-6 col-sm-offset-3">
				            <button type="submit" class="btn-primary btn btn-block">Submit</button>
				        </div>    
				    </div>
				</div>
			</form>  
		</div>  
        
        <div class="col-md-8">
		    <div class="panel panel-default">
	          	<div class="panel-heading">
				    <a class="btn btn-primary btn-xs btn-block">
				     <b>Last Confirmation Details</b>
				    </a>
			    </div>
				<div class="panel-body">
				    <div class="table-responsive">
				        <table class=" table table-bordered  table-hover">
				            <thead >
				                <tr>
				               	    <th class="text-center">Due Month</th>
				               	    <th class="text-center">Invoice No.</th>
				                    <th class="text-center">Amount</th>
				                    <th class="text-center">Applied Date</th>
				               	    <th class="text-center">Action</th>
				               	    <th class="text-center">Confirmation</th>
				               	    <th class="text-center">Update</th>
				               	    <th class="text-center">View Invoice</th>
				                </tr>
				            </thead>
				            <tbody>
				             @foreach($userinvoices as $userinvoice)
				            	<tr class="text-center">
				            		<td>{{ $userinvoice->month->format('F, Y') }}</td>
				            		<td class="text-center">{{ $userinvoice->invoice_no }}</td>
    			            		<td class="text-center">
			                    	    <i class="fa fa-inr" aria-hidden="true"></i> 
			                    	     {{ $userinvoice->payment_amount }}
			                    	</td>
			                    	<td>{{ $userinvoice->billconfirmation->created_at->format('d/m/Y') }}</td>
			                    	<td>
			                    	  @if($userinvoice->payment_status == 1)
                                       Taken
			                    	   @else
			                    	   Awaiting
			                    	 @endif   
			                    	</td>
			                    	<td>
			                    	  @include('auth.subscription.bill.modal.online_confirmation_modal')
			                    	</td>
			                    	<td>
			                    	  @include('auth.subscription.bill.modal.online_confirmation_update_modal')
			                    	</td>
			                    	<td>
			                    	    <a class="btn btn-primary btn-sm" href="/auth/bill/{{$userinvoice->uuid}}/{{strtotime($userinvoice->month)}}/invoice">
			                    	     <i class="fa fa-eye faa-pulse animated" aria-hidden="true"></i>
                                        </a>
                                    </td>
				            	</tr>
				              @endforeach 	
				            </tbody>
				        </table>
				    </div>
				 </div>
		    </div>
		</div>   

    </div>

 @else
 <br><br>
 <H1  class="text-center" >No Bill Found</H1>  

@endif
@stop 
@section('script')
<script src="https://cdnjs.cloudflare.com/ajax/libs/parsley.js/2.7.0/parsley.min.js" type="text/javascript"></script>
<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.6.4/js/bootstrap-datepicker.min.js"></script>
 @include('partial.datepicker')

@endsection
