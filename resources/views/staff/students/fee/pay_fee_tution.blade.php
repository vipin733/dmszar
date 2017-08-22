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
          <table class="table table-bordered  table-hover">
            <thead>
              <tr>
                <th class="text-center">Reg. No.</th>
                <th class="text-center">Student Name</th>
                <th class="text-center">Father Name</th>
                <th class="text-center">Course Name</th>
                <th class="text-center">Last Transaction</th>
                @if($student->TransportationTaken())
                <th class="text-center">Pay Transport Fee</th>
                @endif
                @if($student->HostelTaken())
                <th class="text-center">Pay Hostel Fee</th>
                @endif
                <th class="text-center">Pay Registration Fee</th> 
                <th class="text-center">Attendance</th>
                <th class="text-center">Fee Structure</th>
              </tr>
            </thead>
            <tbody>
              <tr class="text-center">
                  <td>{{$student->reg_no}}</td>
                  <td><a href="/st/student/{{$student->reg_no}}">{{ $student->name }}</a></td>
                  <td>{{ $student->father_name }}</td>
                  <td>{{$student->courses['name']}}</td>

                  <td>
                    <div class="text-center">
                     <a class="btn btn-success" href="/student/tution_fee/{{$student->reg_no}}/{{$student->uuid}}/details"><i class="fa fa-eye fa-lg faa-pulse animated" aria-hidden="true"></i>
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
                  @endif

                  @if($student->HostelTaken())
                  <td>
                    <div class="text-center">
                     <a class="btn btn-success" href="/student/{{$student->reg_no}}/{{$student->uuid}}/hostel_fee/take"><i class="fa fa-eye fa-lg faa-pulse animated" aria-hidden="true"></i>
                     </a>
                    </div>
                  </td>
                  @endif

                  <td>
                    <div class="text-center">
                       <a class="btn btn-success" href="/student/{{$student->reg_no}}/{{$student->uuid}}/registraion_fee/take">
                       <i class="fa fa-eye fa-lg faa-pulse animated" aria-hidden="true"></i>
                       </a>
                      </div>
                  </td>
                   
                   <td>
                      <div class="text-center">
                       <a class="btn btn-success" href="/st/student/attendence/{{$student->reg_no}}/details"><i class="fa fa-eye fa-lg faa-pulse animated" aria-hidden="true"></i>
                       </a>
                      </div>
                    </td>

                  <td>
                  <div class="text-center">
                    @include('staff.students.fee.modal.tution_fee_structure_modal')
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
  <div class="col-md-8">
    <div class="panel panel-default">
      <div class="panel-heading">
        <button class="btn btn-primary btn-block">
          Last 12 Transactions 
        </button>
      </div>
      <div class="panel-body">
        <div class="table-responsive">
          <table class=" table table-bordered  table-hover" data-form="deleteForm">
             <thead>
               <tr>
                 <th class="text-center">Submitted Date</th>
                 <th class="text-center">Month</th>
                 <th class="text-center">Amount</th>
                 <th class="text-center">Remarks</th>
                 <th class="text-center">Completed</th>
                 <th class="text-center">View</th>
                 <th class="text-center">Print</th>
                 <th class="text-center">Delete</th>
               </tr>
             </thead>

             <tbody class="text-center">
               @foreach($tutions_transactions as $tutionfee)
                  <tr>
                   <td>{{ $tutionfee['created_at']->format('d/m/Y') }}</td>
                   <td>{{ $tutionfee['month']->format('F') }}</td>
                   <td>
                     <i class="fa fa-inr" aria-hidden="true"></i> {{ $tutionfee->other_fee + $tutionfee->late_fee + $tutionfee->tution_fee}}
                   </td>
                   <td>
                     @if($tutionfee['remarks'])
                     {{ $tutionfee['remarks'] }}
                     @else
                      Fee Submitted
                     @endif
                   </td>
                    <td>
                      @if($tutionfee['completed'] == 0)
                       No
                     @else
                       Yes
                     @endif
                   </td>
                   <td>
                      <a class="btn btn-success btn-xs" href="/staff/student/receipt/{{$tutionfee['id']}}/{{ strtotime($tutionfee->created_at) }}/fee/tution">
                       <i class="fa fa-eye faa-pulse animated" aria-hidden="true"></i>
                     </a>
                    </td>

                    <td> 
                     <a class="btn btn-primary btn-xs" href="/staff/student/receipt/{{$tutionfee->id}}/{{strtotime($tutionfee->created_at)}}/fee/tution/print">
                       <i class="fa fa-print faa-vertical animated" aria-hidden="true"></i>
                     </a>
                    </td>

                    <td>
                       @include('staff.students.fee.delete_modal.delete_tution_fee_modal')
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
  @if(!count($tution_fee_completed))
    <div class="panel panel-default">
     <div class="panel-heading text-center">
        <button class="btn btn-primary btn-block">
          Tuition Fee Form
        </button>
     </div>
     <div class="panel-body">
       <form method="post" action="/student/{{$student->reg_no}}/{{$student->uuid}}/tution_fee/take" data-parsley-validate ="">
        {{ csrf_field() }}

       <div class="form-group">
         <label for="course_id">Student Course:</label>
         <div class="input-group">
           <span class="input-group-addon"><i class="fa fa-graduation-cap" aria-hidden="true"></i></span>
           <select class="form-control" id="course" name="course" required="">
             <option value="{{ $student->course_id }}">{{ $student->courses['name'] }}</option>
           </select>
         </div>
       </div>

       <div class="form-group">
           <label for="course_id">Select Month:</label>
         <div class="input-group">
           <span class="input-group-addon"><i class="fa fa-calendar" aria-hidden="true"></i></span>
          {{ Form::selectMonth('month',  null, ['placeholder' => '---Select Month','class' => 'form-control','required'=> ' "" '  ]) }}
          </div>
       </div>

       <div class="form-group">
         <label class="control-label" for="tution_fee">Tuition Fee:</label>
          <div class="input-group">
           <span class="input-group-addon"><i class="fa fa-inr" aria-hidden="true"></i></span>
           <input type="text" class="form-control" value="{{ old('tution_fee',$student->courses->tutionfee['tution_fee']) }}" name="tution_fee" id="tution_fee" required="" data-parsley-type="number">
          </div>
       </div>

       <div class="form-group">
         <label class="control-label" for="late_fee">Late Fee:</label>
          <div class="input-group">
           <span class="input-group-addon"><i class="fa fa-inr" aria-hidden="true"></i></span>
           <input type="text" class="form-control" name="late_fee" value="{{ old('late_fee',$student->courses->tutionfee['late_fee']) }}" id="late_fee" data-parsley-type="number">
          </div>
       </div>

       <div class="form-group">
         <label class="control-label" for="other_fee">Other Fee:</label>
          <div class="input-group">
           <span class="input-group-addon"><i class="fa fa-inr" aria-hidden="true"></i></span>
           <input type="text" class="form-control" id="other_fee" value="{{ old('other_fee',$student->courses->tutionfee['other_fee']) }}" name="other_fee" data-parsley-type="number">
          </div>
       </div>

       <div class="form-group">
         <label class="control-label" for="remarks">Remarks:</label>
           <textarea name="remarks" class="form-control"  rows="3">{{ Input::old('remarks') }}{{$student->courses->tutionfee['remarks']}}</textarea>
       </div>

       <div class="form-group">
           <label class="control-label" for="completed">Is tuition fee completed for this session?:</label>
           <select class="form-control" id="completed" name="completed" required="">
             <option value="">--Select</option>
             <option value="0">No</option>
             <option value="1">Yes</option>
           </select>
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
      <h4> All tuition fee completed for this session</h4>

  @endif

</div>

@stop
@section('script')
  <script src="https://cdnjs.cloudflare.com/ajax/libs/parsley.js/2.7.0/parsley.min.js" type="text/javascript"></script>
    @include('staff.add.destroy_modal_javascript')
@stop
