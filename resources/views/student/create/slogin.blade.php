
                        <div class="form-group{{ $errors->has('reg_no') ? ' has-error' : '' }}">
                            <label for="reg_no" class="col-md-4 control-label">Reg. No</label>

                            <div class="col-md-6">
                                <input id="reg_no" type="text" class="form-control" name="reg_no" required="true" value="{{$regno}}" readonly>

                                @if ($errors->has('reg_no'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('reg_no') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group{{ $errors->has('password') ? ' has-error' : '' }}">
                            <label for="password" class="col-md-4 control-label">Password</label>

                            <div class="col-md-6">
                                <input id="password" type="text" class="form-control" name="password" value="{{$pass}}" required="true" readonly>

                                @if ($errors->has('password'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('password') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>
