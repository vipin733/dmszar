<div class="modal fade" tabindex="-1" role="dialog" id="{{$fee->id}}" aria-labelledby="gridSystemModalLabel">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>

      </div>
      <div class="modal-body">

        <div class="panel panel-default">
            <div class="panel-heading"><button class="btn btn-primary btn-block">Registration Fee Edit Form</button></div>
            <div class="panel-body">
                <form method="post" action="/acadmic/registraion_fee/{{$fee->id}}/{{strtotime($fee->created_at)}}/edit" data-parsley-validate ="">
                  {{ csrf_field() }} {{ method_field('PATCH') }}
                    <div class="form-group">
	                  <label for="course">Select Course :</label>
	                   <select class="form-control" id="course" name="course" required="">
	                     <option value="{{ $fee->course_id }}">{{$fee->courses['name']}}</option>
	                  </select>
	                </div>

	                <div class="form-group">
	                  <label for="registraion_fee">Registration Fee :</label>
	                  <input type="text" class="form-control" id="registraion_fee" name="registraion_fee" value="{{ old('registraion_fee', $fee->registraion_fee) }}" placeholder="Fee" required="" data-parsley-type="number">
	                </div>

	                <div class="form-group">
	                  <label for="late_fee">Late Fee :</label>
	                  <input type="text" class="form-control" id="late_fee" name="late_fee" value="{{ old('late_fee', $fee->late_fee) }}" placeholder="Late Fee" data-parsley-type="number">
	                </div>

	                <div class="form-group">
	                 <label for="fee_details">Fee Details :</label>
	                 <textarea class="form-control" rows="3" name="fee_details" required="">{{ old('fee_details', $fee->fee_details) }}</textarea>
	                </div>

	                <div class="form-group">
	                 <label for="remarks">Remarks :</label>
	                 <textarea class="form-control" rows="3" name="remarks" >{{ old('remarks', $fee->remarks) }}</textarea>
	                </div>

	                <div class="form-group">
	                  <button type="submit" class="btn btn-primary btn-lg btn-block"><i class="fa fa-plus faa-flash animated" aria-hidden="true"></i> Submit</button>
	                </div>
              </form>
            </div>
          </div>

      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
      </div>
    </div><!-- /.modal-content -->
  </div><!-- /.modal-dialog -->
</div>
