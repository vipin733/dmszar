<button type="button" class="btn btn-primary btn-sm" data-toggle="modal" data-target="#bus{{$stopeage->id}}">{{ $stopeage->buses['name'] }}
</button>

<!-- Modal -->
<div class="modal fade" id="bus{{$stopeage->id}}" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title text-center" id="myModalLabel">Stoppage bus details</h4>
      </div>
      <div class="modal-body">
        
        <div class="table-responsive">
            <table class=" table table-bordered  table-hover" id="users">
              <thead>
                <tr>
                  <th class="text-center">Bus Name</th>
                  <td>{{ $stopeage->buses['name'] }}</td>
                </tr>
                <tr>
                  <th class="text-center">Bus No.</th>
                  <td>{{ $stopeage->buses['bus_no'] }}</td>
                </tr> 
                <tr>
                  <th class="text-center">Remarks</th>
                  <td>{{ $stopeage->buses['remarks'] }}</td>
                </tr> 
              </thead>
               <tbody>
               </tbody>
            </table>
        </div>
        
      </div>
      <div class="modal-footer">
      <button type="button" class="btn btn-default" data-dismiss="modal">Close</button> </div>
      </div>
  </div>
</div>
