<button type="button" class="btn btn-primary btn-sm" data-toggle="modal" data-target="#c{{$invoice->id}}"><i class="fa fa-pencil" aria-hidden="true"></i>
</button>

<!-- Modal -->
<div class="modal fade" id="c{{$invoice->id}}" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title" id="myModalLabel">Invoice Confirmation Detials</h4>
      </div>
      <div class="modal-body">
        
         <form action="/superadmin/{{$invoice->uuid}}/invoice/confirm" method="post" data-parsley-validate ="" >
               {{ csrf_field() }} {{ method_field('PATCH') }}
        
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
                          <th>Payment Mode</th>
                          <td>
                            <select class="form-control" id="payment_method" name="payment_method" required="">
                              <option value="">--Select Mode</option>
                              <option value="SBI">SBI</option>
                              <option value="PAYTM">PAYTM</option>
                              <option value="BHIM">BHIM</option>
                              <option value="BYCASH">BYCASH</option>
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
                          <th>Remarks</th>
                          <td>
                            <textarea class="form-control" name="remarks"  placeholder="Updated" >{{ old('remarks') }}</textarea>
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
      <div class="modal-footer">
      <button type="button" class="btn btn-default" data-dismiss="modal">Close</button> </div>
      </div>
  </div>
</div>
