@extends('layouts.app')
@section('nav')
@include('student.student_nav')
@stop
@section('content')

<div class="row">
    <div class="col-sm-6 col-sm-offset-3">
     <div class="panel panel-primary">
        <div class="panel-heading">Log Request Form</div>
            <div class="panel-body">
              
                <form action="/student/log_request" method="post" data-parsley-validate ="">
                  {{ csrf_field() }}
			       <div class="form-group">
			            <label for="category">Select Category</label>
			            <select class="form-control" id="category" name="category" required="">
			            <option value="">---Select Category</option>
			           @foreach($logrequestcategories as $key=>$value)
			             @if (Input::old('category') == $key)
			             <option value="{{ $key }}" selected>{{ $value }}</option>
			             @else
			            <option value="{{ $key }}">{{ $value }}</option>
			            @endif
			           @endforeach
			          </select>
			       </div> 

			       <div class="form-group">
			            <label for="subject">Subject</label>
			            <input type="text" class="form-control" id="subject" name="subject" value="{{ old('subject') }}" placeholder="ex-Regarding fees" required="">
			        </div>
			         
			       <div class="form-group">
			        <label for="description">Description</label>
			        <textarea class="form-control" id="description" name="description"  placeholder="ex- My fess not updated">{{ Input::old('description') }}</textarea>
			       </div>
                
	                <div class="col-sm-8 col-sm-offset-2">
	                	<button class="btn btn-success btn-block">Submit</button>
	                </div>
	            </form>    
                              
            </div>
        </div>
    </div>     
</div>

@endsection

@section('script')
<script src="https://cdnjs.cloudflare.com/ajax/libs/parsley.js/2.7.0/parsley.min.js" type="text/javascript"></script>

@stop