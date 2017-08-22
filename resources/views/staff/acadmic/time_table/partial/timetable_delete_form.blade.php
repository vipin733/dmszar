{{ Form::model($timetable, ['method' => 'delete', 'route' => ['timetable.destroy',$timetable->id], 'class' =>'form-inline form-delete','style'=>'display: inline;']) }}
<button type="submit" name="delete_modal" class="btn btn-danger btn-sm"><i class="fa fa-trash-o" aria-hidden="true"></i>
</button>
{{Form::close()}}
@include('staff.add.destroy_modal')