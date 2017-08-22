@extends('layouts.app')
@section('nav')
@include('staff.staff_nav')
@stop
@section('content')

<div class="row">

 	@include('partial.errors')
 	<div class="col-md-4 col-md-offset-4">
 	    <div class="panel panel-default">
              <div class="panel-heading"><button class="btn btn-primary btn-block">Teacher Academic Form </button></div>
                <div class="panel-body">
			  		<form method="post" action="/staff/course_section_teacher/attach/{{$teacheracadmic->id}}/{{$teacheracadmic->teachers['uuid']}}/{{ $teacheracadmic->teachers['reg_no']}}/post" data-parsley-validate ="">
			      {{ csrf_field() }}  {{ method_field('PATCH') }}
			      
			     <div class="form-group">
			        <label for="teacher">Select Teacher:</label>
			        <select class="form-control" id="teacher" name="teacher" required="">
			          <option value="{{ $teacheracadmic->teacher_id }}">{{ $teacheracadmic->teachers->name }}</option>
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
              <label for="course">Select Course:</label>
              <select class="form-control" id="course" name="course" required="">
                <option value="{{ $teacheracadmic->course_id }}">{{ $teacheracadmic->courses->name }}</option>
                @foreach($coursess as $key=>$value)
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
                <option value="{{ $teacheracadmic->section_id }}">{{ $teacheracadmic->sections->name }}</option>
                </select>
            </div>

			     <button type="submit" class="btn btn-primary btn-lg btn-block">Attach</button>
			    </form>
			</div>
		</div>	    
  	</div>

  	
</div>

@stop


@section('script')
<script src="https://cdnjs.cloudflare.com/ajax/libs/parsley.js/2.7.0/parsley.min.js" type="text/javascript"></script>

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