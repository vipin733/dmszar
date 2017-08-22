@extends('layouts.app')
@section('nav')
@include('staff.staff_nav')
@stop
@section('content')
   
   <div class="row"  style="margin-top: 20px;, border: 1px;">
   <div class="col-md-10  col-md-offset-1">
      <div class="panel panel-default">
        <div class="panel-body">
         <div class="row">

            <div class="col-md-2">
                <div class="text-center">
                    @if($owner->schoolprofile['logo'])
                       <img src="{{ $owner->schoolprofile['logo'] }}" alt="{{$owner->schoolprofile['school_name']}}" width="100" height="100">
                       @else
                       <img src="https://s3.ap-south-1.amazonaws.com/dbmszar/assets/images/no-image-found.jpg" alt="{{$owner->schoolprofile['school_name']}}" width="100" height="100">
                  @endif
                </div>
            </div>
            <div class="col-md-10">
                <div class="text-center">
                    <h4><strong>{{$owner->schoolprofile['school_name']}}</strong></h4>
                    <h5>
                      {{ $owner->schoolprofile['school_address'] }}, {{ $owner->schoolprofile['city'] }}, {{ $owner->schoolprofile->appdistricts['name'] }}, {{$owner->schoolprofile->states['name']}}, - {{$owner->schoolprofile['pincode']}}
                    </h5>
                    <h5 style=""><strong>Transportation Fee Receipt({{ $fee_receipt_transport->asessions['name'] }})</strong></h5>
                </div>
            </div>

         </div><br>

        <div class="row">
         <div class="col-md-6">
          <div class="table-responsive">
          <table class=" table table-bordered  table-hover">
            <thead>
              <tr>
                <th>
                  Date
                </th>
                <td>
                 {{Carbon\Carbon::today()->format('d/m/Y')}}
                </td>
              </tr>
              <tr>
                <th>
                  Receipt No.
                </th>
                <td>
                 T/{{$fee_receipt_transport->month->format('Y')}}/{{ $fee_receipt_transport->reciept_no }}
                </td>
              </tr>
              <tr>
                <th>
                  Student ID
                </th>
                <td>
                  {{ $fee_receipt_transport->students['reg_no'] }}
                </td>
                </tr>
                <tr>
                  <th>
                  Student Name
                </th>
                <td>
                  {{ $fee_receipt_transport->students['name'] }}
                </td>
                </tr>
                <tr>
                  <th>
                  Father Name
                </th>
                <td>
                  {{ $fee_receipt_transport->students['father_name'] }}
                </td>
                </tr>
                <tr>
                  <th>
                  Course
                </th>
                <td>
                  {{ $fee_receipt_transport->courses['name'] }}
                </td>
                </tr>
                <tr>
                  <th>
                  Stoppage
                </th>
                <td>
                  {{ $fee_receipt_transport->stopages['name'] }}
                </td>
                </tr>
                <tr>
                  <th>
                  Month
                </th>
                <td>
                  {{ $fee_receipt_transport['month']->format('F') }}
                </td>
                </tr>
                <tr>
                  <th>
                  Fee Submitted Date
                </th>
                <td>
                  {{ $fee_receipt_transport['created_at']->format('d/m/Y') }}
                </td>
                </tr>
            </thead>
          </table>
        </div>
         </div>
         <div class="col-md-6">
         <div class="table-responsive">
          <table class=" table table-bordered  table-hover">
            <thead>
              <tr>
                <th>
                 <div class="text-center">
                   Fee Type
                 </div>
                </th>
                <th>
                  <div class="text-center">
                   Fee
                  </div>
                </th>
                 <th>
                  <div class="text-center">
                   Remarks
                  </div>
                </th>
              </tr>
            </thead>
            <tbody>
                  <tr>
                      <td>
                        <div class="text-center">
                          Transport Fee
                        </div>
                      </td>
                      <td>
                          <div class="text-center">
                              <i class="fa fa-inr" aria-hidden="true"></i> {{$fee_receipt_transport->transport_fee}}
                          </div>
                      </td>
                      <td rowspan="4">
                        <div class="text-center">

                            @if($fee_receipt_transport->remarks)
                            {{ $fee_receipt_transport->remarks }}
                            @else
                            Fee submitted
                            @endif

                        </div>
                      </td>
                  </tr>


                  <tr>
                      <td>
                        <div class="text-center">
                          Late Fee
                        </div>
                      </td>
                       <td>
                           <div class="text-center">
                           <i class="fa fa-inr" aria-hidden="true"></i>
                             @if($fee_receipt_transport->late_fee)
                               {{$fee_receipt_transport->late_fee}}
                            @else
                               0
                            @endif
                          </div>
                       </td>
                  </tr>

                  <tr>
                      <td>
                        <div class="text-center">
                          Other Fee
                        </div>
                      </td>
                       <td>
                           <div class="text-center">
                           <i class="fa fa-inr" aria-hidden="true"></i>
                             @if($fee_receipt_transport->other_fee)
                               {{$fee_receipt_transport->other_fee}}
                            @else
                               0
                            @endif
                          </div>
                       </td>
                  </tr>

                  <tr>
                      <td>
                       <div class="pull-right">
                         <strong>Total</strong>
                        </div>
                      </td>
                       <td>
                          <div class="text-center">
                              <strong><i class="fa fa-inr" aria-hidden="true"></i> {{$total}}</strong>
                          </div>
                       </td>
                  </tr>
            </tbody>
          </table>
          </div>
         </div>

        </div>


       <div class="row">
          <div class="col-md-8">
            <h5>By: <strong>{{ $fee_receipt_transport->takers['name']  }}</strong></h5>
          </div>
       </div>
   </div>
  </div>
  <div class="col-md-4 col-md-offset-4 col-xs-8 col-xs-offset-2">
         <a href="{{ URL::to('/staff/fee_analysis/transport_transactions') }}" class="btn btn-warning"><i class="fa fa-backward faa-passing-reverse animated" aria-hidden="true"></i> Back</a>
         <a href="/staff/student/receipt/{{$fee_receipt_transport->id}}/{{strtotime($fee_receipt_transport->created_at)}}/fee/transport/print" class="btn btn-primary"><i class="fa fa-print faa-pulse animated" aria-hidden="true"></i> Print</a>
        <a href="/staff/student/receipt/{{$fee_receipt_transport->id}}/{{strtotime($fee_receipt_transport->created_at)}}/fee/transport/print" class="btn btn-success"><i class="fa fa-download faa-vertical animated" aria-hidden="true"></i> Save</a>
  </div>
 </div>
</div>
<br><br>
@stop