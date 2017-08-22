@extends('layouts.app')
@section('nav')
@include('student.student_nav')
@stop
@section('content')

   <div class="row">
    <button class="btn btn-primary btn-block">
	   <b>Pay Online</b>
     </button>

        <div class="col-md-10 col-md-offset-1">
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
				                   <th class="text-center">More..</th>
				                 </tr>	                         			                              
				             </thead>
				             <tbody class="text-center">
			                  @foreach($bankdetails as $bankdetail)
				             	<tr>
				             		 <td>{{$bankdetail->banknames['name'] }}</td> 
				             		 <td>{{$bankdetail['branch_name'] }}</td>
				             		 <td>{{$bankdetail['bank_acc_name'] }}</td>
				             		 <td>{{$bankdetail['bank_acc'] }}</td>
				             		 <td>{{$bankdetail['bank_ifcs_code'] }}</td>
				             		 <td>@include('student.fee.bank_details_modal')</td> 
				             	</tr>
				              @endforeach	
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
			                   	    <th class="text-center">Description</th>
				                </tr>	                         			                              
				            </thead>
				            <tbody class="text-center">
			                  @foreach($appdetails as $appdetail)
				             	<tr>
				             		<td>{{$appdetail->appnames['name'] }}</td> 
				             		<td>{{$appdetail['app_id'] }}</td>
				             		<td>@include('student.fee.student_qr_modal')</td>
				             		<td>
				             			@if($appdetail['description'])
				                		{{$appdetail['description'] }}
				                		@else
				                		N/A
				                		@endif
				             		</td>
				             	</tr>
				              @endforeach	
				            </tbody>			 
				          </table>          
				        </div>
					</div>   
                  
                   <div class="col-sm-12">
                   	<b style="color: #e13b3b; text-align: justify;">Note:After successfully  online payment you have to confirm with your transaction through DMSZar with your transaction details or you have to visit to school and confirm with the accounts department.</b>
                   <button class="btn btn-warning btn-xs btn-block">
				     <b>Disclaimer</b>
				   </button>
                   <b style="color: #e13b3b; text-align: justify;">After successfully confirm online, please wait for your fee receipt to get updated.</b>
                   </div>
		         </div>

			  </div>
		    </div>
        </div>
   </div>

@stop