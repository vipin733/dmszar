@extends('layouts.app')
@section('nav')
@include('staff.staff_nav')
@stop
@section('content')

<div class="row">

    <div class="col-md-12">
        <div class="panel panel-default">
                <div class="panel-heading">
                      <button class="btn btn-primary btn-block">Student Information</button>
                </div>
                <div class="panel-body">
                      <div class="table-responsive text-center">
                        <table class="table table-bordered  table-hover">
                           <thead>
                            <tr>
                              <th class="text-center">Reg No.</th>
                              <th  class="text-center">Student Name</th>
                              <th  class="text-center">Father Name</th>
                              <th class="text-center">View Profile</th>                          
                             </tr>
                           </thead>
                           <tbody>
                             <tr>
                               <td>{{ $student['reg_no'] }}</td>
                               <td>{{ $student['name'] }}</td>
                               <td>{{ $student['father_name'] }}</td>
                               <td>
                               <a href="/st/student/{{$student['reg_no']}}" class="btn btn-primary">
                               <i class="fa fa-eye faa-pulse animated" aria-hidden="true"></i>
                               </a>
                               </td>
                             </tr>
                           </tbody>
                        </table>
                      </div>
                </div>
        </div>
    </div>

    <div class="col-md-12">
        <div class="panel panel-default">
		    <div class="panel-heading">
		     <button class="btn btn-primary btn-block">
		     Fee Extension/Refund Requests
		     </button>
		     </div>
            <div class="panel-body">        
 	           <div class="table-responsive">
                <table class=" table table-bordered  table-hover" id="userstable">
                    <thead>
		              <tr>
		                <th class="text-center">Serial No.</th>
		                <th class=" text-center">Date</th>
		                <th class="text-center">Ticket No</th>
		                <th class="text-center">Category</th>
		                <th class="  text-center">Status</th>
		                <th class=" text-center">View</th>
		              </tr>
		            </thead>
		            <tbody class="text-center">
		            <?php $i = 0 ?>
		              @foreach($feerequests as $feerequest)
		                <?php $i++ ?>
		                <tr>
		                    <td>{{ $i }}</td>
		                    <td>{{ $feerequest['created_at']->format('d/m/Y') }}</td>
		                    <td>{{ $feerequest['ticket_no'] }}</td>
		                    <td>{{ $feerequest->feerequestcategories['name'] }}</td>
		                    <td>
		                      @if($feerequest->status == 1)
		                         Awaiting
		                         @elseif($feerequest->status == 2)
		                         Approved
		                        @else
		                        Rejected
		                      @endif 
		                    </td>
		                    <td> 
		                    <a class="btn btn-primary btn-xs" href="/staff/fee/extensions/refund/{{$feerequest['ticket_no']}}/{{$feerequest['id']}}/{{strtotime($feerequest->created_at)}}/request_view">
		                     <i class="fa fa-eye" aria-hidden="true"></i>
		                    </a>
		                    </td>
		                </tr>
		              @endforeach  
		            </tbody>
                </table>
            </div>
        </div>
    </div> 
   {{ $feerequests->links() }}
 </div>
   
</div>
@endsection
