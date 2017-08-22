@extends('layouts.app')
@section('nav')
@include('staff.staff_nav')
@stop
@section('css')
<link href="https://cdnjs.cloudflare.com/ajax/libs/summernote/0.8.4/summernote.css" rel="stylesheet">
@stop
@section('content')

<div class="row">
    
    <div class="col-md-10 col-md-offset-1">
        <div class="panel panel-default">
            <div class="panel-heading">
                <button class="btn btn-primary btn-block">Notification Edit Form</button>
            </div>
            <div class="panel-body">

             	<form action="/staff/notification/edit_form/{{$notification->id}}" method="POST" data-parsley-validate ="">
             	{{ csrf_field() }} {{ method_field('PATCH') }}
             		<div class="form-group">
             			<label for="title">Title</label>
             			<input type="text" name="title" class="form-control" required="" value="{{ old('title',$notification->title) }}">			
             		</div>
             		<div class="form-group">
             			<label for="category">Select Category</label>
             			<select class="form-control" name="category" required="">
             				<option value="{{ $notification['notification_category_id'] }}">{{ $notification->notifications_categories['name'] }}</option>
                            @foreach($categories as $key=>$value)
                             @if (Input::old('category') == $key)
                             <option value="{{ $key }}" selected>{{ $value }}</option>
                             @else
                            <option value="{{ $key }}">{{ $value }}</option>
                            @endif
                           @endforeach
             			</select>
             		</div>
             		<div class="form-group">
             			<label for="body">Body</label>
             			<textarea name="notification_body" id="notification_body" required="">{{ old('notification_body',$notification->notification_body) }}</textarea>
             		</div>
             		<div class="col-sm-6 col-sm-offset-3">
             			<button type="submit" class="btn btn-primary btn-block btn-lg">Submit</button>
             			<br>
             		</div>
             	</form>

            </div>
        </div>        
     </div>
</div>

@stop    


@section('script')
<script src="https://cdnjs.cloudflare.com/ajax/libs/parsley.js/2.7.0/parsley.min.js" type="text/javascript"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/summernote/0.8.4/summernote.js"></script>  
<script>
    $(document).ready(function() {
        $('#notification_body').summernote();
         height: 500
    });
  </script> 
@endsection
