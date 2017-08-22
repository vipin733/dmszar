<button type="button" class="btn btn-warning btn-xs" data-toggle="modal" data-target="#aaa{{$attendence->id}}"><i class="fa fa-pencil" aria-hidden="true"></i>
</button>

<!-- Modal -->
<div class="modal fade" id="aaa{{$attendence->id}}" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title" id="myModalLabel">Update Teacher/staff Attendance</h4>
      </div>
      <div class="modal-body">
        
        <form action="/st/teacher_staff/take_attendence/{{$teacher->uuid}}/{{$teacher->reg_no}}/{{$attendence->id}}/update" method="post" data-parsley-validate ="" >
               {{ csrf_field() }} {{ method_field('PATCH') }}

          <div class="panel panel-default">

            <div class="panel-body">
              <div class="table-responsive">
                <table class=" table table-bordered  table-hover">
                  <thead >

                    <tr>
                      <th>Marked</th>
                      <td>
                        <select class="form-control" name="marked" id="marked" required="">
                          <option value="1">Present</option>
                          <option value="0">Absent</option>
                        </select>
                      </td> 
                    </tr>

                    <div id="datepickerdiv">
                      <div class="input-daterange form-group" id="datepicker">
                        <tr>
                          <th>Entry Time(ex. = 10:10 AM)</th>
                          <td>
                            <input type="text" class=" form-control" id="entry_timey" name="entry_time" value="@if($attendence['entry_time']){{ old('entry_time',$attendence['entry_time']->format('h:i A')) }}@else{{ old('entry_time') }}@endif">
                          </td> 
                        </tr>
                       
                        <tr>
                          <th>Leave TimeEntry Time(ex. = 04:00 PM)</th>
                          <td>                        
                            <input type="text" class=" form-control" id="leave_timey" name="leave_time" value="@if($attendence['leave_time']){{ old('leave_time',$attendence['leave_time']->format('h:i A')) }}@else{{ old('leave_time') }}@endif">
                          </td> 
                        </tr>
                      </div>
                    </div>

                  </thead>
                </table>
              </div>
              <div class="col-sm-6 col-sm-offset-3">
                <button type="submit" class="btn-primary btn btn-block">Submit</button>
              </div>
            </div>

          </div>        

        </form>       
       
      </div>
      <div class="modal-footer">
          <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
      </div>
    </div>
  </div>
</div>

