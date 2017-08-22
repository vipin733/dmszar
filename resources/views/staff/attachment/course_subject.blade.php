@extends('layouts.app')
@section('nav')
@include('staff.staff_nav')
@stop
@section('content')
@include('partial.errors')

<div class="row">
  @if(count($subjects))
  @if(count($courses))

    <div class="col-md-8">
      <div class="panel panel-default">
        <div class="panel-heading">
           <button class="btn btn-primary btn-block">Class Subject</button>
        </div>
        <div class="panel-body">
          <div class="table-responsive">
            <table class=" table table-bordered  table-hover">
              <thead>           
                 <tr>
                    <th class="text-center">Class</th>              
                    <th colspan="{{ count($subjects)  }}">
                     <div class="text-center">
                       Subject
                     </div>                    
                    </th>
                 </tr>
              </thead>
                  @if($coursesss)
                  @foreach($coursesss as $course)
             <tbody>
               <tr>             
                  <td class="text-center">{{ $course->name }}</td>
                   @foreach($course->subjects as $subject)
                 <td>{{ $subject['name'] }} </td>
                   @endforeach
                  </tr>  
             </tbody>                                                             
              @endforeach
              @endif            
            </table>          
          </div>
        </div>
      </div>    
    </div>

  	<div class="col-md-4">
      <div class="panel panel-default">
        <div class="panel-heading">
           <button class="btn btn-primary btn-block">Class Subject Attachment Form</button>
        </div>
        <div class="panel-body">
      		<form method="post" action="/staff/course_subject/attach" data-parsley-validate ="">
            {{ csrf_field() }}

            <div class="form-group">
              <label for="fees">Select Class</label>
              <select class="form-control" id="course" name="course" required="">
                <option value="">--Select Class</option>
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
              <label for="subject_id">Select Subject</label>
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

            <button type="submit" class="btn btn-primary btn-lg btn-block">Attach</button>
          </form>
  	    </div>
      </div>
    </div>

  @else
  <h1 class="text-center">No Subject found, <a href="/acadmic/courses/create">please add some classes first</a></h1> 
  @endif   

  @else
  <h1 class="text-center">No Subject found, <a href="/acadmic/sections/create">please add some subject first</a></h1> 
  @endif 
      
</div>
   
@stop

@section('script')
  <script src="https://cdnjs.cloudflare.com/ajax/libs/parsley.js/2.7.0/parsley.min.js" type="text/javascript"></script>
@stop