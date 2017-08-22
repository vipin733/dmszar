@extends('layouts.app')
@section('nav')
@include('layouts.nav')
@stop
@section('content')

    <div class="row">
        <div class="col-md-12">
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
			              <a class="btn btn-warning" href="/auth/events/view">Refresh</a>
			              <a class="btn btn-success" href="/auth/events/view/calender">Calender</a>		          
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
				                <th class=" text-center">End At</th>
				                <th class=" text-center">Event Name</th>
				                <th class=" text-center">View</th>
				              </tr>
				            </thead>
				            <tbody class="text-center">
				              @foreach($userevents as $event)
				                <tr>
				                 	<td>{{  $event->created_at->format('d/m/Y') }}</td>
				                 	<td>{{  $event->creater->name }}</td>
				                 	<td>{{  $event->start->format('d/m/Y h:i A') }}</td>
				                 	<td>{{  $event->end->format('d/m/Y h:i A') }}</td>
				                 	<td>{{  $event->title }}</td>
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
<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.18.1/moment.min.js"></script>
 <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datetimepicker/4.17.47/js/bootstrap-datetimepicker.min.js"></script>
 
 <script type="text/javascript">

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