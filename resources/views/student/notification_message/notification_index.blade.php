@extends('layouts.app')
@section('nav')
@include('student.student_nav')
@stop
@section('content')

  <div class="row">

    <div class="col-md-12">
        <div class="panel panel-default">
              <div class="panel-heading">
               <button class="btn btn-primary btn-block">All Notifications.</button>
              </div>
                <div class="panel-body">

	                <div class="col-sm-12 text-center" id="sandbox-container">
                    <form class="form-inline">

                    <div class="input-daterange form-group input-group" id="datepicker">
                        <span class="input-group-addon">From</span>
                        <input type="text" class="input-sm form-control" id="from" name="from">
                        <span class="input-group-addon">to</span>
                        <input type="text" class="input-sm form-control" id="to" name="to">
                     </div>

                    <div class="form-group">
                      <select class="form-control" name="category">
                        <option value="">--select category</option>
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
                        <button class="btn btn-primary">Search</button>
                        <a class="btn btn-warning" href="/student/notification/index">Refresh</a>
                      </div>
                      
                    </form>
                   </div>
                      

	                 <div class="col-sm-12">
	                  @foreach($notifications as $not)
      				        <a href="/student/notification/show/{{$not->id}}/{{$not->slug}}"><h4>{{ $not->title }}</h4></a>
      				        <p class="pull-right">Posted at {{ $not->created_at->format('d/m/Y h:i A') }}</p>
      				        <p>{{ $not->notifications_categories['name'] }}</p>
				       @endforeach
	                 </div>

		        </div>
		</div>
    </div>
     
   </div>

@stop    

@section('script')
<script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.6.4/js/bootstrap-datepicker.min.js"></script>
 <script type="text/javascript">

      $(document).ready(function(){
        $('#sandbox-container .input-daterange').datepicker({
    format: "dd/mm/yyyy",
    forceParse: false,
    autoclose: true
});
           $('#search-form').on('submit', function(e) {
               oTable.draw();
               e.preventDefault();
           });
     
})
</script>   

  @stop 
