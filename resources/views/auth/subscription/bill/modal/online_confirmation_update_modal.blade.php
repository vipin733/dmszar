<button type="button" class="btn btn-primary btn-sm" data-toggle="modal" data-target="#c{{$userinvoice->id}}"><i class="fa fa-eye faa-pulse animated" aria-hidden="true"></i>
</button>

<!-- Modal -->
<div class="modal fade" id="c{{$userinvoice->id}}" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title" id="myModalLabel">Update Confirmation of Online Fee Deposit</h4>
      </div>
      <div class="modal-body">
        
        <form action="/auth/bill/online-confirmation/{{$userinvoice->uuid}}/update" method="post" data-parsley-validate ="" >
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
                      <th>Select Due Month</th>
                      <td>
                        <select class="form-control" id="unpaid_month" name="unpaid_month" required="">
                          <option value="{{ $userinvoice['id'] }}">{{ $userinvoice['month']->format('F, Y') }}</option>
                        </select>
                      </td> 
                    </tr>
                    <tr>
                      <th>Select Bank/App</th>
                      <td>
                        <select class="form-control" id="bank_app" name="bank_app" required="">
                          <option value="{{ $userinvoice->billconfirmation['bank_app'] }}">{{$userinvoice->billconfirmation['bank_app']}}</option>
                          <option value="SBI">SBI</option>
                          <option value="PAYTM">PAYTM</option>
                          <option value="BHIM">BHIM</option>
                        </select>
                      </td> 
                    </tr> 
                    <tr>
                      <th>Payment Date</th>
                      <td>
                        <input class="form-control" name="payment_date" id="date_pic"  value="{{ old('payment_date',$userinvoice->billconfirmation['payment_date']->format('d/m/Y')) }}"  required="" data-date-format="dd/mm/yyyy">
                      </td> 
                    </tr>
                    <tr>
                      <th>Payment Amount</th>
                      <td>
                      <input class="form-control" name="payment_amount"  value="{{ old('payment_amount',$userinvoice->billconfirmation['payment_amount']) }}" placeholder="5000" required="">
                      </td> 
                    </tr>
                    <tr>
                      <th>Transaction No</th>
                      <td>
                        <input class="form-control" name="transaction_no" value="{{ old('transaction_no',$userinvoice->billconfirmation['transaction_no']) }}" placeholder="BSI00444" required="">
                      </td> 
                    </tr>
                    <tr>
                      <th>Remarks</th>
                      <td>
                        <textarea class="form-control" name="remarks" value="" placeholder="My trnascation BHIM Id is dmszar@upi">{{ old('remarks',$userinvoice->billconfirmation['remarks']) }}</textarea>
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
          <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
      </div>
    </div>
  </div>
</div>

