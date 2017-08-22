@extends('layouts.app')
@section('nav')
@include('staff.staff_nav')
@stop
@section('content')

<div class="row">

  @include('staff.students.fee.fee_profile_nav.fee_profile_nav')

	<div class="col-sm-12 col-md-12">
	  <div class="panel panel-default">
	    <div class="panel-heading">
	      <button class="btn btn-primary btn-block">Student Last Transport Fee Transactions</button>
	    </div>
	  <div class="panel-body">
      <div class="table-responsive">
		    <table class=" table table-bordered  table-hover" data-form="deleteForm">
            <thead>
              <tr>
                <th class="text-center">Sr. No.</th>
                <th class="text-center">Date</th>
                <th class="text-center">Session</th>
                <th class="text-center">Month</th>
                <th class="text-center">Course</th>
                <th class="text-center">Total</th>
                <th class="text-center">Remarks</th>
                <th class="text-center">Completed</th>
                <th class="text-center">View</th>
                <th class="text-center">Print</th>
                <th class="text-center">Download</th>
                <th class="text-center">Delete</th>
              </tr>
            </thead>
            <tbody class="text-center">
             <?php $i = 0 ?>
             @foreach($transportfees as $transportfee)
             <?php $i++ ?>
              <tr>
                  <td>{{ $i }}</td>
                  <td>{{ $transportfee['created_at']->format('d/m/Y') }}</td>
                  <td>{{ $transportfee['month']->format('F') }}</td>
                  <td>{{ $transportfee->asessions['name'] }}</td>
                  <td>{{ $transportfee->courses['name'] }}</td>
                 
                  <td>
                    <i class="fa fa-inr" aria-hidden="true"></i> 
                     {{$transportfee['transport_fee'] + $transportfee['late_fee'] + $transportfee['other_fee']}}
                  </td>

                 <td>
                   @if($transportfee['remarks']) 
                     {{ $transportfee['remarks'] }}
                     @else
                     Fee Submitted
                    @endif
                 </td>

                 <td>
                      @if($transportfee['completed'] == 0)
                       No
                     @else
                       Yes
                     @endif
                   </td>

                  <td>
                    <a class="btn btn-success btn-xs" href="/staff/student/receipt/{{$transportfee['id']}}/{{ strtotime($transportfee->created_at) }}/fee/transport">
                      <i class="fa fa-eye faa-pulse animated" aria-hidden="true"></i>
                    </a>
                  </td>
                  
                  <td>  
                    <a class="btn btn-primary btn-xs" href="/staff/student/receipt/{{$transportfee['id']}}/{{ strtotime($transportfee->created_at) }}/fee/transport/print">
                      <i class="fa fa-print faa-vertical animated" aria-hidden="true"></i>
                    </a>
                  </td>

                   <td>  
                    <a class="btn btn-primary btn-xs" href="/staff/student/receipt/{{$transportfee['id']}}/{{ strtotime($transportfee->created_at) }}/fee/transport/download">
                      <i class="fa fa-download faa-vertical animated" aria-hidden="true"></i>
                    </a>
                  </td>

                  <td>
                      @include('staff.students.fee.delete_modal.delete_transport_fee_modal')
                   </td>

              </tr>
             @endforeach
            </tbody>
        </table>
      </div>
    </div>
  </div>
  {{ $transportfees->links() }}
	</div>
  
</div>

@endsection



@section('script')
@include('staff.add.destroy_modal_javascript')
@stop