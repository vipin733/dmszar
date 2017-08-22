<button type="button" class="btn btn-warning btn-sm" data-toggle="modal" data-target="#update{{$bankdetail->id}}"><i class="fa fa-pencil-square-o" aria-hidden="true"></i>
</button>

<!-- Modal -->
<div class="modal fade" id="update{{$bankdetail->id}}" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title" id="myModalLabel">Bank Details Edit Form</h4>
      </div>
      <div class="modal-body">
        <div class="row">
         <div class="col-md-10 col-md-offset-1">
            <form action="/auth/bank_details/{{$bankdetail->id}}/{{strtotime($bankdetail->created_at)}}/update" method="post" data-parsley-validate ="">
             {{ csrf_field() }} {{ method_field('PATCH') }}
              <div class="form-group">
                <label class="control-label" for="bank_name">Select Bank Name</label>
                <select class="form-control" id="bank_name" name="bank_name" required="">
                <option value="{{$bankdetail->banknames['id'] }}">{{$bankdetail->banknames['name'] }}</option>
                 @foreach($banknames as $key=>$value)
                 @if (Input::old('bank_name') == $key)
                 <option value="{{ $key }}" selected>{{ $value }}</option>
                 @else
                 <option value="{{ $key }}">{{ $value }}</option>
                 @endif
                 @endforeach
               </select>
              </div>
              <div class="form-group">
                <label class="control-label" for="branch_name">Bank Branch Name</label>
                <input type="text" class="form-control" value="{{ old('branch_name',$bankdetail->branch_name) }}" placeholder="ex- Baragon" name="branch_name" id="branch_name" required="">
              </div>
              <div class="form-group">
                <label class="control-label" for="bank_address">Bank Address</label>
                <textarea class="form-control"  name="bank_address" id="bank_address" required="">{{ old('bank_address',$bankdetail->bank_address) }}</textarea>
              </div>
              <div class="form-group">
                <label class="control-label" for="bank_acc">Bank Account No.</label>
                <input type="text" class="form-control" placeholder="ex- 99999999999999" value="{{ old('bank_acc',$bankdetail->bank_acc) }}" name="bank_acc" id="bank_acc" required="">
              </div>
              <div class="form-group">
                <label class="control-label" for="bank_acc_name">Bank Account Name</label>
                <input type="text" class="form-control" placeholder="ex- Gramyancha Mahila Vidyalaya" value="{{ old('bank_acc_name',$bankdetail->bank_acc_name) }}" name="bank_acc_name" id="bank_acc_name" required="">
              </div>
              <div class="form-group">
                <label class="control-label" for="bank_ifcs_code">Bank IFCS Code</label>
                <input type="text" class="form-control" placeholder="ex- SBIN00025" value="{{ old('bank_ifcs_code',$bankdetail->bank_ifcs_code) }}" name="bank_ifcs_code" id="bank_ifcs_code" required="">
              </div>
              <div class="form-group">
                <label class="control-label" for="bank_micr_code">Bank MICR Code(Optional)</label>
                <input type="text" class="form-control" value="{{ old('bank_micr_code',$bankdetail->bank_micr_code) }}" name="bank_micr_code" id="bank_micr_code">
              </div>
              <div class="form-group">
                <label class="control-label" for="description">Description(Optional)</label>
                <textarea type="text" class="form-control"  name="description" id="description">{{ old('description',$bankdetail->description) }}</textarea>
              </div>
                <div class="form-group">
                <button type="submit" class="btn btn-primary btn-block">Submit</button>
              </div>
            </form>
          </div>
         </div>
      </div>
      <div class="modal-footer">
      <button type="button" class="btn btn-default" data-dismiss="modal">Close</button> </div>
      </div>
  </div>
</div>
