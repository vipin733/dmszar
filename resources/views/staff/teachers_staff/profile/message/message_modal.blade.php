
<!-- Modal -->
<div class="modal fade" id="m" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title" id="myModalLabel">Send Message</h4>
      </div>
      <div class="modal-body">

        <form method="post" action="/teacher/{{$teacher->reg_no}}/message" data-parsley-validate ="">
        {{ csrf_field() }}
          <div class="form-group">
            <label for="message-text" class="control-label">Message</label>
            <textarea class="form-control" name="message" required="" maxlength="160"></textarea>
          </div>
          <p>Max 160</p>
        </div>
          <div class="modal-footer">
            <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
            <button type="submit" class="btn btn-primary">Send message</button>
          </div>
        </form>
    </div>
  </div>
</div>
