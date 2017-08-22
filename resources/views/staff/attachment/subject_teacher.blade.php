@extends('layouts.app')
@section('nav')
@include('staff.staff_nav')
@stop
@section('content')

<div class="row">
  @include('partial.errors')
 	<div class="col-md-4">
 	    <div class="panel panel-default">
              <div class="panel-heading"><button class="btn btn-primary btn-block">Subject Teacher Attachment Form</button></div>
                <div class="panel-body">
			  		<form method="post" action="/staff/acadmic/teacher_teaching_subject/attach" data-parsley-validate ="">
			      {{ csrf_field() }}
			      <div class="form-group">
			        <label for="subject">Select Subject</label>
			        <select class="form-control" id="subject" name="subject" required="">
			          <option value="">--Select Subject</option>
			          @foreach($subjects as $key => $value)
			           @if (Input::old('subject') == $key)
			           <option value="{{ $key }}" selected>{{ $value }}</option>
			           @else
			          <option value="{{ $key }}">{{ $value }}</option>
			          @endif
			          @endforeach
			      </select>
			     </div>
			     <div class="form-group">
			        <label for="teacher">Select Teacher</label>
			        <select class="form-control" id="teacher" name="teacher" required="">
			          <option value="">--Select Teacher</option>
			          @foreach($teachers as $key => $value)
			           @if (Input::old('teacher') == $key)
			           <option value="{{$key}}" selected>{{ $value }}</option>
			           @else
			          <option value="{{ $key }}">{{ $value }}</option>
			          @endif
			          @endforeach
			      </select>
			     </div>
			     <button type="submit" class="btn btn-primary btn-lg btn-block">Attach</button>
			    </form>
			</div>
		</div>	    
  	</div>

  		<div class="col-md-8">
  		<div class="panel panel-default">
              <div class="panel-heading"><button class="btn btn-primary btn-block">Teacher Subject</button></div>
                <div class="panel-body">
                    <div class="table-responsive text-center">
                        <table class="table table-bordered  table-hover" data-form="deleteForm">
                           <thead>
                            <tr>
                                <th class="col-sm-1 text-center">Serial No.</th>
                            	<th class="col-sm-3 text-center">Teacher</th>
                            	<th  class="text-center" colspan="{{  count($subjects) }}">Subject</th>
                            </tr>
                            </thead> 
                            <?php $i = 0 ?>
                            @foreach($teacherssubject as $teacher)
                            <?php $i++ ?>
				             <tbody class="text-center">
				               <tr> 
				                    <td class="col-sm-1">{{ $i }}</td>            
				                    <td class="col-sm-3">{{ $teacher->name }}</td>
				                     @foreach($teacher->subjects as $subject)
				                     <td>
				                       <b>{{ $subject['name'] }}</b> 
				                        @include('staff.attachment.partial.delete_subject_teacher_modal')
				                     </td>
				                     @endforeach
				                    </tr>  
				             </tbody>                                                             
				             @endforeach                   
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
@endsection