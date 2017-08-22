<button type="button" class="btn btn-primary btn-sm" data-toggle="modal" data-target="#{{$teacherleave->id}}"><i class="fa fa-eye faa-pulse animated" aria-hidden="true"></i>
</button>

<!-- Modal -->
<div class="modal fade" id="{{$teacherleave->id}}" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
  <div class="modal-dialog modal-lg" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span>
        </button>
        <h4 class="modal-title" id="myModalLabel">Leave Details</h4>
      </div>
      <div class="modal-body">
          <div class="table-responsive">
            <table class=" table table-bordered  table-hover" id="userstable">
              <thead>
                <tr>
                @if($teacherleave->leave_type == 1)
                  <th class="text-center">Leave Date Start</th>
                  <th class="text-center">Leave Date End</th>
                @else
                  <th class="text-center">Leave Time Start</th>
                  <th class="text-center">Leave Time End</th>
                @endif  
                  <th class="text-center">Reason</th>
                  <th class="text-center">Action Taken By</th>
                  <th class="text-center">Remarks</th>
                  <th class="text-center">Updated At</th>
                </tr>
              </thead>
              <tbody>
                <tr>
                  @if($teacherleave->leave_type == 1)
                   <td>{{ $teacherleave['leave_start']->format('d/m/Y') }}</td>
                   <td>{{ $teacherleave['leave_end']->format('d/m/Y') }}</td>
                  @else 
                   <td>{{ $teacherleave['leave_time_start']->format('h:i A') }}</td>
                   <td>{{ $teacherleave['leave_time_end']->format('h:i A') }}</td>
                  @endif
                  <td>{{ $teacherleave->reason }}</td>
                  <td>
                    @if($teacherleave->actiontakenby)
                    {{ $teacherleave->actiontakenby['name'] }}
                    @else
                    N/A
                    @endif
                  </td>
                  <td>
                    @if($teacherleave->remarks)
                    {{ $teacherleave->remarks }}
                    @else
                    N/A
                    @endif
                  </td>
                  <td>
                    @if($teacherleave['created_at'] == $teacherleave['updated_at'])
                    N/A
                    @else
                    {{ $teacherleave['updated_at']->format('d/m/Y, h:i A') }}
                    @endif
                  </td>
                </tr>
              </tbody>
            </table>
          </div>               
      </div>
      <div class="modal-footer">
      <button type="button" class="btn btn-default" data-dismiss="modal">Close</button> </div>
      </div>
  </div>
</div>
