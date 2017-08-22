@extends('layouts.app')
@section('nav')
@include('staff.staff_nav')
@stop
@section('content')

 <div class="row">
  @include('partial.errors')
 	<div class="col-md-3">
 	    <div class="panel panel-default">
              <div class="panel-heading"><button class="btn btn-primary btn-block">Course, Section, Subject Teacher Assigning Form</button></div>
                <div class="panel-body">
			  		<form method="post" action="/staff/teacher_teaching_courses_sections_subject/attach" data-parsley-validate ="">
			      {{ csrf_field() }}
			      
			     <div class="form-group">
			        <label for="teacher">Select Teacher :</label>
			        <select class="form-control" id="teacher" name="teacher" required="">
			          <option value="">--Select Teacher</option>
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
                <option value="">--Select Subject</option>
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
                <option value="">--Select Course</option>
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
                </select>
            </div>

			     <button type="submit" class="btn btn-primary btn-lg btn-block">Attach</button>
			    </form>
			</div>
		</div>	    
  	</div>

  	<div class="col-md-9">
  		<div class="panel panel-default">
              <div class="panel-heading"><button class="btn btn-primary btn-block">Teacher Teaching Classes</button></div>
                <div class="panel-body">
                    <div class="table-responsive text-center">
                        <table class="table table-bordered  table-hover" data-form="deleteForm">
                           <thead>
                            <tr>
                              <th class="text-center">Serial No.</th>
                            	<th class="text-center">Teacher Name</th>
                              <th class="text-center">Class Teacher Reg. No.</th>
                            	<th class="text-center">Teaching Subject</th>
                              <th class="text-center">Teaching Classe</th>
                              <th class="text-center">Teaching Section</th>
                              <th class="text-center col-sm-2 ">Action</th>                             	
                            </tr>
                            </thead> 
                            <tbody class="text-center">
                            <?php $i = 0 ?>
                            @if($teacherteachingacadmics)
                             @foreach($teacherteachingacadmics as $teacherteachingacadmic)
                             <?php $i++ ?>
                            	<tr>
                            		<td>{{ $i }}</td>
                            		<td>{{ $teacherteachingacadmic->teachers['name'] }}</td>
                                <td>{{ $teacherteachingacadmic->teachers['reg_no'] }}</td>
                                <td>{{ $teacherteachingacadmic->subjects['name'] }}</td>
                            		<td>{{ $teacherteachingacadmic->courses['name'] }}</td>
                                <td>{{ $teacherteachingacadmic->sections['name'] }}</td>
                                <td class="col-sm-2">
                                  <a href="/staff/teacher_teaching_courses_sections_subject/{{$teacherteachingacadmic->id}}/{{$teacherteachingacadmic->teachers['uuid']}}/{{$teacherteachingacadmic->teachers['reg_no']}}/edit"
                                  class="btn btn-primary btn-xs">
                                  Edit
                                 </a>

                                {{ Form::model($teacherteachingacadmic, ['method' => 'delete', 'route' => ['course_section_teacher_subject_delete',$teacherteachingacadmic->id,$teacherteachingacadmic->teachers['uuid'],$teacherteachingacadmic->teachers['reg_no']], 'class' =>'form-inline form-delete','style'=>'display: inline;']) }}
                                {{Form::hidden('id', $teacherteachingacadmic->id)}}
                                {{Form::hidden('uuid', $teacherteachingacadmic->teachers['uuid'])}}
                                {{Form::hidden('reg_no', $teacherteachingacadmic->teachers['reg_no'])}}
                                <button type="submit" name="delete_modal" class="btn btn-danger btn-xs"><i class="fa fa-trash-o" aria-hidden="true"></i>
                                </button>
                               {{Form::close()}}

                                @include('staff.add.destroy_modal')
                                </td>
                            	</tr>
                             @endforeach
                             @endif	
                            </tbody>                 
                        </table>
                      </div>
                </div>
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