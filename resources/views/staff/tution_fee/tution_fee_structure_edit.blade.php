@extends('layouts.app')
@section('nav')
@include('staff.staff_nav')
@stop
@section('content')

 <div class="row">
     @include('partial.errors')
    <div class="col-md-4 col-md-offset-4">
	  <div class="panel panel-default">
        <div class="panel-heading"><button class="btn btn-primary btn-block">Tuition Fee Form({{  $tutionfee->asessions['name']}})</button>
        </div>
        <div class="panel-body">
		    <form method="post" action="/acadmic/tution_fee/{{$tutionfee->id}}/{{strtotime($tutionfee->created_at)}}/edit" data-parsley-validate ="" >
		      {{ csrf_field() }} {{ method_field('PATCH') }}
		      <div class="form-group">
		        <select class="form-control" id="course" name="course" required="">
		          <option value="{{ $tutionfee->course_id }}">{{$tutionfee->courses['name']}}</option>
		      </select>
		        </div>

		        <div class="form-group">
		          <label for="tution_fee">Fee (Monthly) :</label>
		          <input type="text" class="form-control" id="tution_fee" name="tution_fee" value="{{ old('tution_fee', $tutionfee->tution_fee) }}" placeholder="Fee" required="" data-parsley-type="number">
		        </div>

		        <div class="form-group">
		          <label for="late_fee">Late Fee :</label>
		          <input type="text" class="form-control" id="late_fee" name="late_fee" value="{{ old('late_fee',$tutionfee->late_fee) }}" placeholder="Late Fee" data-parsley-type="number">
		        </div>

		        <div class="form-group">
		          <label for="other_fee">Other Fee :</label>
		          <input type="text" class="form-control" id="other_fee" name="other_fee" value="{{ old('other_fee',$tutionfee->other_fee) }}" placeholder="Other Fee" data-parsley-type="number">
		        </div>

		        <div class="form-group">
		         <label for="remarks">Description :</label>
		         <textarea class="form-control" rows="3" name="remarks" value="{{ old('remarks',$tutionfee->remarks) }}"></textarea>
		        </div>

		        <div class="form-group">
		          <button type="submit" class="btn btn-primary btn-lg btn-block"><i class="fa fa-plus faa-flash animated" aria-hidden="true"></i> Update Course Fee</button>
		          <a class="btn btn-warning btn-lg btn-block" href="/acadmic/add/tution_fee"><i class="fa fa-backward faa-passing-reverse animated" aria-hidden="true"></i> Back</a>
		        </div>
		    </form>
		</div>
	   </div>
    </div>
 </div>

@stop

@section('script')

 <script src="https://cdnjs.cloudflare.com/ajax/libs/parsley.js/2.7.0/parsley.min.js" type="text/javascript"></script>


@stop
