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
                <th class="text-center">Submitted At</th>
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
            @foreach($tutionfees as $tutionfee)
            <?php $i++ ?>
              <tr>
                  <td>{{$i}}</td>
                  <td>{{ $tutionfee['created_at']->format('d/m/Y') }}</td>
                  <td>{{  $tutionfee['month']->format('F') }}</td>
                  <td>{{ $tutionfee->courses['name'] }}</td>
                  
                  <td>
                    <i class="fa fa-inr" aria-hidden="true"></i> {{ $tutionfee['tution_fee'] + $tutionfee['late_fee'] + $tutionfee['other_fee']}}
                  </td>

                  <td>
                  @if($tutionfee->remarks)
                   {{ $tutionfee['remarks'] }}
                  @else
                  Fee submitted
                  @endif
                  </td>

                  <td>
                    <a class="btn btn-success btn-xs" href="/student/tution/{{$tutionfee['id']}}/{{strtotime($tutionfee['created_at'])}}/fee_receipt">
                      <i class="fa fa-eye faa-pulse animated" aria-hidden="true"></i>
                    </a>
                   </td>

                   <td> 
                    <a class="btn btn-primary btn-xs" href="/student/tution/{{$tutionfee['id']}}/{{strtotime($tutionfee['created_at'])}}/fee_receipt/print">
                      <i class="fa fa-print faa-vertical animated" aria-hidden="true"></i>
                    </a>
                  </td>

                  <td> 
                    <a class="btn btn-warning btn-xs" href="/student/tution/{{$tutionfee['id']}}/{{strtotime($tutionfee['created_at'])}}/fee_receipt/download">
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
            <p style="text-align: justify;">This record is issued on the basis of information available in the office of records on the date of its issue and the school reserves the right to update/change any information contained here in without further notice. For any Result/Mapping query Consult school Division.</p>
</div>

@endsection