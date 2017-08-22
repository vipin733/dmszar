@extends('layouts.app')
@section('nav')
@include('staff.staff_nav')
@stop
@section('content')
  @include('partial.errors')
<div class="row">

	<div class="col-md-12">
    @include('staff.teachers_staff.profile.profile_detail')
	</div>

	<div class="col-md-8">
    <div class="panel panel-default">
        <div class="panel-heading">
        <button class="btn btn-primary btn-block">
         Last 7 days attendance 
        </button>
        </div>
      <div class="panel-body">
        <div class="table-responsive">
          <table class=" table table-bordered  table-hover" data-form="deleteForm">
             <thead>
               <tr>
                  <th class="text-center">Date</th>
                  <th class="text-center">Marked</th>
                  <th class="text-center">Entry Time</th>
                  <th class="text-center">Leave Time</th>
                  <th class="text-center">By</th>
                  <th class="text-center">Uploaded At</th>
                  <th class="text-center">Update</th>
                  <th class="text-center">Delete</th>
               </tr>
             </thead>

              <tbody class="text-center">
                @foreach($attendences as $attendence)
                       @if($attendence->marked == 1)
                      <tr class="success">
                        @else
                      <tr class="danger">
                        @endif
                        <td>{{ $attendence['date']->format('d/m/Y') }}</td>
                        <td>
                        @if($attendence->marked == 1)
                          P
                        @else
                        A
                        @endif
                        </td>
                        <td>
                          @if($attendence['marked'] == 1)
                           @if($attendence['entry_time'])
                            {{ $attendence['entry_time']->format('h:i A') }}
                           @else
                           N/A
                           @endif 
                           @else
                           N/A                           
                           @endif 
                        </td>
                        <td>
                            @if($attendence['marked'] == 1)
                           @if($attendence['leave_time'])
                            {{ $attendence['leave_time']->format('h:i A') }}
                           @else
                           N/A
                           @endif 
                           @else
                           N/A                           
                           @endif
                        </td>
                        <td>{{ $attendence->taker['name'] }}</td>
                        <td>{{$attendence['created_at']->format('d/m/Y h:i A')}}</td>
                        <td>
                          @include('staff.teachers_staff.modal.teachers_staff_mark_modal_update')
                        </td>
                        <td>
                           @include('staff.teachers_staff.modal.teachers_staff_mark_modal_delete')
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
    <div class="panel panel-default">
      <div class="panel-heading">
          <button class="btn btn-primary btn-block">
           Attendance Mark Form
          </button>
      </div>
      <div class="panel-body">
          <form action="/st/teacher_staff/take_attendence/{{$teacher->uuid}}/{{$teacher->reg_no}}" method="POST" data-parsley-validate ="">
          {{ csrf_field() }}

            <div class="table-responsive">
              <table class=" table table-bordered  table-hover" >
                <thead >

                  <tr>
                    <th>Date(Date which have to take attendance)</th>
                    <td>
                      <input type="text" name="date" class="form-control" id="date_pic" value="{{ old('date',Carbon\Carbon::today()->format('d/m/Y')) }}" required="" >
                    </td> 
                  </tr>

                  <tr>
                    <th>Marked</th>
                    <td>
                      <select class="form-control" name="marked" id="marked" required="">
                        <option value="1">Present</option>
                        <option value="0">Absent</option>
                      </select>
                    </td> 
                  </tr>

                  <tr>
                    <th>Entry Time</th>
                    <td>
                      <input type='text' class="form-control" id="entry_time" name="entry_time" value="{{ old('entry_time') }}"/>
                      </div>
                    </td> 
                  </tr>
                     
                  <tr>
                    <th>Leave Time</th>
                    <td>
                       <input type="text" class=" form-control" id="leave_time" name="leave_time" value="{{ old('leave_time') }}">
                    </td> 
                  </tr>

                </thead>
              </table>
            </div>      
          	<div class="col-sm-6 col-sm-offset-3">
               <button type="submit" class="btn btn-success btn-block">Submit</button>
            </div>   
          </form>
      </div>
    </div>
  </div>
 </div>
 

</div>

@stop

@section('script')
<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.18.1/moment.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/parsley.js/2.7.0/parsley.min.js" type="text/javascript"></script>
<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datetimepicker/4.17.47/js/bootstrap-datetimepicker.min.js"></script>
@include('staff.add.destroy_modal_javascript')
<script type="text/javascript">
   
$(document).ready(function(){

    $(function () {
        $('#date_pic').datetimepicker({
           format: 'DD/MM/YYYY'
        });
    });

    $(function () {
        $('#entry_time').datetimepicker({
           format: 'LT'
        });
    });

    $(function () {
        $('#leave_time').datetimepicker({
          format: 'LT'
        });
    });


    $(function () {
        $('#entry_timey').datetimepicker({
           format: 'LT'
        });
    });

    $(function () {
        $('#leave_timey').datetimepicker({
          format: 'LT'
        });
    });

})

 
</script>
@endsection

