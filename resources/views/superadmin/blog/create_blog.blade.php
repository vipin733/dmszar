@extends('layouts.app')
@section('nav')
@include('superadmin.layouts.superadmin_nav')
@stop
@section('css')
<link href="https://cdnjs.cloudflare.com/ajax/libs/summernote/0.8.4/summernote.css" rel="stylesheet">
@stop
@section('content')

    <div class="row">
          @include('partial.errors')
        <div class="panel panel-default">
            <div class="panel-heading">
              
               <button class="btn btn-primary btn-block">Blog Form</button>
            </div>
            <div class="panel-body">
			    <div class="col-md-10 col-md-offset-1">
				    <form action="/superadmin/blog/store" method="POST" enctype="multipart/form-data" data-parsley-validate ="">
			     	  {{ csrf_field() }}
			     		<div class="form-group">
			     			<label for="title">Title</label>
			     			<input type="text" name="title" class="form-control" required="" value="{{ old('title') }}">			
			     		</div>
			     		<div class="form-group">
			     			<label for="category">Select Category</label>
			     			<select class="form-control" name="category" required="">
			     				<option value="">--select Category</option>
			     				@foreach($blog_categories as $key=>$value)
			                     @if (Input::old('category') == $key)
			                     <option value="{{ $key }}" selected>{{ $value }}</option>
			                     @else
			                     <option value="{{ $key }}">{{ $value }}</option>
			                     @endif
			                    @endforeach
			     			</select>
			     		</div>
			     		<div class="form-group">
			              <input name="blog_image" class="form-control" type="file" />
			             </div>
			     		<div class="form-group">
			     			<label for="body">Body</label>
			     			<textarea name="body" id="body" required="">{{ Input::old('body') }}</textarea>
			     		</div>
			     				     		
			     		{{-- <div id="body">
			     			
			     		</div> --}}
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
    $(document).ready(function () {
            $('#body').summernote({
                height: 500
            });
        });
  </script>      

@endsection




