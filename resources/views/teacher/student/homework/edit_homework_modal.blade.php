<!-- Modal -->
<div class="modal fade" id="c{{$homework->id}}" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title" id="myModalLabel">Update Homework Form</h4>
      </div>
      <div class="modal-body">
          
        <form method="POST" action="/teacher/student/{{$homework->id}}/homework_update" data-parsley-validate ="">
        {{ csrf_field() }} {{ method_field('PATCH') }}

              <div class="form-group">
                <label for="homework">Homework Details</label>
                <textarea type="text" class="form-control" id="homework" name="homework" required="">{{ old('homework',$homework->homework) }}</textarea>
              </div>

              <div class="form-group">
                <label for="remarks">Remarks(if any)</label>
                <textarea type="text" class="form-control" id="remarks" name="remarks">{{ old('remarks',$homework->remarks) }}</textarea>
              </div>
               
              <div class="form-group">
                <label for="submission_date_time">Submission Date Time</label>
                <input class="form-control" id="submission_date_time_edit" name="submission_date_time" value="{{ old('submission_date_time',$homework->submit_at->format('d/m/Y h:i A')) }}" required=""></input>
              </div>
          
              <div class="col-sm-6 col-sm-offset-3">
                <button class="btn btn-success btn-block">Submit</button>
              </div>              
         
        </form>    
       
      </div>
      <div class="modal-footer">
          <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
      </div>
    </div>
  </div>
</div>

