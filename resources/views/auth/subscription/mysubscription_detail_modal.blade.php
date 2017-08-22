

<!-- Modal -->
<div class="modal fade" id="update" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title" id="myModalLabel">Update Plan</h4>
      </div>
      <div class="modal-body">
        <div class="row">
         <div class="col-md-6 col-md-offset-3">
            <form action="/auth/plan/update" method="post" data-parsley-validate ="">
             {{ csrf_field() }} {{ method_field('PATCH') }}
                <div class="form-group">
                  <label for="plan" class="control-label">Select Plan</label>

                      <select name="plan" class="form-control" required="">
                          <option value="">--Select Plan</option>
                           @if($user->plan == 0)
                            <option value="1">Professional</option>
                           @else
                            <option value="0">Basic</option>
                           @endif 
                      </select>
                </div>
                <div class="form-group">
                <button type="submit" class="btn btn-primary btn-block">Submit</button>
              </div>
            </form>
          </div>
         </div>
      </div>
      <div class="modal-footer">
      <button type="button" class="btn btn-default" data-dismiss="modal">Close</button> </div>
      </div>
  </div>
</div>
