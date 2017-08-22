<button type="button" class="btn btn-primary" data-toggle="modal" data-target="#c{{$user->id}}"> Update
</button>

<!-- Modal -->
<div class="modal fade" id="c{{$user->id}}" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title" id="myModalLabel">Update Confirmation of Online Fee Deposit</h4>
      </div>
      <div class="modal-body">
        
        <form class="form-horizontal" role="form" method="POST" action="{{ url('/auth/profile/personal/update') }}" data-parsley-validate ="">
                        {{ csrf_field() }} {{ method_field('PATCH') }}

              
                    <div class="form-group{{ $errors->has('name') ? ' has-error' : '' }}">
                        <label for="name" class="col-md-4 control-label">Name</label>

                        <div class="col-md-6">
                            <input id="name" type="text" class="form-control" name="name" value="{{ old('name',$user->name) }}" required="">

                            @if ($errors->has('name'))
                                <span class="help-block">
                                    <strong>{{ $errors->first('name') }}</strong>
                                </span>
                            @endif
                        </div>
                    </div>


                    <div class="form-group{{ $errors->has('email') ? ' has-error' : '' }}">
                        <label for="email" class="col-md-4 control-label">E-Mail Address</label>

                        <div class="col-md-6">
                            <input id="email" type="email" class="form-control" name="email" value="{{ old('email',$user->email) }}"  required="">

                            @if ($errors->has('email'))
                                <span class="help-block">
                                    <strong>{{ $errors->first('email') }}</strong>
                                </span>
                            @endif
                        </div>
                    </div>

                    <div class="form-group{{ $errors->has('mobile_no') ? ' has-error' : '' }}">
                        <label for="mobile_no" class="col-md-4 control-label">Mobile No.</label>

                        <div class="col-md-6">
                            <input id="mobile_no" type="text" class="form-control" name="mobile_no" value="{{ old('mobile_no',$user->mobile_no) }}"  required="">

                            @if ($errors->has('mobile_no'))
                                <span class="help-block">
                                    <strong>{{ $errors->first('mobile_no') }}</strong>
                                </span>
                            @endif
                        </div>
                    </div>


                    <div class="form-group">
                        <div class="col-md-6 col-md-offset-3">
                            <button type="submit" class="btn btn-primary btn-block">
                                Submit
                            </button>
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

