@extends('layouts.app')
@section('nav')
@include('student.student_nav')
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
                    <h5 style=""><strong>Hostel Fee Receipt({{ $hostelfee->asessions['name'] }})</strong></h5>
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
                H/{{$hostelfee->created_at->format('Y')}}/{{ $hostelfee->reciept_no }}
                </td>
              </tr>
              <tr>
                <th>
                  Student ID
                </th>
                <td>
                  {{ $hostelfee->students['reg_no'] }}
                </td>
                </tr>
                <tr>
                  <th>
                  Student Name
                </th>
                <td>
                  {{ $hostelfee->students['name'] }}
                </td>
                </tr>
                <tr>
                  <th>
                  Father Name
                </th>
                <td>
                  {{ $hostelfee->students['father_name'] }}
                </td>
                </tr>
                <tr>
                  <th>
                  Course Name
                </th>
                <td>
                  {{ $hostelfee->courses['name'] }}
                </td>
                </tr>
                <tr>
                  <th>
                 Hostel
                </th>
                <td>
                  {{ $hostelfee->hostels['name'] }}
                </td>
                </tr>
                <tr>
                  <th>
                  Fee Submitted Date
                </th>
                <td>
                  {{ $hostelfee['created_at']->format('d/m/Y') }}
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
                          Hostel Fee
                        </div>
                        </td>
                      <td>
                          <div class="text-center">
                              <i class="fa fa-inr" aria-hidden="true"></i> {{ $hostelfee['hostel_fee'] }}
                          </div>
                      </td>
                      <td rowspan="5">
                        <div class="text-center">
                       
                         @if($hostelfee->remarks)
                           {{ $hostelfee['remarks'] }}
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
                              @if($hostelfee->late_fee)
                              {{ $hostelfee['late_fee'] }}
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
                              @if($hostelfee->late_fee)
                              {{ $hostelfee['other_fee'] }}
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
                              <strong><i class="fa fa-inr" aria-hidden="true"></i> {{ $total}}</strong>
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
            <h5>By: <strong>{{ $hostelfee->takers['name'] }}</strong></h5>
          </div>
       </div>

   </div>
  </div>
  <div class="col-md-4 col-md-offset-4 col-xs-8 col-xs-offset-2 text-center">

         <a href="/student/hostel/fee_detail" class="btn btn-warning"><i class="fa fa-backward faa-passing-reverse animated" aria-hidden="true"></i> Back</a>
         <a href="/student/hostel/{{$hostelfee['id']}}/{{strtotime($hostelfee['created_at'])}}/fee_receipt/print" class="btn btn-primary"><i class="fa fa-print faa-pulse animated" aria-hidden="true"></i> Print
         </a>
          <a href="/student/hostel/{{$hostelfee['id']}}/{{strtotime($hostelfee['created_at'])}}/fee_receipt/download" class="btn btn-success"><i class="fa fa-download faa-vertical animated" aria-hidden="true"></i> Save
        </a>
    <br><br>
  </div>
 </div>
</div>
@endsection