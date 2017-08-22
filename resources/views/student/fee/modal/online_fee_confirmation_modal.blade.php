<div class="modal fade" tabindex="-1" role="dialog" id="{{$feeconfirmation['id']}}" aria-labelledby="gridSystemModalLabel">
  <div class="modal-dialog modal-lg" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title" id="gridSystemModalLabel">Ticket History({{ $feeconfirmation['ticket_no'] }})</h4>
      </div>
      <div class="modal-body">


        <div class="row">
            <div class="col-md-12">
        	 <button class="btn btn-primary btn-block btn-xs">Fee Details</button>          
			   <div class="table-responsive">
			          <table class="table table-bordered  table-hover">
			             <thead >
			                <tr>
			                   <th class="text-center">Tuition Fee</th>
			                   @if(!Auth::user()->owner->schoolprofile['transport_service'] == 0)
			                   <th class="text-center">Transport Fee</th>
			                   @endif
			                    @if(!Auth::user()->owner->schoolprofile['hostel_service'] == 0)
			                   <th class="text-center">Hostel Fee</th>
			                    @endif
			                    <th class="text-center">Registration Fee</th>
			                   <th class="text-center">Late Fee</th>
			                   <th class="text-center">Other Fee</th>
			                   <th class="text-center">Total</th>			                  
			                 </tr>	
			             </thead>
			             <tbody>
			             	<tr>
			             		<td>
			             		  <i class="fa fa-inr" aria-hidden="true"></i> 
			             		  @if($feeconfirmation['tution_fee']) 
			             		  {{ $feeconfirmation['tution_fee'] }}
			             		  @else
			             		   0
			             		   @endif
			             		</td>

			             		@if(!Auth::user()->owner->schoolprofile['transport_service'] == 0)
			             		<td>
			             		  <i class="fa fa-inr" aria-hidden="true"></i>
			             		  @if($feeconfirmation['transport_fee']) 
			             		  {{ $feeconfirmation['transport_fee'] }}
			             		  @else
			             		   0
			             		   @endif
			             		</td>
			             		@endif

			             		 @if(!Auth::user()->owner->schoolprofile['hostel_service'] == 0)
			             		<td>
			             		<i class="fa fa-inr" aria-hidden="true"></i> 
			             		  @if($feeconfirmation['hostel_fee']) 
			             		  {{ $feeconfirmation['hostel_fee']}}
			             		  @else
			             		   0
			             		   @endif
			             		</td>
			             		@endif

			             		<td>
			             		<i class="fa fa-inr" aria-hidden="true"></i> 
			             		  @if($feeconfirmation['registration_fee']) 
			             		  {{ $feeconfirmation['registration_fee']}}
			             		  @else
			             		   0
			             		   @endif
			             		</td>
			             		<td><i class="fa fa-inr" aria-hidden="true"></i> 
			             		  @if($feeconfirmation['late_fee']) 
			             		  {{ $feeconfirmation['late_fee']}}
			             		  @else
			             		   0
			             		   @endif
			             		</td>
			             		<td><i class="fa fa-inr" aria-hidden="true"></i> 
			             		  @if($feeconfirmation['other_fee']) 
			             		  {{ $feeconfirmation['other_fee']}}
			             		  @else
			             		   0
			             		   @endif 
			             		</td>
			             		<td><i class="fa fa-inr" aria-hidden="true"></i>   
			             		 {{ $feeconfirmation['tution_fee'] + $feeconfirmation['hostel_fee'] + $feeconfirmation['transport_fee'] + $feeconfirmation['registration_fee'] + $feeconfirmation['late_fee'] + $feeconfirmation['other_fee'] 
			             		  }}
			             		</td>
			             	</tr>
			             </tbody>
			           </table>
			   </div>            
	        </div>

        	<div class="col-md-12">
        	 <button class="btn btn-primary btn-block btn-xs">Request History</button>          
			    <div class="table-responsive">
			          <table class="table table-bordered  table-hover">
			             <thead  class="">          
			                 <tr class="">
			                   <th class="text-center">Deposit Date</th>
			                   <th class="text-center">
			                    @if($feeconfirmation->bank_name_id)
			                    Bank Name
			                    @else
			                    Wallet/App Name
			                    @endif
			                   </th>
			                   <th class="text-center">Transaction no.</th>
			                   <th class="text-center">Remarks</th>
			                  <th class="text-center">Status</th>
			                  <th class="text-center">Reply</th>	                  
			                 </tr>		                         			                              
			             </thead>
                          
			             <tbody>
			             	<tr class="text-center">
			             		<td>{{ $feeconfirmation['deposit_date']->format('d/m/Y') }}</td>
			             		<td>
			             		 @if($feeconfirmation->bank_name_id)
			             		  {{ $feeconfirmation->banknames['name'] }}
			             		  @else
			             		   {{ $feeconfirmation->appnames['name'] }}
			             		  @endif 
			             		</td>
			             		<td>{{ $feeconfirmation['transaction_no'] }}</td>
			             		<td>
			             		 @if($feeconfirmation['remarks'])
			             		  {{ $feeconfirmation['remarks'] }}
			             		 @else
			             		 N/A
			             		 @endif 
			             		</td>
			             		<td>
			             			@if($feeconfirmation->status == 1)
			             		 	Close
			             		 	@else
			             		 	Open
			             		 	@endif
			             		</td>
			             		<td>
			             		 @if($feeconfirmation['reply'])
			             		  {{ $feeconfirmation['reply'] }}
			             		 @else
			             		 N/A
			             		 @endif
			             		</td>
			             	</tr>
			             </tbody>
			           </table>          
			    </div>
	        </div>
        </div>
        
        
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
      </div>
    </div><!-- /.modal-content -->
  </div><!-- /.modal-dialog -->
</div>