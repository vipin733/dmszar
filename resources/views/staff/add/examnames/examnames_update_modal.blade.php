<button type="button" class="btn btn-warning btn-sm" data-toggle="modal" data-target="#c{{$examname->id}}"><i class="fa fa-pencil-square-o" aria-hidden="true"></i>
</button>

<!-- Modal -->
<div class="modal fade" id="c{{$examname->id}}" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title" id="myModalLabel">Update exam name detials</h4>
      </div>
      <div class="modal-body">
          
        <form method="POST" action="{{ route('examnames.update',$examname->id) }}" data-parsley-validate ="">
        {{ csrf_field() }} {{ method_field('PATCH') }}

          <div class="form-group">
            <label class="control-label" for="name">Exam Name</label>
            <input type="text" class="form-control" placeholder="" value="{{ old('name',$examname->name) }}" name="name" id="name" required="">
          </div>

          <div class="form-group">
              <label class="control-label" for="max_mark">Max Mark</label>
                <input type="text" class="form-control" name="max_mark" id="max_mark" value="{{ old('max_mark',$examname->max_mark) }}" required="">
          </div>

          <div class="form-group">
            <label class="control-label" for="remarks">Remarks</label>
            <textarea type="text" class="form-control" placeholder="" name="remarks" id="remarks">{{ old('remarks',$examname->remarks) }}</textarea>
          </div>
          
          <div class="form-group">
           <button type="submit" class="btn btn-primary  btn-block"><i class="fa fa-plus faa-flash animated" aria-hidden="true"></i> Update Exam Name</button>
          </div>
         
        </form>    
       
      </div>
      <div class="modal-footer">
          <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
      </div>
    </div>
  </div>
</div>

