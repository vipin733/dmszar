@extends('layouts.app')
@section('nav')
@include('superadmin.layouts.superadmin_nav')
@stop
@section('content')


	<div class="row">

	    <div class="col-md-12 studentprofile">
		    <div class="panel panel-default">
			    <div class="panel-heading">
			        <button class="btn btn-primary btn-block">
			         <b>Users Invoices Information</b>
			        </button>
			    </div>  
		        <div class="panel-body"> 
		       
		            <div class="table-responsive">
		                <table class=" table table-bordered  table-hover" id="users">
		                    <thead>
				                <tr>
					                <th class="text-center">Month</th>
			                   	    <th class="text-center">Invoice/Reciept No.</th>
			                   	    <th class="text-center">Payment Amount</th>
			                   	    <th class="text-center">Payment Method</th>
			                   	    <th class="text-center">Payment Date</th>
			                   	    <th class="text-center">View Confirmation</th>
			                   	    <th class="text-center">Status</th>
			                   	    <th class="text-center">Update</th>
				                </tr>
		                    </thead>
		                    <tbody>
		                        @foreach($user->invoices as $invoice)
			                    <tr class="text-center">
			                    	<td class="text-center">{{ $invoice->month->format('F, Y') }}</td>
			                    	<td class="text-center">{{ $invoice->invoice_no }}</td>
			                    	<td class="text-center">
			                    	    <i class="fa fa-inr" aria-hidden="true"></i> 
			                    	     {{ $invoice->payment_amount }}
			                    	</td>
			                    	<td class="text-center">{{ $invoice->payment_method }}</td>
			                    	<td class="text-center">{{ $invoice->payment_date->format('d/m/Y') }}</td>
			                    	<td class="text-center">
			                    	  @if($invoice->billconfirmation)
			                    		@include('superadmin.users.invoices.user_payment_confirmation_modal')
			                          @endif		
			                    	</td>
			                    	<td class="text-center">
			                    	@if( $invoice->payment_status == 1)
			                    	  Paid
			                    	  @else
			                    	  Unpaid
			                    	@endif  
			                    	</td>
			                    	<td class="text-center">
			                    	  @if($invoice->billconfirmation)
			                    	    @include('superadmin.users.invoices.user_payment_update_modal')
			                    	  @endif  
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

@stop

@section('script')
 <script src="https://cdnjs.cloudflare.com/ajax/libs/parsley.js/2.7.0/parsley.min.js" type="text/javascript"></script>
 <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.6.4/js/bootstrap-datepicker.min.js"></script>
 @include('partial.datepicker')
@stop