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
		     Online Fee Confirmation Requests
		     </button>
		</div>
        <div class="panel-body">        
 	        <div class="table-responsive">
                <table class=" table table-bordered  table-hover" id="userstable">
                    <thead>
		              <tr>
		                <th class="text-center">Serial No.</th>
		                <th class="text-center">Course</th>
		                <th class="col-sm-1 text-center">Date</th>
		                <th class="text-center">Ticket No</th>
		                <th class="col-sm-2 text-center">Transaction no.</th>
		                <th class="col-sm-1  text-center">Bank</th>
		                <th class="col-sm-1 text-center">Total</th>
		                <th class="col-sm-1 text-center">Status</th>
		                <th class="col-sm-1 text-center">Action</th>
		              </tr>
		            </thead>
		            <tbody class="text-center">
		            <?php $i = 0 ?>
		            @foreach($feeconfirmations as $feeconfirmation)
		            <?php $i++ ?>
		            	<tr>
		            		<td>{{ $i }}</td>
			                <td>{{ $feeconfirmation->courses['name'] }}</td>
			                <td class="col-sm-1">{{ $feeconfirmation['created_at']->format('d/m/Y') }}</td>
			                <td> {{ $feeconfirmation['ticket_no'] }}</td>
			                <td class="col-sm-2"> {{ $feeconfirmation['transaction_no'] }}</td>
			                <td class="col-sm-1">SBI/NEFT</td>
			                <td class="col-sm-1"> <i class="fa fa-inr" aria-hidden="true"></i>  {{ $feeconfirmation['tution_fee'] + $feeconfirmation['hostel_fee'] + $feeconfirmation['transport_fee'] + $feeconfirmation['development_fee'] + $feeconfirmation['late_fee'] + $feeconfirmation['other_fee'] 
		                        }}
		                    </td>
		                  <td>
		                    @if($feeconfirmation->status == 1)
		                        Close
		                        @else
		                        Open
		                    @endif
		                  </td>
			                <td class="col-sm-1">
			                 <a class="btn btn-primary btn-xs" href="/staff/students/confirmation_request/{{$feeconfirmation['ticket_no']}}/{{$feeconfirmation['id']}}/{{strtotime($feeconfirmation->created_at)}}/view">
		                      <i class="fa fa-eye faa-pulse animated" aria-hidden="true"></i>
		                    </a>
		                  </td>
		            	</tr>
		               @endforeach  
		            </tbody>
                </table>
            </div>
        </div>
    </div> 
   {{ $feeconfirmations->links() }}
 </div>
   
</div>
@endsection
