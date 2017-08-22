@extends('layouts.app')
@section('nav')
@include('staff.staff_nav')
@stop
@section('content')

<div class="row">
  <div class="panel panel-default">
      <div class="panel-heading">
        <button class="btn btn-primary btn-block">
          Student Information
        </button>
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
                <th class="text-center">Last Transaction</th>              
                <th class="text-center">Pay Tuition Fee</th> 
                <th class="text-center">Pay Registration Fee</th>        
                @if($student->TransportationTaken())
                <th class="text-center">Pay Transport Fee</th>
                @else
                @endif
                <th class="text-center">Attendance</th>
                <th class="text-center">Fee Structure</th>                
              </tr>
            </thead>
            <tbody class="text-center">
              <tr>
                  <td>{{$student->reg_no}}</td>
                  <td><a href="/st/student/{{$student->reg_no}}">{{ $student->name }}</a></td>
                  <td>{{ $student->father_name }}</td>
                  <td>{{$student->courses['name']}}</td>

                  <td>
                    <div class="text-center">
                     <a class="btn btn-success" href="/student/hostel_fee/{{$student->reg_no}}/{{$student->uuid}}/details"><i class="fa fa-eye fa-lg faa-pulse animated" aria-hidden="true"></i>
                     </a>
                    </div>
                  </td>

                 
                   <td>
                    <div class="text-center">
                     <a class="btn btn-success" href="/student/{{$student->reg_no}}/{{$student->uuid}}/tution_fee/take"><i class="fa fa-eye fa-lg faa-pulse animated" aria-hidden="true"></i>
                     </a>
                    </div>
                  </td>

                   <td>
                      <div class="text-center">
                       <a class="btn btn-success" href="/student/{{$student->reg_no}}/{{$student->uuid}}/registraion_fee/take">
                       <i class="fa fa-eye fa-lg faa-pulse animated" aria-hidden="true"></i>
                       </a>
                      </div>
                    </td>
                 

                  @if($student->TransportationTaken())
                  <td>
                    <div class="text-center">
                     <a class="btn btn-success" href="/student/{{$student->reg_no}}/{{$student->uuid}}/transport_fee/take"><i class="fa fa-eye fa-lg faa-pulse animated" aria-hidden="true"></i>
                     </a>
                    </div>
                  </td>
                  @else
                  @endif
                  <td>
                      <div class="text-center">
                       <a class="btn btn-success" href="/st/student/attendence/{{$student->reg_no}}/details"><i class="fa fa-eye fa-lg faa-pulse animated" aria-hidden="true"></i>
                       </a>
                      </div>
                    </td>
                  <td>
                  <div class="text-center">
                    @include('staff.students.fee.modal.hostel_fee_structure_modal')
                  </div>
                  </td>
              </tr>
            </tbody>
          </table>
        </div>
      </div>
  </div>
</div>
        
<div class="row">

