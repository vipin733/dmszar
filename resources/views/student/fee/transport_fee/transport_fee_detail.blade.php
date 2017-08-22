@extends('layouts.app')
@section('nav')
@include('student.student_nav')
@stop
@section('content')

<div class="row">
	<div class="col-sm-12 col-md-12">
	   <div class="panel panel-default">
	   <div class="panel-heading">
	    <button class="btn btn-primary btn-block">My Last Transaction({{ $sessionid['name'] }})</button>
	   </div>
	   <div class="panel-body">
        <div class="table-responsive text-center">
		      <table class=" table table-bordered  table-hover" data-form="deleteForm">
            <thead>

              <tr>
                <th class="text-center">Sr. No.</th>
                <th class="text-center">Taken At</th>
                <th class="text-center">Month</th>
                <th class="text-center">Course</th>
                <th class="text-center">Total</th>
                <th class="text-center">Remarks</th>
                <th class="text-center">View</th>
                <th class="text-center">Print</th>
                <th class="text-center">Download</th>
              </tr>
              
            </thead>
            <tbody>
             <?php $i = 0 ?>
            @foreach($transportfees as $transportfee)
            <?php $i++ ?>
              <tr>
                  <td>{{$i}}</td>
                  <td>{{ $transportfee['created_at']->format('d/m/Y') }}</td>
                  <td>{{  $transportfee['month']->format('F') }}</td>
                  <td>{{ $transportfee->courses['name'] }}</td>
                  
                  <td><i class="fa fa-inr" aria-hidden="true"></i> {{ $transportfee['transport_fee'] + $transportfee['late_fee'] + $transportfee['other_fee']}}
                  </td>

                  <td>
                  @if($transportfee->remarks)
                   {{ $transportfee['remarks'] }}
                  @else
                  Fee submitted
                  @endif
                  </td>

                  <td>
                    <a class="btn btn-success btn-xs" href="/student/transport/{{$transportfee['id']}}/{{strtotime($transportfee['created_at'])}}/fee_receipt">
                      <i class="fa fa-eye faa-pulse animated" aria-hidden="true"></i>
                    </a>
                  </td>

                  <td>
                    <a class="btn btn-primary btn-xs" href="/student/transport/{{$transportfee['id']}}/{{strtotime($transportfee['created_at'])}}/fee_receipt/print">
                      <i class="fa fa-print faa-vertical animated" aria-hidden="true"></i>
                    </a>
                  </td>

                  <td>
                    <a class="btn btn-warning btn-xs" href="/student/transport/{{$transportfee['id']}}/{{strtotime($transportfee['created_at'])}}/fee_receipt/download">
                      <i class="fa fa-download faa-vertical animated" aria-hidden="true"></i>
                    </a>
                  </td>

              </tr>
            @endforeach 
            </tbody>
          </table>
        </div>
     </div>
    </div>

  <button class="btn btn-warning btn-xs btn-block"><b>Disclaimer</b></button>
            <p style="text-align: justify;">This result is issued on the basis of information available in the office of records on the date of its issue and the University reserves the right to update/change any information contained here in without further notice. The University expressly disclaims all obligations to confirm the accuracy of any of the particulars in this result based upon information submitted by the candidate. For any Result/Mapping query Consult Examination Division.</p>
</div>

@endsection