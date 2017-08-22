<button type="button" class="btn btn-warning btn-sm" data-toggle="modal" data-target="#c{{$stopeage->id}}"><i class="fa fa-pencil-square-o" aria-hidden="true"></i>
</button>

<!-- Modal -->
<div class="modal fade" id="c{{$stopeage->id}}" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title" id="myModalLabel">Update stoppage details</h4>
      </div>
      <div class="modal-body">
          
        <form method="POST" action="{{ route('stopages.update',$stopeage->id) }}" data-parsley-validate ="">
        {{ csrf_field() }} {{ method_field('PATCH') }}

          <div class="form-group">
            <label class="control-label" for="name">Stoppage Name:</label>
            <input type="text" class="form-control" value="{{ old('name',$stopeage->name) }}" name="name" id="name" required="">
          </div>
          <div class="form-group">
             <label class="control-label" for="bus_detail">Bus(select bus which suitable for this stoppage)</label>
                <select  id="bus_detail" class="form-control" name="bus_detail" >
                    <option value="{{ $stopeage->buses->id }}">{{ $stopeage->buses['name'] }} </option>
                    @foreach($busdetails as $key=>$value)
                      <option value="{{ $key }}">{{ $value }}</option>
                    @endforeach
                </select>
            </div>
            <div class="form-group">
              <label class="control-label" for="remarks">Remarks:</label>
              <textarea type="text" class="form-control" placeholder="" name="remarks" id="remarks" >{{ old('remarks',$stopeage->remarks) }}</textarea>
          </div>
          
          <div class="form-group">
           <button type="submit" class="btn btn-primary btn-block"><i class="fa fa-plus faa-flash animated" aria-hidden="true"></i> Add Stoppage Details</button>
          </div>
         
        </form>    
       
      </div>
      <div class="modal-footer">
          <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
      </div>
    </div>
  </div>
</div>

