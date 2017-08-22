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
         
                @if($student->HostelTaken())
                <th class="text-center">Pay Hostel Fee</th>
                @else
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
                     <a class="btn btn-success" href="/student/transport_fee/{{$student->reg_no}}/{{$student->uuid}}/details"><i class="fa fa-eye fa-lg faa-pulse animated" aria-hidden="true"></i>
                     </a>
                    </div>
                  </td>

                 
                   <td>
                    <div class="text-center">
                     <a class="btn btn-success" href="/student/{{$student->reg_no}}/{{$student->uuid}}/tution_fee/take"><i class="fa fa-eye fa-lg faa-pulse animated" aria-hidden="true"></i>
                     </a>
                    </div>
                  </td>
                 

                  @if($student->HostelTaken())
                  <td>
                    <div class="text-center">
                     <a class="btn btn-success" href="/student/{{$student->reg_no}}/{{$student->uuid}}/hostel_fee/take"><i class="fa fa-eye fa-lg faa-pulse animated" aria-hidden="true"></i>
                     </a>
                    </div>
                  </td>
                  @else
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
                    @include('staff.students.fee.modal.transport_fee_structure_modal')
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
        <div class="table-responsive text-center">
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

             <tbody>
             @foreach($transport_transactions as $transportfee)
                <tr>
                   <td>{{ $transportfee['created_at']->format('d/m/Y') }}</td>
                   <td>{{ $transportfee['month']->format('F') }}</td>
                   <td><i class="fa fa-inr" aria-hidden="true"></i> {{ $transportfee->other_fee + $transportfee->late_fee + $transportfee->transport_fee}}</td>
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
                     <a class="btn btn-primary btn-xs" href="/staff/student/receipt/{{$transportfee['id']}}/{{strtotime($transportfee->created_at)}}/fee/transport/print">
                       <i class="fa fa-print faa-vertical animated" aria-hidden="true"></i>
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
  </div>

  <div class="col-md-4">
  @if(!count($transport_fee_completed))
    <div class="panel panel-default">
     <div class="panel-heading text-center">
        <button class="btn btn-primary btn-block">
          Transport Fee Form
        </button>
     </div>
     <div class="panel-body">
       <form method="post" action="/student/{{$student->reg_no}}/{{$student->uuid}}/transport_fee/take" data-parsley-validate ="">
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
         <label for="stopage">Student Stoppage:</label>
         <div class="input-group">
           <span class="input-group-addon"><i class="fa fa-graduation-cap" aria-hidden="true"></i></span>
           <select class="form-control" id="stopage" name="stopage" required="">
           <option value="{{$student->stopage_id  }}">{{ $student->stopages['name'] }}</option>
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
         <label class="control-label" for="transport_fee">Transport Fee.:</label>
          <div class="input-group">
           <span class="input-group-addon"><i class="fa fa-inr" aria-hidden="true"></i></span>
           <input type="text" class="form-control" value="{{ old('transport_fee',$student->stopages->transportFee['transport_fee']) }}" name="transport_fee" id="transport_fee" required="" data-parsley-type="number">
          </div>
       </div>



       <div class="form-group">
         <label class="control-label" for="late_fee">Late Fee.:</label>
          <div class="input-group">
           <span class="input-group-addon"><i class="fa fa-inr" aria-hidden="true"></i></span>
           <input type="text" class="form-control" name="late_fee" value="{{ old('late_fee',$student->stopages->transportFee['late_fee']) }}" id="late_fee" data-parsley-type="number">
          </div>
       </div>

       <div class="form-group">
         <label class="control-label" for="other_fee">Other Fee.:</label>
          <div class="input-group">
           <span class="input-group-addon"><i class="fa fa-inr" aria-hidden="true"></i></span>
           <input type="text" class="form-control" name="other_fee" value="{{ old('other_fee',$student->stopages->transportFee['other_fee']) }}" id="other_fee" data-parsley-type="number">
          </div>
       </div>


       <div class="form-group">
         <label class="control-label" for="remarks">Remarks:</label>
           <textarea name="remarks" class="form-control"  rows="3">{{ Input::old('remarks') }}{{ $student->stopages->transportFee['remarks'] }}</textarea>
       </div>


        <div class="form-group">
           <label class="control-label" for="completed">Is transport fee completed for this session?:</label>
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
      <h4> All transport fee completed for this session</h4>

  @endif
  
</div>

@stop
@section('script')
  <script src="https://cdnjs.cloudflare.com/ajax/libs/parsley.js/2.7.0/parsley.min.js" type="text/javascript"></script>
  @include('staff.add.destroy_modal_javascript')
@stop
