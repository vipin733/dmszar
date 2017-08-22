@extends('layouts.app')
@section('nav')
@include('layouts.nav')
@stop
@section('content')

    <div class="row">
     
       <div class="text-center">
            <div class="panel panel-default">
                <div class="panel-heading">
                    <button class="btn btn-primary btn-block">
                        <b>My Last Bill Details</b>
                    </button>
                </div>  
                <div class="panel-body">

                     <div class="table-responsive">
		 		        <table class=" table table-bordered  table-hover" data-form="deleteForm">
			                <thead>
			                    <tr>
			                   	    <th class="text-center">Month</th>
			                   	    <th class="text-center">Invoice/Receipt No.</th>
			                   	    <th class="text-center">Payment Amount</th>
			                   	    <th class="text-center">Payment Method</th>
			                   	    <th class="text-center">Payment Date</th>
			                   	    <th class="text-center">Status</th>
			                   	    <th class="text-center">Pay Now</th>
			                   	    <th class="text-center">Action</th>
			                    </tr>
			                </thead>
			                <tbody >
			                  @foreach($user->invoices as $invoice)
			                    <tr class="text-center">
			                    	<td class="text-center">{{ $invoice->month->format('F, Y') }}</td>
			                    	<td class="text-center">{{ $invoice->invoice_no }}</td>
			                    	<td class="text-center">
			                    	    <i class="fa fa-inr" aria-hidden="true"></i> 
			                    	     {{ $invoice->payment_amount }}
			                    	</td>
			                    	<td class="text-center">{{ $invoice->payment_method }}</td>
			                    	<td class="text-center">
			                    	 @if($invoice->payment_date)
			                    	  {{ $invoice->payment_date->format('d/m/Y') }}
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
			                    	    <a href="/auth/bill/pay-online" class="btn btn-primary btn-sm text-center">
			                    	        <i class="fa fa-credit-card-alt" aria-hidden="true"></i>
			                    	    </a>
			                    	</td>
			                    	<td class="text-center">
			                    		<a class="btn btn-primary btn-xs" href="/auth/bill/{{$invoice->uuid}}/{{strtotime($invoice->month)}}/invoice">
			                    		    <i class="fa fa-eye" aria-hidden="true"></i>
			                    		</a>
			                    		<a class="btn btn-success btn-xs" href="/auth/bill/{{$invoice->uuid}}/{{strtotime($invoice->month)}}/invoice/download">
			                    			<i class="fa fa-download" aria-hidden="true"></i>
			                    		</a>
			                    		<a class="btn btn-warning btn-xs" href="/auth/bill/{{$invoice->uuid}}/{{strtotime($invoice->month)}}/invoice/print">
			                    			<i class="fa fa-print" aria-hidden="true"></i>
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

@stop    

