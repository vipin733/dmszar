{{ Form::model($registraionfee, ['method' => 'delete', 'route' => ['registration.destroy',$registraionfee->id,strtotime($registraionfee->created_at),$registraionfee->students->reg_no,$registraionfee->students->uuid], 'class' =>'form-inline form-delete','style'=>'display: inline;']) }}
{{Form::hidden('id', $registraionfee->id)}}
<button type="submit" name="delete_modal" class="btn btn-danger btn-xs"><i class="fa fa-trash-o" aria-hidden="true"></i>
</button>
{{Form::close()}}
@include('staff.add.destroy_modal')