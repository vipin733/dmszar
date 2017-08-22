@extends('layouts.app')
@section('nav')
@include('layouts.nav')
@stop
@section('content')

  <div class="row">
    <div class="col-md-6 col-md-offset-3">
      <div class="panel panel-default">
        <div class="panel-heading">
           <button class="btn btn-primary btn-block">Send Message</button>
        </div>
        <div class="panel-body">

        	<form action="/auth/send-message" method="POST"  data-parsley-validate ="">
          {{ csrf_field() }}
          
            <div class="form-group">
              <label for="send_to">Send To</label>
        	    <select class="form-control" name="send_to" id="send_to" required="">
        			   <option value="">--Select To</option>
        			   <option value="1">Students</option>
        			   <option value="0">Teachers</option>
        		  </select>
            </div>

        	  <div class="form-group" id="course">
        	    <label for="course">Select Class</label>
        	    <select class="form-control" name="course" >
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
        	    <label for="message">Message</label>
        	    	<textarea name="message" required="" rows="5" class="form-control" maxlength="160">{{ Input::old('message') }}</textarea>
                <p class="push-right">Max Length 160</p>
        	  </div>

        	  <button type="submit" class="btn btn-primary btn-block">Send</button>
        		
        	</form>
        	<p class="student_message" style="color: #e13b3b;"><b>Note:If u not select any course it will send to all students</b></p>
        	<p class="teacher_message" style="color: #e13b3b;"><b>Note:If u  select teachers option it will send to all teachers</b></p>

        </div>
      </div>  
    </div>
  </div>

@stop    

@section('script')
<script src="https://cdnjs.cloudflare.com/ajax/libs/parsley.js/2.7.0/parsley.min.js" type="text/javascript"></script>
 

   <script type="text/javascript">
     $('#send_to').on('change',function(){
    if( $(this).val()==="1"){
    $("#course").show()
    $(".student_message").show()
    $(".teacher_message").hide()
    }
    else{
    $("#course").hide()
     $(".student_message").hide()
    $(".teacher_message").show()
    }
});

 
   </script>

   <script type="text/javascript">
     
    if( $('#send_to').val()==="1"){
    $("#course").show()
    }
    else{
    $("#course").hide()
    $(".student_message").hide()
    $(".teacher_message").hide()
    };

 
   </script>

@endsection