<button type="button" class="btn btn-primary btn-xs" data-toggle="modal" data-target="#e{{$event->id}}"><i class="fa fa-eye" aria-hidden="true"></i>
</button>

<!-- Modal -->
<div class="modal fade" id="e{{$event->id}}" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
  <div class="modal-dialog modal-lg" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title" id="myModalLabel">Event Details</h4>
      </div>
      <div class="modal-body">
         
        <div class="table-responsive">
          <table class=" table table-bordered  table-hover">
            <thead > 

              <tr>
                <th class="text-center col-sm-3">Event Title</th>
                <td>{{ $event->title }}</td>
              </tr>

              <tr>
                <th class="text-center col-sm-3">Event Description</th>
                <td>{{ $event->event_body }}</td>
              </tr>

              <tr>
                <th class="text-center col-sm-3">Event Created At</th>
                <td>{{  $event->created_at->format('d/m/Y') }}</td>
              </tr>

              <tr>
                <th class="text-center col-sm-3">Event Start At</th>
                <td>{{  $event->start->format('d/m/Y h:i A') }}</td>
              </tr>

              <tr>
                <th class="text-center col-sm-3">Event End At</th>
                <td>{{  $event->end->format('d/m/Y h:i A') }}</td>
              </tr>

              <tr>
                <th class="text-center col-sm-3">Event Created By</th>
                <td>{{  $event->creater->name }}</td>
              </tr> 

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