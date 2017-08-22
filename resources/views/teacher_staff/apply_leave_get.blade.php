@extends('layouts.app')
@section('nav')
@if(Auth::user()->isStaff())
@include('staff.staff_nav')
@else
@include('teacher.teacher_nav')
@endif
@stop
@section('content')
@include('partial.errors')

    <div class="row">

        <div class="col-md-6" id="sandbox-container">
	        <div class="panel panel-default">
	            <div class="panel-heading">
		            <button class="btn btn-primary btn-block">
		             Apply Leave Form
		            </button>
		          </div>
	            <div class="panel-body">
	               <form action="/teacher_staff/apply_leave/post" method="post" data-parsley-validate ="">
                 {{ csrf_field() }} 
	               	  <div class="form-group{{ $errors->has('leave_type') ? ' has-error' : '' }}">
  				            <label for="leave_type">Select Leave Type</label>
  				            <select name="leave_type" id="leave_type" class="form-control" required="">
                        <option value="">--Select</option>
                        <option value="0">Half Day</option>
                        <option value="1">Full Day</option>   
  				            </select>
                        @if ($errors->has('leave_type'))
                          <span class="help-block">
                            <strong>{{ $errors->first('leave_type') }}</strong>
                          </span>
                        @endif
				            </div>
                    <div id="datepickerdiv">
				            <div class="input-daterange  input-group date form-group{{ $errors->has(['leave_start','leave_end']) ? ' has-error' : '' }}" id="datepicker">
                        <span class="input-group-addon">Leave Date Start</span>
                        <input type="text" class="input-sm form-control" id="leave_start" name="leave_start">
                        <span class="input-group-addon">Leave Date End</span>
                        <input type="text" class="input-sm form-control" id="leave_end" name="leave_end">
                    </div>
                    </div>
                    <div id="timepickerdiv">
                    <div class="input-group bootstrap-timepicker timepicker form-group{{ $errors->has(['leave_time_start','leave_time_end']) ? ' has-error' : '' }}" id="">
                        <span class="input-group-addon">Leave Time Start</span>
                        <input type="text" class="input-sm form-control" id="leave_time_start" name="leave_time_start">
                        <span class="input-group-addon">Leave Time End</span>
                        <input type="text" class="input-sm form-control" id="leave_time_end" name="leave_time_end">
                    </div>
                    </div><br>
                    <div class="form-group{{ $errors->has('reason') ? ' has-error' : '' }}">
                      <label for="reason">Reason For Leave</label>
                      <textarea class="form-control" name="reason" required="">{{ old('reason') }}</textarea>
                      @if ($errors->has('reason'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('reason') }}</strong>
                                    </span>
                        @endif
                    </div>
                    <br>
                    <div class="form-group">
                      <button class="btn-primary btn-block btn" type="submit">Submit</button>
                    </div>
	               </form>
	            </div>
	        </div>
        </div>   

        <div class="col-md-6">
            <div class="panel panel-default">
              <div class="panel-heading">
                <button class="btn btn-primary btn-block">
                  Applied Leave
                </button>
              </div>
              <div class="panel-body">

                <div class="table-responsive">
                  <table class=" table table-bordered  table-hover" id="userstable">
                    <thead>
                      <tr>
                        <th class="text-center">Leave Type</th>
                        <th class="text-center">Apply Date</th>
                        <th class="text-center">Status</th>
                        <th class="text-center">More</th>
                      </tr>  
                    </thead>
                    <tbody class="text-center">
                      @foreach($teacherleaves as $teacherleave)
                        <tr>
                          <td>
                            @if($teacherleave->leave_type == 1)
                            Full Day
                            @else
                            Half Day
                            @endif
                          </td>
                          <td>{{ $teacherleave['created_at']->format('d/m/Y') }}</td>
                          <td>
                            @if($teacherleave['status'] == 1)
                            Pending
                            @elseif($teacherleave['status'] == 2)
                            Rejected
                            @else
                            Approved
                            @endif
                          </td>
                          <td>@include('teacher_staff.leaves_modal')</td>
                       </tr>
                      @endforeach
                    </tbody>
                  </table>
                </div> 

                  {{ $teacherleaves->links() }}

              </div>
            </div>  
        </div> 

    </div>

@stop    
@section('script')

<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.18.1/moment.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/parsley.js/2.7.0/parsley.min.js" type="text/javascript"></script>
<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datetimepicker/4.17.47/js/bootstrap-datetimepicker.min.js"></script>
 <script type="text/javascript">

      $(document).ready(function(){

     $(function () {
        $('#leave_start').datetimepicker({
           format: 'DD/MM/YYYY'
        });
    });

      $(function () {
        $('#leave_end').datetimepicker({
           format: 'DD/MM/YYYY'
        });
    });

    $(function () {
        $('#leave_time_start').datetimepicker({
           format: 'LT'
        });
    });

    $(function () {
        $('#leave_time_end').datetimepicker({
          format: 'LT'
        });
    });

$('#leave_type').on('change',function(){
    if( $(this).val()==="1"){
    $("#datepickerdiv").show()
    $("#timepickerdiv").hide()
    }
    else{
    $("#datepickerdiv").hide()
    $("#timepickerdiv").show()
    }
});
if( $('#leave_type').val()===""){
     $("#timepickerdiv").hide()
     $("#datepickerdiv").hide()
};


$('#search-form').on('submit', function(e) {
  oTable.draw();
  e.preventDefault();
});
})

</script>

@stop 