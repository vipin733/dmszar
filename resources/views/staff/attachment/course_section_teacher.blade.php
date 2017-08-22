@extends('layouts.app')
@section('nav')
@include('staff.staff_nav')
@stop
@section('content')

<div class="row">

@include('partial.errors')
 	<div class="col-md-4">
 	    <div class="panel panel-default">
              <div class="panel-heading"><button class="btn btn-primary btn-block">Teacher Academic Form({{ $asession['name'] }}) </button></div>
                <div class="panel-body">
			  		<form method="post" action="/staff/course_section_teacher/attach" data-parsley-validate ="">
			      {{ csrf_field() }}
			      
			     <div class="form-group">
			        <label for="teacher">Select Teacher:</label>
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
              <label for="course">Select Course:</label>
              <select class="form-control" id="course" name="course" required="">
                <option value="">--Select Course</option>
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
                </select>
            </div>

			     <button type="submit" class="btn btn-primary btn-lg btn-block">Attach</button>
			    </form>
			</div>
		</div>	    
  	</div>

  	<div class="col-md-8">
  		<div class="panel panel-default">
              <div class="panel-heading"><button class="btn btn-primary btn-block">Teacher Acadmic Details({{ $asession['name'] }})</button></div>
                <div class="panel-body">
                    <div class="table-responsive text-center">
                        <table class="table table-bordered  table-hover" data-form="deleteForm">
                           <thead>
                            <tr>

                               <th class="text-center">Serial No.</th>
                            	<th class="text-center">Class Teacher Name</th>
                                <th class="text-center">Class Teacher Reg. No.</th>
                            	<th class="text-center">Course</th>
                            	<th  class="text-center">Section</th>
                            	<th class="text-center">Action</th>
                            	
                            </tr>
                            </thead> 
                            <tbody class="text-center">
                            <?php $i = 0 ?>
                             @foreach($teacheracadmics as $teacheracadmic)
                             <?php $i++ ?>
                            	<tr>
                            	<td>{{ $i }}</td>
                            	<td>{{ $teacheracadmic->teachers['name'] }}</td>
                                <td>{{ $teacheracadmic->teachers['reg_no'] }} </td>
                                <td>{{ $teacheracadmic->courses['name'] }} </td>
                            	<td>{{ $teacheracadmic->sections['name'] }}</td>
                            	<td>
                            	  <a href="/staff/course_section_teacher/attach/{{$teacheracadmic->id}}/{{$teacheracadmic->teachers['uuid']}}/{{ $teacheracadmic->teachers['reg_no']}}/edit"
                            	  class="btn btn-primary btn-sm">
                            	  Edit
                            	 </a>

                              {{ Form::model($teacheracadmic, ['method' => 'delete', 'route' => ['course_section_teacher_delete',$teacheracadmic->id,$teacheracadmic->teachers['uuid'],$teacheracadmic->teachers['reg_no']], 'class' =>'form-inline form-delete','style'=>'display: inline;']) }}
                              {{Form::hidden('id', $teacheracadmic->id)}}
                              {{Form::hidden('uuid', $teacheracadmic->teachers['uuid'])}}
                              {{Form::hidden('reg_no', $teacheracadmic->teachers['reg_no'])}}
                              <button type="submit" name="delete_modal" class="btn btn-danger btn-sm"><i class="fa fa-trash-o" aria-hidden="true"></i>
                              </button>
                             {{Form::close()}}

                            @include('staff.add.destroy_modal')
                            	 </td>
                            	</tr>
                             @endforeach	
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