
<!-- Modal -->
<div class="modal fade" id="d{{$homework->id}}" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title" id="myModalLabel">Delete Homework</h4>
      </div>
      <div class="modal-body">
          
        <form method="POST" action="/teacher/student/{{$homework->id}}/homework_delete" data-parsley-validate ="">
        {{ csrf_field() }} {{ method_field("DELETE") }} 

        <h1 class="text-center">Are you sure want to delete?</h1>            
                 
      </div>
      <div class="modal-footer">
          <button type="submit" class="btn btn-danger">Delete</button>
          <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
      </div>
      </form>  
    </div>
  </div>
</div>

