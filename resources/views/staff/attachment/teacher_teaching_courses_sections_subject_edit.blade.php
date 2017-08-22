@extends('layouts.app')
@section('nav')
@include('staff.staff_nav')
@stop
@section('content')

 <div class="row">
  @include('partial.errors')
 	<div class="col-md-6 col-md-offset-3">
 	    <div class="panel panel-default">
              <div class="panel-heading"><button class="btn btn-primary btn-block">Course, Section, Subject Teacher Assigning Edit Form</button></div>
                <div class="panel-body">
			  		<form method="post" action="/staff/teacher_teaching_courses_sections_subject/{{$teacherteachingacadmic->id}}/{{$teacherteachingacadmic->teachers['uuid']}}/{{$teacherteachingacadmic->teachers['reg_no']}}/update" data-parsley-validate ="">
			      {{ csrf_field() }} {{ method_field('PATCH') }}
			      
			     <div class="form-group">
			        <label for="teacher">Select Teacher :</label>
			        <select class="form-control" id="teacher" name="teacher" required="">
			            <option value="{{ $teacherteachingacadmic->teacher_id }}">{{ $teacherteachingacadmic->teachers['name'] }}</option>
			          @foreach($teachers as $teacher)
			           @if (Input::old('teacher') == $teacher['id'])
			           <option value="{{ $teacher['id'] }}" selected>{{ $teacher['name'] }}</option>
			           @else
			          <option value="{{ $teacher['id'] }}">{{ $teacher['name'] }}</option>
			          @endif
			          @endforeach
			      </select>
			     </div>

           <div class="form-group">
              <label for="subject">Select Subject :</label>
              <select class="form-control" id="subject" name="subject" required="">
                <option value="{{ $teacherteachingacadmic->subject_id }}">{{ $teacherteachingacadmic->subjects['name'] }}</option>
                @foreach($subjects as $key=>$value)
                 @if (Input::old('subject') == $key)
                 <option value="{{ $key }}" selected>{{ $value }}</option>
                 @else
                <option value="{{ $key }}">{{ $value }}</option>
                @endif
                @endforeach
            </select>
           </div>

           <div class="form-group">
              <label for="course">Select Course :</label>
              <select class="form-control" id="course" name="course" required="">
                <option value="{{ $teacherteachingacadmic->course_id }}">{{ $teacherteachingacadmic->courses['name'] }}</option>
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
                <label for="section">Select Section:</label>
               
                <select name="section" class="form-control" required="">
                 <option value="{{ $teacherteachingacadmic->section_id }}">{{ $teacherteachingacadmic->sections['name'] }}</option>
                </select>
            </div>

			     <button type="submit" class="btn btn-primary btn-lg btn-block">Attach</button>
			    </form>
			</div>
		</div>	    
  </div>

@stop

@section('script')
<script src="https://cdnjs.cloudflare.com/ajax/libs/parsley.js/2.7.0/parsley.min.js" type="text/javascript"></script>
@include('staff.add.destroy_modal_javascript')
<script type="text/javascript">
    $(document).ready(function() {
        $('select[name="course"]').on('change', function() {
            var courseID = $(this).val();
            if(courseID) {
                $.ajax({
                    url: '/staff/course_section_teacher/'+courseID,
                    type: "GET",
                    dataType: "json",
                    success:function(data) {

                        
                        $('select[name="section"]').empty();
                        $.each(data, function(key, value) {
                            $('select[name="section"]').append('<option value="'+ key +'">'+ value +'</option>');
                        });

                    }
                });
            }else{
                $('select[name="section"]').empty();
            }
        });
    });
</script>
@endsection  