<button type="button" class="btn btn-primary btn-sm" data-toggle="modal" data-target="#c{{$homework->id}}"><i class="fa fa-eye fa-lg faa-pulse animated" aria-hidden="true"></i>
</button>

<div class="modal fade" id="c{{$homework->id}}" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
  <div class="modal-dialog modal-lg" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title" id="myModalLabel">Homework</h4>
      </div>
      <div class="modal-body">
          
        <div class="table-responsive">
          <table class=" table table-bordered  table-hover">
            <thead > 

              <tr>
                <th class="text-center col-sm-3">Given At</th>
                <td>{{ $homework->created_at->format('d/m/Y h:i A') }}</td>
              </tr>

              <tr>
                <th class="text-center col-sm-3">Submission DateTime</th>
                <td>{{ $homework->created_at->format('d/m/Y h:i A') }}</td>
              </tr>

              <tr>
                <th class="text-center col-sm-3">Given By</th>
                <td>{{ $homework->teachers['name'] }}</td>
              </tr>

              <tr>
                <th class="text-center col-sm-3">Subject</th>
                <td>{{ $homework->subjects['name'] }}</td>
              </tr>

              <tr>
                <th class="text-center col-sm-3">Session</th>
                <td>{{ $homework->asessions['name'] }}</td>
              </tr>

              <tr>
                <th class="text-center col-sm-3">Homework</th>
                <td>{{$homework->homework}}</td>
              </tr> 

              @if($homework->remarks)                      
                <tr>
                    <th class="text-center col-sm-3">Remarks</th>
                    <td>{{$homework->remarks}}</td>
                </tr>
              @endif

            </thead>      
          </table>                       
        </div>
       
      </div>
      <div class="modal-footer">
          <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
      </div>
    </div>
  </div>
</div>

