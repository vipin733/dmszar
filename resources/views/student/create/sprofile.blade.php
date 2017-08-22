      
      <div class="form-group">
        <label for="name">Student Name</label>
        <input type="text" class="form-control" id="name" value="{{ old('name') }}" name="name" placeholder="Name" required="">
      </div>

      <div class="form-group">
        <label for="course">Admission Class</label>
        <select class="form-control" id="created_course" name="created_course" required="">
            <option value="">---Select Class</option>
           @foreach($courses as $key=>$value)
             @if (Input::old('created_course') == $key)
             <option value="{{ $key }}" selected>{{ $value }}</option>
             @else
            <option value="{{ $key }}">{{ $value }}</option>
            @endif
            @endforeach
        </select>
      </div>

      <div class="form-group">
        <label for="course">Current Class</label>
        <select class="form-control" id="course" name="course" required="">
           <option value="">---Select Class</option>
         @foreach($courses as $key=>$value)
           @if (Input::old('course') == $key)
           <option value="{{ $key }}" selected>{{ $value }}</option>
           @else
          <option value="{{ $key }}">{{ $value }}</option>
          @endif
          @endforeach
        </select>
      </div>

      <div class="form-group">
        <label for="course">Admission Session</label>
        <select class="form-control" id="asession" name="asession" required="">
           <option value="">---Select Session</option>
         @foreach($asessions as $key=>$value)
           @if (Input::old('asession') == $key)
           <option value="{{ $key }}" selected>{{ $value }}</option>
           @else
          <option value="{{ $key }}">{{ $value }}</option>
          @endif
          @endforeach
        </select>
      </div>

      

      <div class="form-group">
        <label for="active">Status</label>
           <select name="active" class="form-control" required="">
             <option value="1">Active</option>
            <option value="0">De-active</option>
            </select>
      </div>

        <div class="form-group">
            <label for="date_of_admission">Date Of Admission(dd/mm/yyyy)</label>
            <input type="text" class="form-control" id="date_pic" name="date_of_admission" placeholder="ex-22/06/2015" value="{{old('date_of_admission',Carbon\Carbon::today()->format('d/m/Y'))}}" required="">
        </div>

        <div class="form-group">
            <label for="last_school">Last School(if any)</label>
            <input type="text" class="form-control" id="last_school" name="last_school" placeholder="ex-SS public School" value="{{old('last_school')}}">
        </div>
      
      @if(!$user->schoolprofile['hostel_service'] == 0)
        <div class="form-group">
         <label for="hostel">Hostel Service</label>
         <select class="form-control" id="hostel" name="hostel" required="">
          <option value="0">No</option>
          <option value="1">Yes</option>
         </select>
        </div>

        <div class="form-group {{ $errors->has('hostel_type') ? ' has-error' : '' }}" id="hostel_type">
        <label for="hostel_type">Hostel Type</label>
        <select class="form-control" id="hostel_type" name="hostel_type">
         <option value="">---Select Hostel Type</option>
           @foreach($hostels as $key=>$value)
           @if (Input::old('hostel_type') == $key)
           <option value="{{ $key }}" selected>{{ $value }}</option>
           @else
          <option value="{{ $key }}">{{ $value }}</option>
          @endif
          @endforeach
        </select>
         @if ($errors->has('hostel_type'))
            <span class="help-block">
                  <strong>{{ $errors->first('hostel_type') }}</strong>
              </span>
        @endif
      </div>
      @else
      <div class="form-group" style="display: none;">
         <select class="form-control" id="hostel" name="hostel" required="">
          <option value="0">No</option>
         </select>
        </div>
     @endif

      
      @if(!$user->schoolprofile['transport_service'] == 0)
        <div class="form-group">
         <label for="transportation">Transportation Service</label>
         <select class="form-control" id="transportation" name="transportation" required="">
          <option value="0">No</option>
          <option value="1">Yes</option>
         </select>
        </div>

        <div class="form-group {{ $errors->has('stopeages') ? ' has-error' : '' }}" id="stopeages">
        <label for="stopeages">Stoppage</label>
        <select class="form-control" id="stopeages" name="stopeages">
         <option value="">---Select Stoppage</option>
           @foreach($stopages as $key=>$value)
           @if (Input::old('stopeages') == $key)
           <option value="{{ $key }}" selected>{{ $value }}</option>
           @else
          <option value="{{ $key }}">{{ $value }}</option>
          @endif
          @endforeach
        </select>
         @if ($errors->has('stopeages'))
            <span class="help-block">
                  <strong>{{ $errors->first('stopeages') }}</strong>
              </span>
        @endif
      </div>
      @else

      <div class="form-group" style="display: none;">
         <select class="form-control" id="transportation" name="transportation" required="">
          <option value="0">No</option>
         </select>
        </div>

    @endif  
