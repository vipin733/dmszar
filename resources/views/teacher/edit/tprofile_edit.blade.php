      <div class="form-group">
        <label for="name">Name</label>
        <input type="text" class="form-control" id="name" name="name" placeholder="Name" value="{{ old('name',$teacher->name) }}" required="">
      </div>

      <div class="form-group">
          <label for="active">Status</label>
          <select class="form-control" id="active" name="active" required="">
          @if($teacher->isActive())
             <option value="1">Active</option>
            <option value="0">De-active</option>
            @else
            <option value="0">De-active</option>
            <option value="1">Active</option>
            @endif
          </select>
      </div>

      <div class="form-group">
        <label for="mob_no">Mob. No.</label>
        <input type="text" class="form-control" id="mob_no" name="mob_no" value="{{ old('mob_no',
        $teacher->mob_no) }}" placeholder="+919999999999" data-parsley-pattern="[0-9]{10}" required="">
      </div>

      

      <div class="form-group">
        <label for="last_school">Last school(if any)</label>
        <input type="text" class="form-control" id="last_school" name="last_school" value="{{ old('last_school',$teacher->last_school) }}" placeholder="ex-SS public School">
      </div>

      <div class="form-group">
        <label for="experience">Experience(if any)</label>
        <input type="text" class="form-control" id="experience" name="experience" value="{{ old('experience',$teacher->experience) }}" placeholder="ex- 5 year">
      </div>

      <div class="form-group">
         <label for="transportation">Transportation Service</label>
         <select class="form-control" id="transportation" name="transportation" required="">
          @if($teacher->TransportationTaken())
             <option value="1">Yes</option>
            <option value="0">No</option>
            @else
            <option value="0">No</option>
            <option value="1">Yes</option>
            @endif
         </select>
        </div>

        <div class="form-group {{ $errors->has('stopeages') ? ' has-error' : '' }}" id="stopeages">
        <label for="stopeages">Stoppage</label>
        <select class="form-control" id="stopeages" name="stopeages">
         @if($teacher->TransportationTaken())
         <option value="{{ $teacher['stopage_id'] }}">{{ $teacher->stopages['name'] }}</option>
         @else
         <option value="">-- Select Stoppage</option>
         @endif
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

      