@if(!count($hostel_fee_completed))
  <div class="col-md-8">
 @else 
 <div class="col-md-8">
 @endif
    <div class="panel panel-default">
      <div class="panel-heading">
        <button class="btn btn-primary btn-block">
          Last 12 Transactions 
        </button>
      </div>
      <div class="panel-body">
        <div class="table-responsive text-center">
          <table class=" table table-bordered  table-hover" data-form="deleteForm">
             <thead>
               <tr>
                 <th class="text-center">Submitted Date</th>
                 <th class="text-center">Session</th>
                 <th class="text-center">Amount</th>
                 <th class="text-center">Remarks</th>
                 <th class="text-center">Completed</th>
                 <th class="text-center">View</th>
                 <th class="text-center">Print</th>
                 <th class="text-center">Delete</th>
               </tr>
             </thead>

             <tbody>
               @foreach($hostel_transactions as $hostelfee)
                <tr>
                   <td >{{ $hostelfee['created_at']->format('d/m/Y') }}</td>
                   <td>{{ $hostelfee->asessions['name'] }}</td>
                   <td><i class="fa fa-inr" aria-hidden="true"></i> {{$hostelfee->other_fee + $hostelfee->late_fee + $hostelfee->hostel_fee}}</td>
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

                   <td >
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
                     @include('staff.students.fee.delete_modal.delete_hostel_fee_modal')
                   </td>
                </tr>
               @endforeach
             </tbody>
          </table>
        </div>
      </div>
    </div>
  </div>


  <div class="col-md-4">
  @if(!count($hostel_fee_completed))
    <div class="panel panel-default">
     <div class="panel-heading text-center">
        <button class="btn btn-primary btn-block">
          Hostel Fee Form
        </button>
     </div>
     <div class="panel-body">
       <form method="post" action="/student/{{$student->reg_no}}/{{$student->uuid}}/hostel_fee/take" data-parsley-validate ="">
       {{ csrf_field() }}

       <div class="form-group">
         <label for="course">Student Course:</label>
         <div class="input-group">
           <span class="input-group-addon"><i class="fa fa-graduation-cap" aria-hidden="true"></i></span>
           <select class="form-control" id="course" name="course" required="">
          <option value="{{$student->course_id  }}">{{ $student->courses['name'] }}</option>
           </select>
         </div>
       </div>

       <div class="form-group">
         <label for="hostel_type">Student Hostel Details:</label>
         <div class="input-group">
           <span class="input-group-addon"><i class="fa fa-graduation-cap" aria-hidden="true"></i></span>
           <select class="form-control" id="hostel_type" name="hostel_type" required="">
           <option value="{{$student->hostel_type_id  }}">{{ $student->hostels['name'] }}</option>
           </select>
         </div>
       </div>

       <div class="form-group">
         <label class="control-label" for="hostel_fee">Hostel Fee:</label>
          <div class="input-group">
           <span class="input-group-addon"><i class="fa fa-inr" aria-hidden="true"></i></span>
           <input type="text" class="form-control" value="{{ old('hostel_fee',$student->hostels->hostelfee['hostel_fee']) }}" name="hostel_fee" id="hostel_fee" required="" data-parsley-type="number">
          </div>
       </div>



       <div class="form-group">
         <label class="control-label" for="late_fee">Late Fee:</label>
          <div class="input-group">
           <span class="input-group-addon"><i class="fa fa-inr" aria-hidden="true"></i></span>
           <input type="text" class="form-control" name="late_fee" value="{{ old('late_fee',$student->hostels->hostelFee['late_fee']) }}" id="late_fee" data-parsley-type="number">
          </div>
       </div>

       <div class="form-group">
         <label class="control-label" for="other_fee">Other Fee:</label>
          <div class="input-group">
           <span class="input-group-addon"><i class="fa fa-inr" aria-hidden="true"></i></span>
           <input type="text" class="form-control" name="other_fee" value="{{ old('other_fee',$student->hostels->hostelFee['other_fee']) }}" id="other_fee" data-parsley-type="number">
          </div>
       </div>

       <div class="form-group">
         <label for="completed">Fee Completed For this session:</label>
         <div class="input-group">
           <span class="input-group-addon"><i class="fa fa-graduation-cap" aria-hidden="true"></i></span>
           <select class="form-control" id="completed" name="completed" required="">
             <option value="">--Select</option>
             <option value="0">No</option>
             <option value="1">Yes</option>
           </select>
         </div>
       </div>


       <div class="form-group">
         <label class="control-label" for="remarks">Remarks:</label>
           <textarea name="remarks" class="form-control"  rows="3">{{ Input::old('remarks') }}{{ $student->hostels->hostelFee['remarks'] }}</textarea>
       </div>

       <div class="col-sm-6 col-sm-offset-3">
         <div class="form-group">
          <button type="submit" class="btn btn-primary btn-lg btn-block"><i class="fa fa-plus faa-pulse animated" aria-hidden="true"></i> Submit</button>
         </div>
       </div>
     </form>
     </div>
   </div>
  </div>
  @else
      <h4> All hostel fee completed for this session</h4>

  @endif
</div>

@stop

@section('script')
  <script src="https://cdnjs.cloudflare.com/ajax/libs/parsley.js/2.7.0/parsley.min.js" type="text/javascript"></script>
  @include('staff.add.destroy_modal_javascript')
@stop