@extends('layouts.app')
@section('nav')
@include('staff.staff_nav')
@stop
@section('content')

<div class="row">  
   @include('staff.teachers_staff.profile.profile_detail')   
</div>

<div class="row">
    
    <div class="col-md-3">       
	    <div class="panel panel-default">
	        <div class="panel-heading">
	            <button class="btn btn-primary btn-block">Total Homework</button>
	        </div>
	        <div class="panel-body">
	          <h3 class="text-center">{{ $homeworkcount }}</h3>
	        </div>
	    </div>
	</div> 

	<div class="col-md-9">       
	    <div class="panel panel-default">
	        <div class="panel-heading">
	            <button class="btn btn-primary btn-block">Search Homework</button>
	        </div>
	        <div class="panel-body">

	            <form  method="get" class="form-inline" id="search-formfff">

	                <div class="form-group">
	                  <select  id="course" class="form-control" name="course">
	                    <option value="">---Select Class</option>
	                   @foreach($courses as $key=>$value)
	                    <option value="{{ $key }}">{{ $value }}</option>
	                    @endforeach
	                  </select>
	                </div>

	                <div class="form-group">
	                  <select  id="section" class="form-control" name="section">
	                    <option value="">---Select Section</option>
	                   @foreach($sections as $key=>$value)
	                    <option value="{{ $key }}">{{ $value }}</option>
	                    @endforeach
	                  </select>
	                </div>

	                <div class="form-group">
	                  <select  id="subject" class="form-control" name="subject">
	                    <option value="">---Select Subject</option>
	                   @foreach($subjects as $key=>$value)
	                    <option value="{{ $key }}">{{ $value }}</option>
	                    @endforeach
	                  </select>
	                </div>


	                <div class="form-group">
	                  <select  id="session" class="form-control" name="session">
	                    <option value="">---Select Session</option>
	                   @foreach($asessions as $key=>$value)
	                    <option value="{{ $key }}">{{ $value }}</option>
	                    @endforeach
	                  </select>
	                </div>

	                 <div class="form-group">
	                   <button class="btn btn-primary" type="submit">Submit</button>
	                 </div>

	                 <div class="form-group">
	                   <a  class="btn btn-warning"  href="/teacher/{{$teacher->reg_no}}/homeworks">Refresh</a>
	                 </div>

                </form>
	             
	        </div>
	    </div>
	</div>        

    <div class="col-md-12">       
	    <div class="panel panel-default">
	        <div class="panel-heading">
	            <button class="btn btn-primary btn-block">All Homework</button>
	        </div>
	        <div class="panel-body">

		        <div class="table-responsive text-center">
			        <table class=" table table-bordered  table-hover" id="staff_students">
			            <thead>
			                <tr>
				                <th class="text-center">Submission DateTime</th>
				                <th class="text-center">Given At</th>
				                <th class="text-center">Course</th>
				                <th class="text-center">Section</th>
				                <th class="text-center">Subject</th>
				                <th class="text-center">Session</th>
				                <th class="text-center">View</th>
			                </tr>
			            </thead>
			            <tbody>
			                @foreach($homeworks as $homework)
				                <tr class="text-center">
				                	<td>{{ $homework->submit_at->format('d/m/Y h:i A') }}</td>
				                	<td>{{ $homework->created_at->format('d/m/Y h:i A') }}</td>
				                	<td>{{ $homework->courses['name'] }}</td>
				                	<td>{{ $homework->sections['name'] }}</td>
				                	<td>{{ $homework->subjects['name'] }}</td>
				                	<td>{{ $homework->asessions['name'] }}</td>
				                	<td>
				                	    @include('staff.teachers_staff.profile.homework.homework_show_modal')
		                            </td>
				                </tr>
			                @endforeach
			            </tbody>
			        </table>
		        </div>

		        {{ $homeworks->appends(request()->only(['course','section','subject','session']))->links() }}

	        </div>
	    </div>
	</div>
</div>

@stop	

	    
      