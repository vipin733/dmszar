@extends('layouts.app')
@section('nav')
@include('staff.staff_nav')
@stop
@section('content')

	<div class="row">
	 @include('partial.errors')

	    <div class="col-md-5">
	        <div class="panel panel-default">
                <div class="panel-heading">
                    <button class="btn btn-primary btn-block">Event Making Form</button>
                </div>
                <div class="panel-body">
			      	<form action="/staff/events/make" method="POST"  data-parsley-validate ="">
			        {{ csrf_field() }}

                        <div class="form-group">
			      	        <label for="title">Event Title</label>
			      	    	<input type="text" name="title" required="" class="form-control" value="{{old('title')}}">
			      	    </div>

			      	    <div class="form-group">
			      	        <label for="event_body">Event Details(if any)</label>
			      	    	<textarea name="event_body" rows="5" class="form-control">{{ Input::old('event_body') }}</textarea>
			      	    </div>

			      	    <div class="form-group">
  				            <label for="event_type">is Event Full Day?</label>
  				            <select name="event_type" id="event_type" class="form-control" required="">
		                        <option value="">--Select</option>
		                        <option value="0">No</option>
		                        <option value="1">Yes</option>   
	  				        </select>
				        </div>

			      	    <div class="input-group bootstrap-timepicker timepicker form-group" id="">
	                        <span class="input-group-addon">Start At</span>
	                        <input type="text" class="input-sm form-control" id="start" name="start" required="" value="{{old('start')}}">
	                        <span class="input-group-addon">End At</span>
	                        <input type="text" class="input-sm form-control" id="end" name="end" required="" value="{{old('end')}}">
                        </div>

			      	    <button type="submit" class="btn btn-primary btn-block">Save</button>

			      	</form>
			    </div>
			</div>
		</div>

		<div class="col-md-7">
			<div class="panel panel-default">
		        <div class="panel-heading"><button class="btn btn-primary btn-block">Events</button></div>
		        <div class="panel-body">
		            <div class="text-center"  id="sandbox-container">
			            <form method="get" id="search-form" class="form-inline" role="form">
			              <div class="input-daterange form-group input-group" id="datepicker">
			                <span class="input-group-addon">From</span>
			                <input type="text" class="input-sm form-control" id="from" name="from">
			                <span class="input-group-addon">to</span>
			                <input type="text" class="input-sm form-control" id="to" name="to">
			              </div>

			              <button type="submit" class="form-control btn btn-primary"><i class="fa fa-eye faa-pulse animated" aria-hidden="true"></i> Search</button>
			              <a class="btn btn-warning" href="/staff/events/make">Refresh</a>		          
			            </form>
		            </div>

		            <div class="table-responsive col-sm-12">
		              <br>
			            <table class=" table table-bordered  table-hover" id="userstable">
				            <thead>
				              <tr>
				                <th class=" text-center">Created At</th>
				                <th class=" text-center">Created By</th>
				                <th class=" text-center">Start At</th>
				                <th class=" text-center">View</th>
				              </tr>
				            </thead>
				            <tbody class="text-center">
				              @foreach($userevents as $event)
				                <tr>
				                 	<td>{{  $event->created_at->format('d/m/Y') }}</td>
				                 	<td>{{  $event->creater->name }}</td>
				                 	<td>{{  $event->start->format('d/m/Y h:i A') }}</td>
				                 	<td>@include('staff.notification_message.event.event_view_modal')</td>
				                </tr>
				              @endforeach
				            </tbody>
			            </table>
		            </div>
		            {{$userevents->links()}}
		        </div>
		    </div>		   
		</div>

    </div>

@stop


@section('script')
<script src="https://cdnjs.cloudflare.com/ajax/libs/parsley.js/2.7.0/parsley.min.js" type="text/javascript"></script>
<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.18.1/moment.min.js"></script>
 <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datetimepicker/4.17.47/js/bootstrap-datetimepicker.min.js"></script>
 
 <script type="text/javascript">


     $(function () {
        $('#start').datetimepicker({
           format: 'DD/MM/YYYY LT'
        });
    });

      $(function () {
        $('#end').datetimepicker({
           format: 'DD/MM/YYYY LT'
        });
    });

    $(function () {
        $('#from').datetimepicker({
           format: 'DD/MM/YYYY'
        });
    });

      $(function () {
        $('#to').datetimepicker({
           format: 'DD/MM/YYYY'
        });
    });  

</script>

@endsection