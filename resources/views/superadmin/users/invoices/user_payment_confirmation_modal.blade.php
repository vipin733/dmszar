<button type="button" class="btn btn-primary btn-sm" data-toggle="modal" data-target="#{{$invoice->id}}"><i class="fa fa-eye faa-pulse animated" aria-hidden="true"></i>
</button>

<!-- Modal -->
<div class="modal fade" id="{{$invoice->id}}" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title" id="myModalLabel">Invoice Confirmation Detials</h4>
      </div>
      <div class="modal-body">
        
        <div class="table-responsive">
            <table class=" table table-bordered  table-hover" id="users">
              <thead>
                <tr>
                  <th class="text-center">Payment Amount</th>
                  <td>{{ $invoice->billconfirmation['payment_amount'] }}</td>
                </tr>
                <tr>
                  <th class="text-center">Payment Method</th>
                  <td>{{ $invoice->billconfirmation['bank_app'] }}</td>
                </tr> 
                <tr> 
                  <th class="text-center">Payment Date</th>
                  <td>{{ $invoice->billconfirmation['payment_date']->format('d/m/Y') }}</td>
                </tr>
                <tr>    
                  <th class="text-center">Transaction No</th>
                  <td>{{ $invoice->billconfirmation['transaction_no'] }}</td>
                </tr>
                <tr>   
                  <th class="text-center">Remarks</th>
                  <td>{{ $invoice->billconfirmation['remarks'] }}</td>
                </tr>
                </tr>
              </thead>
              <tbody>
               
                  
                  
                  
                  
              </tbody>
            </table>
        </div>
        
      </div>
      <div class="modal-footer">
      <button type="button" class="btn btn-default" data-dismiss="modal">Close</button> </div>
      </div>
  </div>
</div>
