@extends('layouts.app')
@section('nav')
@include('layouts.nav')
@stop
@section('content')

    <div class="row">
        <button class="btn btn-primary btn-block">
			   <b>Pay Online</b>
		</button>

        <div class="col-md-12 ">
          	<div class="panel panel-default">
          	    <div class="panel-heading">
			    <button class="btn btn-primary btn-xs btn-block">
			     <b>Through NEFT/RTGS</b>
			    </button>
		        </div>
			    <div class="panel-body">

                    <div class="col-sm-12">
				        <div class="table-responsive">
				          <table class=" table table-bordered  table-hover">
				             <thead >          
				                 <tr>
				                  <th class="text-center">Bank Name</th>
				                  <th class="text-center">Bank Branch Name</th>
				                  <th class="text-center">Account Name</th>
				                  <th class="text-center">A/C</th>
				                  <th class="text-center">IFSC-Code</th>
				                 </tr>	                         			                              
				             </thead>
				             <tbody class="text-center">
			                  	 <tr>
			                  	 	<td>SBI</td>
			                  	 	<td>Baragaon</td>
			                  	 	<td>Dmszar infotech LLP</td>
			                  	 	<td>111111111111111111</td>
			                  	 	<td>SBIN00025</td>
			                  	 </tr>
				             </tbody>			 
				          </table>          
				        </div>
				    </div>    
	                
	                <div class="col-sm-12"> 
	                    <div class="panel-heading">
					    <button class="btn btn-primary btn-xs btn-block">
					     <b>Through App/Wallet</b>
					    </button>
					    <div class="table-responsive">
				          <table class=" table table-bordered  table-hover">
				            <thead >          
				                <tr>
				                    <th class="text-center">App/Wallet Name</th>
			                   	    <th class="text-center">App/Wallet ID</th>
			                   	    <th class="text-center">QR Code</th>
				                </tr>	                         			                              
				            </thead>
				            <tbody class="text-center">
			                  	<tr>
			                  		<td>BHIM</td>
			                  		<td>dmszar@upi</td>
			                  		<td>@include('auth.subscription.bill.modal.payonline_modal_qr_bhim')</td>
			                  	</tr>
			                  	<tr>
			                  		<td>PAYTM</td>
			                  		<td>760000008</td>
			                  		<td>@include('auth.subscription.bill.modal.payonline_modal_qr_paytm')</td>
			                  	</tr>
				            </tbody>			 
				          </table>          
				        </div>
					</div>

					<div class="col-sm-4 col-sm-offset-4">
						<a class="btn btn-primary btn-block" href="/auth/bill/online-confirmation">Payment Confirmation</a>
					</div>   
                  
                   <div class="col-sm-12">
                   	<b style="color: #e13b3b; text-align: justify;">Note:After successful online payment you have to confirm with your transaction through DMSZar with your transaction details.</b>
                   <button class="btn btn-warning btn-xs btn-block">
				     <b>Disclaimer</b>
				   </button>
                   <b style="color: #e13b3b; text-align: justify;">After successful confirm online, please wait for your invoice receipt to get updated.</b>
                   </div>
		         </div>

			  </div>
		    </div>
        </div>

    </div>


@stop    