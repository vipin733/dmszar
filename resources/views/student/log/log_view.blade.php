@extends('layouts.app')
@section('nav')
@include('student.student_nav')
@stop
@section('content')

<div class="row">

          <div class="panel-heading">
			  <button class="btn btn-primary btn-block">
			  <b>My Log Request Summary</b>
			  </button>
		  </div>
          
	    </div><br>

          <div class="col-md-3">
          	<div class="panel panel-default">
          	   <div class="panel-heading">
			    <button class="btn btn-primary btn-xs btn-block">
			     <b>Summary</b>
			   </button>
		       </div>
			  <div class="panel-body">
			    <div class="table-responsive">
			          <table class=" table table-bordered  table-hover">
			             <thead >          
			                 <tr>
			                  <th>Total Request</th>
			                  <td>{{count($logrequests)}}</td> 
			                 </tr> 	
			                 <tr>
			                  <th>Pending Request</th>
			                  <td>{{ $pendinglog }}</td>
			                 </tr>
			                 <tr>
			                  <th>Completed Request</th>
			                  <td>{{ $completedlog }}</td> 
			                 </tr>	                         			                              
			             </thead>			 
			          </table>          
			    </div>
			  </div>
		    </div>
          </div>

          <div class="col-md-9">
          	<div class="panel panel-default">
          	    <div class="panel-heading">
	          	   <button class="btn btn-primary btn-xs btn-block">
				     <b>Log Request Details</b>
				   </button>
				</div>   
			  <div class="panel-body">
			    <div class="table-responsive">
			          <table class=" table table-bordered  table-hover">
			             <thead  class="">          
			                 <tr class="">
			                   <th class="text-center">TicketNo</th>
			                   <th class="text-center">Category</th>
			                   <th class="text-center">Subject</th>
			                   <th class="text-center">SendDate</th>
			                   <th class="text-center">Status</th>
			                   <th class="text-center">View</th>
			                 </tr>		                         			                              
			             </thead>

			             <tbody class="text-center">
			                @foreach($logrequests as $logrequest)
			             	 <tr>
			             	 	<td>{{ $logrequest['ticket_no'] }}</td>
			             	 	<td>{{ $logrequest->logrequestcategories['name'] }}</td>
			             	 	<td>{{ $logrequest['subject'] }}</td>
			             	 	<td>{{ $logrequest['created_at']->format('d/m/Y') }}</td>
			             	 	<td>
			             	 		@if($logrequest->status == 1)
			             	 		Close
			             	 		@else
			             	 		Open
			             	 		@endif
			             	 	</td>
			             	 	<td>
			             	 	 <a class="btn btn-primary btn-xs" href="" data-toggle="modal" data-target="#l{{$logrequest->id}}">
			             	 	 <i class="fa fa-eye faa-pulse animated" aria-hidden="true"></i>
			             	 	 </a>
			             	 	 @include('student.log.modal.log_modal')
			             	 	</td>			             	 	
			             	 </tr>
			             	 @endforeach
			             </tbody>
			           </table>          
			    </div>
			  </div>
			  {{ $logrequests->links() }}
		    </div>
          </div>
      
</div>

@endsection