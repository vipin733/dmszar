{{ Form::model([$subject,$teacher], ['method' => 'delete', 'route' => ['teacher_subject_delete',$subject->id,$teacher->id], 'class' =>'form-inline form-delete','style'=>'display: inline;']) }}
<button type="submit" name="delete_modal" class="btn btn-danger btn-xs"><i class="fa fa-trash-o" aria-hidden="true"></i>
</button>
{{Form::close()}}
@include('staff.add.destroy_modal')