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
        <div class="table-responsive">
          <table class=" table table-bordered  table-hover">
              <thead>
                <tr>
                  <th class="text-center">Reg. No.</th>
                  <th class="text-center">Student Name</th>
                  <th class="text-center">Father Name</th>
                  <th class="text-center">Course Name</th>
                  @if($user->TransportationTaken())
                  <th class="text-center">Pay Transport Fee</th>
                  @else
                  @endif
                  @if($user->HostelTaken())
                   <th class="text-center">Pay Hostel Fee</th>
                  @else
                  @endif
                  <th class="text-center">Pay Tuition Fee</th>
                  <th class="text-center">Pay Registration Fee</th>
                  <th class="text-center">Attendance</th>
                </tr>
              </thead>
              <tbody>
                <tr class="text-center">
                    <td>{{ $user->reg_no}}</td>
                    <td>{{ $user->name }}</td>
                    <td>{{ $user->father_name }}</td>
                    <td>{{$user->courses['name']}}</td>
                    @if($user->TransportationTaken())
                    <td>
                      <div class="text-center">
                       <a class="btn btn-success" href="/student/{{$user->reg_no}}/{{$user->uuid}}/transport_fee/take"><i class="fa fa-eye fa-lg faa-pulse animated" aria-hidden="true"></i>
                       </a>
                      </div>
                    </td>
                    @else
                    @endif

                    @if($user->HostelTaken())
                    <td>
                      <div class="text-center">
                       <a class="btn btn-success" href="/student/{{$user->reg_no}}/{{$user->uuid}}/hostel_fee/take"><i class="fa fa-eye fa-lg faa-pulse animated" aria-hidden="true"></i>
                       </a>
                      </div>
                    </td>
                    @else
                    @endif

                    <td>
                      <div class="text-center">
                       <a class="btn btn-success" href="/student/{{$user->reg_no}}/{{$user->uuid}}/tution_fee/take">
                       <i class="fa fa-eye fa-lg faa-pulse animated" aria-hidden="true"></i>
                       </a>
                      </div>
                    </td>

                    <td>
                      <div class="text-center">
                       <a class="btn btn-success" href="/student/{{$user->reg_no}}/{{$user->uuid}}/registraion_fee/take">
                       <i class="fa fa-eye fa-lg faa-pulse animated" aria-hidden="true"></i>
                       </a>
                      </div>
                    </td>

                    <td>
                      <div class="text-center">
                       <a class="btn btn-success" href="/st/student/attendence/{{$user->reg_no}}/details"><i class="fa fa-eye fa-lg faa-pulse animated" aria-hidden="true"></i>
                       </a>
                      </div>
                    </td>                 
                </tr>
              </tbody>
          </table>
        </div>
      </div>
    </div>
  </div>
        
	<div class="col-sm-12 col-md-12">
	  <div class="panel panel-default">
	    <div class="panel-heading">
	      <button class="btn btn-primary btn-block">Student Last Hostel Fee Transactions</button>
	    </div>
	    <div class="panel-body">
        <div class="table-responsive">
		      <table class=" table table-bordered  table-hover" data-form="deleteForm">
            <thead>
              <tr>
                <th class="text-center">Sr. No.</th>
                <th class="text-center">Date</th>
                <th class="text-center">Session</th>
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
             @foreach($hostelfees as $hostelfee)
             <?php $i++ ?>
              <tr>
                  <td>{{ $i }}</td>
                  <td>{{ $hostelfee['created_at']->format('d/m/Y') }}</td>
                  <td>{{ $hostelfee->asessions['name'] }}</td>
                  <td>{{ $hostelfee->courses['name'] }}</td>
                  
                  <td>
                    <i class="fa fa-inr" aria-hidden="true"></i> 
                    {{$hostelfee['hostel_fee'] + $hostelfee['late_fee'] + $hostelfee['other_fee']}}
                  </td>
                  
                  <td>
                    @if($hostelfee['remarks']) 
                     {{ $hostelfee['remarks'] }}
                     @else
                     Fee Submitted
                    @endif
                  </td>

                   <td>
                      @if($hostelfee['completed'] == 0)
                       No
                     @else
                       Yes
                     @endif
                   </td>

                  <td>
                    <a class="btn btn-success btn-xs" href="/staff/student/receipt/{{$hostelfee['id']}}/{{ strtotime($hostelfee->created_at) }}/fee/hostel">
                      <i class="fa fa-eye faa-pulse animated" aria-hidden="true"></i>
                    </a>
                  </td>
                  
                  <td>  
                    <a class="btn btn-primary btn-xs" href="/staff/student/receipt/{{$hostelfee['id']}}/{{ strtotime($hostelfee->created_at) }}/fee/hostel/print">
                      <i class="fa fa-print faa-vertical animated" aria-hidden="true"></i>
                    </a>
                  </td>

                   <td>  
                    <a class="btn btn-warning btn-xs" href="/staff/student/receipt/{{$hostelfee['id']}}/{{ strtotime($hostelfee->created_at) }}/fee/hostel/download">
                      <i class="fa fa-download faa-vertical animated" aria-hidden="true"></i>
                    </a>
                  </td>

                  <td>
                      @include('staff.students.fee.delete_modal.delete_hostel_fee_modal')
                  </td>

              </tr>
              @endforeach
            </tbody>
          </table>
        </div>
      </div>     
    </div>
    {{ $hostelfees->links() }}
  </div>

</div>
  

@endsection

@section('script')

  @include('staff.add.destroy_modal_javascript')
@stop