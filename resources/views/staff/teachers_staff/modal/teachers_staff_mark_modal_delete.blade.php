
 <form action="/st/teacher_staff/take_attendence/{{$teacher->uuid}}/{{$teacher->reg_no}}/{{$attendence->id}}/delete" method="post" data-parsley-validate ="" class="form-inline form-delete" style="display: inline;">
               {{ csrf_field() }} {{ method_field('DELETE') }}
		<button type="submit" name="delete_modal" class="btn btn-danger btn-xs"><i class="fa fa-trash-o" aria-hidden="true"></i></button>
</form>

 @include('staff.add.destroy_modal')