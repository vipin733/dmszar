
  <div class="col-sm-5">
      <div class="form-group">
        <label for="permanent_address">Permanent Address</label>
        <textarea class="form-control" id="permanent_address" name="permanent_address"  placeholder="Address" required="">{{ Input::old('permanent_address') }}</textarea>
      </div>


       <div class="form-group">
          <label for="permanent_state">Select State</label>
          <select class="form-control" id="state" name="permanent_state" required="">
          <option value="">---Select State</option>
           @foreach($states as $key=>$value)
           @if (Input::old('permanent_state') == $key)
           <option value="{{ $key }}" selected>{{ $value }}</option>
           @else
          <option value="{{ $key }}">{{ $value }}</option>
          @endif
          @endforeach
        </select>
       </div>


      <div class="form-group">
           <label for="permanent_district">Select District</label>
           <select class="form-control" id="district" name="permanent_district" required="">
           <option value="">---Select District</option>
         </select>
      </div>

        <div class="form-group">
            <label for="permanent_zip_pin">Pin/Zip.</label>
            <input type="text" class="form-control" id="permanent_zip_pin" name="permanent_zip_pin" value="{{ old('permanent_zip_pin') }}" placeholder="ex-221204" required="" data-parsley-pattern="[0-9]{6}">
        </div>
  </div>

  <div class="col-sm-2">

  </div>


  <div class="col-sm-5">

          <div class="form-group">
            <label for="communication_address">Communication Address</label>
            <textarea  class="form-control" id="communication_address" name="communication_address"  placeholder="Address" required="">{{ Input::old('communication_address') }}</textarea>
          </div>


     <div class="form-group">
        <label for="communication_state">Select State</label>
        <select class="form-control" id="cstate" name="communication_state" required="">
          <option value="">---Select State</option>
         @foreach($states as $key=>$value)
           @if (Input::old('communication_state') == $key)
           <option value="{{ $key }}" selected>{{ $value }}</option>
           @else
          <option value="{{ $key }}">{{ $value }}</option>
          @endif
          @endforeach
        </select>
     </div>

     <div class="form-group">
      <label for="communication_district">Select District</label>
        <select class="form-control" id="cdistrict" name="communication_district" required="">
          <option value="">---Select District</option>
        </select>
     </div>

        <div class="form-group">
            <label for="communication_zip_pin">Pin/Zip.</label>
            <input type="text" class="form-control" name="communication_zip_pin" id="communication_zip_pin" value="{{ old('communication_zip_pin') }}" placeholder="ex-221204" required="" data-parsley-pattern="[0-9]{6}" >
        </div>
  </div>

 
