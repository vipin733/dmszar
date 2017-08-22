<button type="button" class="btn btn-warning btn-sm" data-toggle="modal" data-target="#update{{$appdetail->id}}"><i class="fa fa-pencil-square-o" aria-hidden="true"></i>
</button>

<!-- Modal -->
<div class="modal fade" id="update{{$appdetail->id}}" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title" id="myModalLabel">QR CODE</h4>
      </div>
      <div class="modal-body">
        <div class="row">
         <div class="col-md-10 col-md-offset-1">
            <form action="/auth/app_details/{{$appdetail->id}}/{{strtotime($appdetail->created_at)}}/update" method="post" data-parsley-validate ="" enctype="multipart/form-data">
             {{ csrf_field() }} {{ method_field('PATCH') }}
              <div class="form-group">
                <label class="control-label" for="app_name">Select App Name</label>
                <select class="form-control" id="app_name" name="app_name" required="">
                <option value="{{$appdetail->appnames['id'] }}">{{$appdetail->appnames['name'] }}</option>
                 @foreach($appnames as $key=>$value)
                 @if (Input::old('app_name') == $key)
                 <option value="{{ $key }}" selected>{{ $value }}</option>
                 @else
                 <option value="{{ $key }}">{{ $value }}</option>
                 @endif
                 @endforeach
               </select>
              </div>
              <div class="form-group">
                <label class="control-label" for="app_id">App ID</label>
                <input type="text" class="form-control" value="{{ old('app_id',$appdetail['app_id']) }}" name="app_id" id="app_id" required="">
              </div>
              <div class="form-group">
                <label class="control-label" for="qr_code">QR Code</label>
                <input type="file" name="qr_code" id="qr_code">
              </div>
              <div class="form-group">
                <label class="control-label" for="description">Description(Optional)</label>
                <textarea type="text" class="form-control" name="description" id="description">{{ old('description',$appdetail['description']) }}</textarea>
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
