
<div class="form-group">
	<select class="form-control" id="{{$subject_nameid}}" name="{{$subject_nameid}}" required="">
		<option value="">--Select Subject</option>
		@foreach($subjects as $key=>$value)
		@if (Input::old('{{$subject_nameid}}') == $key)
		<option value="{{ $key }}" selected>{{ $value }}</option>
		@else
		<option value="{{ $key }}">{{ $value }}</option>
		@endif
		@endforeach
	</select>
</div>

<div class="form-group">
          
	<select name="{{$teacher_nameid}}" id="{{$teacher_nameid}}" class="form-control" required="">
	    <option value="">--Select Teacher</option>
	</select>
</div>

<div class="form-group">
     
     <textarea  placeholder="if any" name="{{$remarks_nameid}}" id="{{$remarks_nameid}}" class="form-control">{{old('$remarks_nameid')}}</textarea>      
	
</div>
