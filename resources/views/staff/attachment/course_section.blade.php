@extends('layouts.app')
@section('nav')
@include('staff.staff_nav')
@stop
@section('content')

<div class="row">
  @include('partial.errors')
 	<div class="col-md-4">
 	    <div class="panel panel-default">
              <div class="panel-heading"><button class="btn btn-primary btn-block">Course Section Attachment Form</button></div>
                <div class="panel-body">
			  		<form method="post" action="/staff/course_section/attach" data-parsley-validate ="">
			      {{ csrf_field() }}
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
			        <label for="section">Select Section :</label>
			        <select class="form-control" id="section" name="section" required="">
			          <option value="">--Select Section</option>
			          @foreach($sections as $key=>$value)
			           @if (Input::old('section') == $key)
			           <option value="{{ $key }}" selected>{{ $value }}</option>
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
              <div class="panel-heading"><button class="btn btn-primary btn-block">Course Section</button></div>
                <div class="panel-body">
                    <div class="table-responsive text-center">
                        <table class="table table-bordered  table-hover">
                           <thead>
                            <tr>
                                <th class="col-sm-2 text-center">Serial No.</th>
                            	<th class="col-sm-2 text-center">Course</th>
                            	<th  class="text-center" colspan="{{  count($sections) }}">Section</th>
                            </tr>
                            </thead> 
                            <?php $i = 0 ?>
                            @foreach($coursess as $course)
                            <?php $i++ ?>
				             <tbody class="text-center">
				               <tr> 
				                    <td class="col-sm-2">{{ $i }}</td>            
				                    <td class="col-sm-2">{{ $course->name }}</td>
				                     @foreach($course->sections as $section)
				                     <td>{{ $section['name'] }} </td>
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
@endsection