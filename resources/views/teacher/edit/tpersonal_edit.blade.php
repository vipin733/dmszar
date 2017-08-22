      <div class="form-group">
        <label for="father_name">Father's Name</label>
        <input type="text" class="form-control" id="father_name" name="father_name" placeholder="ex-Name" value="{{ old('father_name',$teacher->father_name) }}" required="">
      </div>

      <div class="form-group">
        <label for="mother_name">Mother's Name</label>
        <input type="text" class="form-control" id="mother_name" name="mother_name" value="{{ old('mother_name',$teacher->mother_name) }}" placeholder="ex-Name" required="">
      </div>
      
      <div class="form-group">
        <label for="date_of_birth">Date Of Birth (DD/MM/YYYY):</label>
        <input class="form-control" id="date_pic" name="date_of_birth" value="{{ old('date_of_birth',$teacher->date_of_birth->format('d/m/Y')) }}" placeholder="ex-02/11/2000" required="">
      </div>
 
      <div class="form-group">
          <label for="gender">Gender</label>
          <select class="form-control" id="gender" name="gender" required="
          ">
         @if($teacher->gender == 1)
            <option value="1">Male</option>
            <option value="2">Female</option>
            <option value="3">Other</option>
          @elseif($teacher->gender == 2)
             <option value="2">Female</option>
             <option value="1">Male</option>
             <option value="3">Other</option>
          @else
             <option value="3">Other</option>
             <option value="1">Male</option>
             <option value="2">Female</option>
          @endif
          </select>
      </div>

      <div class="form-group">
        <label for="email">Email Id</label>
        <input type="email" class="form-control" id="email" name="email" required="" value="{{ old('email',$teacher->email) }}" placeholder="Example@example.com" data-parsley-type="email">
      </div>

      <div class="form-group">
        <label for="emergency_no">Emergency Mob. No.</label>
        <input type="text" class="form-control" id="emergency_no" name="emergency_no" value="{{ old('emergency_no',$teacher->emergency_no) }}"  placeholder="+919999999999" required="" data-parsley-pattern="[0-9]{10}">
      </div>
      
      <div class="form-group">
        <label for="date_of_joining">Date Of Joining</label>
        <input type="text" class="form-control" id="date_pic" name="date_of_joining" value="{{ old('date_of_joining',$teacher->date_of_joining->format('d/m/Y')) }}" placeholder="ex 22/12/2015" required="">
      </div>
