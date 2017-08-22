@extends('layouts.app')
@section('nav')
@include('teacher.teacher_nav')
@stop
@section('content')

<div class="row">

  <div class="col-md-6 col-md-offset-3">
    <div class="panel panel-default">
      <div class="panel-heading"><button class="btn btn-primary btn-block">Send message</button></div>
      <div class="panel-body">
    	  <form action="/send_message/post" method="POST"  data-parsley-validate ="">
            {{ csrf_field() }}

          <div class="form-group">
           	<label for="send_to">Send To</label>
    	    	<select class="form-control" name="send_to" id="send_to" required="">
    			   <option value="">--Select To</option>
    			   <option value="1">Class</option>
    			   <option value="0">Section</option>
    		    </select>
          </div>

    	    <div class="form-group" id="course">
    	      <label for="course">Select Class</label>
    	    	<select class="form-control" name="course" >
    			    <option value="">--Select Class</option>
    			     @foreach($courses as $course)
	             @if (Input::old('course') == $course->courses['id'])
	              <option value="{{ $course->courses['id'] }}" selected>{{ $course->courses['name'] }}</option>
	             @else
	              <option value="{{ $course->courses['id'] }}">{{ $course->courses['name'] }}</option>
	             @endif
	            @endforeach
    		    </select>
    	    </div>

    	    <div class="form-group" id="section">
            <label for="section">Select Section:</label>
            <select name="section" class="form-control">
              <option>--Select section</option>
            </select>
          </div>

    	    <div class="form-group">
    	       <label for="message">Message</label>
    	    	 <textarea name="message" required="" rows="5" class="form-control" data-parsley-maxlength="160">{{ Input::old('message') }}</textarea>
             <p class="push-right">Max Length 160</p>
    	    </div>

	        <button type="submit" class="btn btn-primary btn-block">Send</button>
    		
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
                    url: '/teacher/course/'+ courseID,
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

<script type="text/javascript">
     $('#send_to').on('change',function(){
    if( $(this).val()==="1"){
    $("#course").show()
    $("#section").hide()
    }
    else{
    $("#course").show()
    $("#section").show()
    }
});
 
   </script>

   <script type="text/javascript">
     
    if( $('#send_to').val()===""){
    $("#course").show()
     $("#section").hide()
    };

 
   </script>

@endsection