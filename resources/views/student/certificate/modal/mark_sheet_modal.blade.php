<div class="modal fade" tabindex="-1" role="dialog" id="log_view" aria-labelledby="gridSystemModalLabel">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title" id="gridSystemModalLabel">Ticket History({{ $marksheetrequest['ticket_no'] }})</h4>
      </div>
      <div class="modal-body">


        <div class="row">
            <div class="col-md-12">
        	 <button class="btn btn-primary btn-block btn-xs">Description</button>          
			   <div class="list-group">
				  <a href="#" class="list-group-item">
				    <p class="list-group-item-text">
				    	{{$marksheetrequest['description']}}
				    </p>
				  </a>
				</div> 
	        </div>

        	<div class="col-md-12">
        	 <button class="btn btn-primary btn-block btn-xs">Request History</button>          
			    <div class="table-responsive">
			          <table class="table table-bordered  table-hover">
			             <thead  class="">          
			                 <tr class="">
			                   <th class="text-center">Reply</th>
			                   <th class="text-center">Updated Date</th>
			                   <th class="text-center">Updated By</th>			                  
			                 </tr>		                         			                              
			             </thead>

			             <tbody class="text-center">
			             	 <tr>
			             	 	<td>
			             	 	@if($marksheetrequest['remarks'])
			             	 	{{ $marksheetrequest['remarks'] }}
			             	 	@else
			             	 	N/A
			             	 	@endif
			             	 	</td>
			             	 	<td>
			             	 	  @if($marksheetrequest->created_at == $marksheetrequest->updated_at)
			             	 	   N/A
			             	 	   @else
			             	 	   {{ $marksheetrequest['updated_at']->format('d/m/Y h:i A') }}
			             	 	   @endif
			             	 	</td>
			             	 	<td>
			             	 	 @if($marksheetrequest->updated_by_id)
			             	 	 {{ $marksheetrequest->updated_by['name'] }}({{$marksheetrequest->updated_by['reg_no'] }})
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