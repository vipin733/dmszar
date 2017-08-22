@extends('layouts.app')
@section('nav')
@include('layouts.nav')
@stop
@section('content')

    <div class="row">
        <div class="col-md-10 col-md-offset-1">
            <div class="panel panel-primary">
                <div class="panel-heading text-center">Update School Profile</div>
                <div class="panel-body">
                    <form class="form-horizontal" role="form" method="POST" action="{{ url('/auth/school_profile/update') }}" data-parsley-validate ="">
                        {{ csrf_field() }} {{ method_field('PATCH') }}

                        <div class="form-group{{ $errors->has('school_name') ? ' has-error' : '' }}">
                            <label for="school_name" class="col-md-6 control-label">School Name</label>

                            <div class="col-md-6">
                                <input id="school_name" type="text" class="form-control" name="school_name" value="{{ old('school_name',$user->schoolprofile['school_name']) }}"  required="">

                                @if ($errors->has('school_name'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('school_name') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group{{ $errors->has('school_board') ? ' has-error' : '' }}">
                            <label for="school_board" class="col-md-6 control-label">School Name</label>

                            <div class="col-md-6">
                             <select class="form-control" id="school_board" name="school_board" required="">
                                @if($user->schoolprofile['school_board_id'])
                                <option value="{{ $user->schoolprofile['school_board_id']}}">{{ $user->schoolprofile->schoolboards['name'] }}</option>
                                @else
                                  <option value="">---Select School Board</option>
                                @endif
                                   @foreach($school_boards as $key=>$value)
                                   @if (Input::old('school_board') == $key)
                                   <option value="{{ $key }}" selected>{{ $value }}</option>
                                   @else
                                  <option value="{{ $key }}">{{ $value }}</option>
                                  @endif
                                  @endforeach
                              </select>
                                @if ($errors->has('school_board'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('school_board') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                         <div class="form-group{{ $errors->has('affiliation_no') ? ' has-error' : '' }}">
                            <label for="affiliation_no" class="col-md-6 control-label">Affiliation No</label>

                            <div class="col-md-6">
                                  <input id="affiliation_no" type="text" class="form-control" name="affiliation_no" value="{{ old('affiliation_no',$user->schoolprofile['affiliation_no']) }}" >

                                @if ($errors->has('affiliation_no'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('affiliation_no') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group{{ $errors->has('school_code_no') ? ' has-error' : '' }}">
                            <label for="school_code_no" class="col-md-6 control-label">School Code No</label>

                            <div class="col-md-6">
                                  <input id="school_code_no" type="text" class="form-control" name="school_code_no" value="{{ old('school_code_no',$user->schoolprofile['school_code_no']) }}"  >

                                @if ($errors->has('school_code_no'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('school_code_no') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>


                        <div class="form-group{{ $errors->has('website') ? ' has-error' : '' }}">
                            <label for="website" class="col-md-6 control-label">School Website</label>

                            <div class="col-md-6">
                                  <input id="website" type="text" class="form-control" name="website" value="{{ old('website',$user->schoolprofile['website']) }}" >

                                @if ($errors->has('website'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('website') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group{{ $errors->has('school_email') ? ' has-error' : '' }}">
                            <label for="school_email" class="col-md-6 control-label">School Email</label>

                            <div class="col-md-6">
                                  <input id="school_email" type="text" class="form-control" name="school_email" value="{{ old('school_email',$user->schoolprofile['school_email']) }}"  >

                                @if ($errors->has('school_email'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('school_email') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group{{ $errors->has('telephone_no') ? ' has-error' : '' }}">
                            <label for="telephone_no" class="col-md-6 control-label">School Telephone No</label>

                            <div class="col-md-6">
                                  <input id="telephone_no" type="text" class="form-control" name="telephone_no" value="{{ old('telephone_no',$user->schoolprofile['telephone_no']) }}" >

                                @if ($errors->has('telephone_no'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('telephone_no') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group{{ $errors->has('mobile_no') ? ' has-error' : '' }}">
                            <label for="mobile_no" class="col-md-6 control-label">School Mobile No</label>

                            <div class="col-md-6">
                                  <input id="mobile_no" type="text" class="form-control" name="mobile_no" value="{{ old('mobile_no',$user->schoolprofile['mobile_no']) }}"  required="">

                                @if ($errors->has('mobile_no'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('mobile_no') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group{{ $errors->has('school_address') ? ' has-error' : '' }}">
                            <label for="school_address" class="col-md-6 control-label">School Address</label>

                            <div class="col-md-6">
                                <textarea name="school_address" class="form-control" required="" >{{ Input::old('school_address') }}{{ $user->schoolprofile['school_address'] }}</textarea>

                                @if ($errors->has('school_address'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('school_address') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group{{ $errors->has('city') ? ' has-error' : '' }}">
                            <label for="city" class="col-md-6 control-label">city</label>

                            <div class="col-md-6">
                                  <input id="city" type="text" class="form-control" name="city" value="{{ old('city',$user->schoolprofile['city']) }}"  required="">

                                @if ($errors->has('city'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('city') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group{{ $errors->has('state') ? ' has-error' : '' }}">
                            <label for="state" class="col-md-6 control-label">State</label>

                            <div class="col-md-6">
                                <select class="form-control" id="state" name="state" required="">
                                @if($user->schoolprofile['state_id'])
                                <option value="{{ $user->schoolprofile['state_id'] }}">{{ $user->schoolprofile->states['name'] }}</option>
                                @else
						          <option value="">---Select State</option>
                                @endif
						           @foreach($states as $key=>$value)
						           @if (Input::old('state') == $key)
						           <option value="{{ $key }}" selected>{{ $value }}</option>
						           @else
						          <option value="{{ $key }}">{{ $value }}</option>
						          @endif
						          @endforeach
						        </select>

                                @if ($errors->has('state'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('state') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group{{ $errors->has('district') ? ' has-error' : '' }}">
                            <label for="district" class="col-md-6 control-label">District</label>

                            <div class="col-md-6">
                                   <select id="district" name="district" class="form-control">
                                       @if($user->schoolprofile['district_id'])
                                        <option value="{{ $user->schoolprofile['district_id'] }}">{{ $user->schoolprofile->appdistricts['name'] }}</option>
                                        @else
                                          <option value="">---Select District</option>
                                        
                                        @endif
                                   </select>

                                @if ($errors->has('district'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('district') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>
                        
                        <div class="form-group{{ $errors->has('pincode') ? ' has-error' : '' }}">
                            <label for="pincode" class="col-md-6 control-label">Pincode</label>

                            <div class="col-md-6">
                                <input id="pincode" type="text" class="form-control" name="pincode" value="{{ old('pincode',$user->schoolprofile['pincode']) }}"  required="" placeholder="ex-221204" data-parsley-pattern="[0-9]{6}">

                                @if ($errors->has('pincode'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('pincode') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group{{ $errors->has('campuse_type') ? ' has-error' : '' }}">
                            <label for="campuse_type" class="col-md-6 control-label">What is the type of your school?</label>

                            <div class="col-md-6">

                                <select name="campuse_type" id="campuse_type" class="form-control" required="">
                                    @if(count($user->schoolprofile['campuse_type']))
                                        @if($user->schoolprofile['campuse_type'] == 1)
                                            <option value="1">Boys</option>
                                            <option value="2">Girl</option>
                                            <option value="3">Both</option>
                                        @elseif($user->schoolprofile['campuse_type'] == 2)
                                            <option value="2">Girl</option>
                                            <option value="1">Boys</option>
                                            <option value="3">Both</option>
                                        @else
                                            <option value="3">Both</option>
                                            <option value="1">Boys</option>
                                            <option value="2">Girl</option>
                                        @endif
                                     @else
                                        <option value="">--Select</option>
                                        <option value="1">Boys</option>
                                        <option value="2">Girl</option>
                                        <option value="3">Both</option>
                                     @endif   
                                </select>

                                @if ($errors->has('campuse_type'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('campuse_type') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group{{ $errors->has('main_campuse') ? ' has-error' : '' }}">
                            <label for="main_campuse" class="col-md-6 control-label">This is the main campus?</label>

                            <div class="col-md-6">
                                <select name="main_campuse" id="main_campuse" class="form-control" required="">
                                @if(count($user->schoolprofile['main_campuse']))
                                    @if($user->schoolprofile['main_campuse'] == 1)
                                    <option value="1">Yes</option>
                                    <option value="0">No</option>
                                    @else
                                     <option value="0">No</option>
                                     <option value="1">Yes</option>
                                    @endif
                                 @else
                                 <option value="">--Select</option>
                                 <option value="1">Yes</option>
                                 <option value="0">No</option>
                                 @endif   
                                </select>

                                @if ($errors->has('main_campuse'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('main_campuse') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>


                        <div class="form-group{{ $errors->has('hostel_service') ? ' has-error' : '' }}">
                            <label for="hostel_service" class="col-md-6 control-label">Did you provide hostel service?</label>

                            <div class="col-md-6">
                                <select name="hostel_service" id="hostel_service" class="form-control" required="">
                                  @if(count($user->schoolprofile['hostel_service']))
                                    @if($user->schoolprofile['hostel_service'] == 1)
                                    <option value="1">Yes</option>
                                    <option value="0">No</option>
                                    @else
                                     <option value="0">No</option>
                                     <option value="1">Yes</option>
                                    @endif
                                  @else
                                     <option value="">--Select</option>
                                     <option value="1">Yes</option>
                                     <option value="0">No</option>
                                 @endif
                                </select>

                                @if ($errors->has('hostel_service'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('hostel_service') }}</strong>
                                    </span>
                                @endif
                            </div>

                        </div>


                        <div class="form-group{{ $errors->has('hostel_type') ? ' has-error' : '' }}" id="hostel_type">      
                           <label for="transport_service" class="col-md-6 control-label">What is the your hostel type?(This field required if you choose hostel service yes!)</label>                       
                            <div class="col-md-6">
                                <select name="hostel_type" class="form-control">
                                   
                                   @if(count($user->schoolprofile['hostel_type']))
                                        @if($user->schoolprofile['hostel_type'] == 1)
                                            <option value="1">Boys</option>
                                            <option value="2">Girl</option>
                                            <option value="3">Both</option>
                                        @elseif($user->schoolprofile['hostel_type'] == 2)
                                            <option value="2">Girl</option>
                                            <option value="1">Boys</option>
                                            <option value="3">Both</option>
                                        @else
                                            <option value="3">Both</option>
                                            <option value="1">Boys</option>
                                            <option value="2">Girl</option>
                                        @endif
                                     @else
                                        <option value="">--Select</option>
                                        <option value="1">Boys</option>
                                        <option value="2">Girl</option>
                                        <option value="3">Both</option>
                                     @endif 

                                </select>

                                @if ($errors->has('hostel_type'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('hostel_type') }}</strong>
                                    </span>
                                @endif
                            </div>
                            
                        </div>

                        <div class="form-group{{ $errors->has('transport_service') ? ' has-error' : '' }}" id="transport_service">
                            <label for="transport_service" class="col-md-6 control-label">Did you provide transport service?</label>

                            <div class="col-md-6">
                                <select name="transport_service" class="form-control" required="">
                                 @if(count($user->schoolprofile['transport_service']))
                                    @if($user->schoolprofile['transport_service'] == 1)
                                    <option value="1">Yes</option>
                                    <option value="0">No</option>
                                    @else
                                     <option value="0">No</option>
                                     <option value="1">Yes</option>
                                    @endif
                                  @else
                                     <option value="">--Select</option>
                                     <option value="1">Yes</option>
                                     <option value="0">No</option>
                                 @endif 
                                </select>

                                @if ($errors->has('transport_service'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('transport_service') }}</strong>
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
            </div>
        </div>
    </div>

@endsection

@section('script')
<script src="https://cdnjs.cloudflare.com/ajax/libs/parsley.js/2.7.0/parsley.min.js" type="text/javascript"></script>


   <script type="text/javascript">
     $('#hostel_service').on('change',function(){
    if( $(this).val()==="1"){
    $("#hostel_type").show()
    }
    else{
    $("#hostel_type").hide()
    }
});
 
     
    if( $('#hostel_service').val()==="1"){
    $("#hostel_type").show()
    }
    else{
    $("#hostel_type").hide()
    };

 
   </script>

@include('staff_auth.district_state')
@endsection

