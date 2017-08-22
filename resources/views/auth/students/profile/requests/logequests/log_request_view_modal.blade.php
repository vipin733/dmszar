<a class="btn btn-primary btn-xs" href="" data-toggle="modal" data-target="#l{{$logrequest->id}}"><i class="fa fa-eye faa-pulse animated" aria-hidden="true"></i>
                               </a>
<div class="modal fade" tabindex="-1" role="dialog" id="l{{$logrequest->id}}" aria-labelledby="gridSystemModalLabel">
  <div class="modal-dialog modal-lg" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title" id="gridSystemModalLabel">Ticket History({{ $logrequest['ticket_no'] }})</h4>
      </div>
      <div class="modal-body">


        <div class="row">
            <div class="col-md-12">
        	 <button class="btn btn-primary btn-block btn-xs">Description</button>          
			   <div class="list-group">
				  <a href="#" class="list-group-item">
				    <p class="list-group-item-text">
				    	{{$logrequest['description']}}
				    </p>
				  </a>
				</div> 
	        </div>

        	<div class="col-md-12">
        	 <button class="btn btn-primary btn-block btn-xs">Message History</button>          
			    <div class="table-responsive">
			          <table class="table table-bordered  table-hover">
			             <thead  class="">          
			                 <tr class="">
			                   <th class="text-center">Remarks</th>
			                   <th class="text-center">Updated Date</th>
			                   <th class="text-center">Updated By</th>			                  
			                 </tr>		                         			                              
			             </thead>

			             <tbody class="text-center">
			             	 <tr>

			             	 	<td>
				             	 	@if($logrequest['remarks'])
				             	 	{{$logrequest['remarks']  }}
				             	 	@else
				             	 	N/A
				             	 	@endif
			             	 	</td>
			             	 	<td>
			             	 		@if($logrequest['created_at'] == $logrequest['updated_at'])
			             	 		N/A
			             	 		@else
			             	 		 {{ $logrequest['updated_at']->format('d/m/Y h:i A') }}
			             	 		@endif
			             	 	</td>
			             	 	<td>
			             	 	  @if($logrequest['action_taker_id'])
			             	 	   {{ $logrequest->action_taker['name']}}({{ $logrequest->action_taker['reg_no']  }})
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