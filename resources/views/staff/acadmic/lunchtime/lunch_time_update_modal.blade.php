<button type="button" class="btn btn-warning btn-sm" data-toggle="modal" data-target="#lunch_edit"><i class="fa fa-pencil-square-o" aria-hidden="true"></i>
</button>

<!-- Modal -->
<div class="modal fade" id="lunch_edit" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
  <div class="modal-dialog modal-lg" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title" id="myModalLabel">Update School Lunch Time</h4>
      </div>

      <div class="modal-body">
          
         <form method="post" action="/staff/acadmic/{{$lunchtime->id}}/school_break_update" data-parsley-validate ="">
                {{ csrf_field() }} {{ method_field('PATCH') }}

          <div class="table-responsive">
            <table class=" table table-bordered  table-hover">
              <thead>
                <tr>
                  <th class="text-center">Start</th>
                  <td class="text-center">
                      <input type="text" class="form-control text-center" id="start" name="start" value="{{ old('start',$lunchtime->start->format('h:i A')) }}" required="" />
                  </td>
                  <th class="text-center">End</th>
                  <td class="text-center">
                     <input type="text" class="form-control text-center" id="end" name="end" value="{{ old('end',$lunchtime->end->format('h:i A')) }}" required="" />
                  </td>
                </tr>
              </thead>
            </table>
          </div>  

          <div class="col-sm-6 col-sm-offset-3">
            <button type="submit" class="btn btn-primary btn-block">Submit</button>
          </div>  

        </form>
       
      </div>

      <div class="modal-footer ">
          <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
      </div>
       </form>
    </div>
  </div>
</div>
