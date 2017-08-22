{{ Form::model($tutionfee, ['method' => 'delete', 'route' => ['tution.destroy',$tutionfee->id,strtotime($tutionfee->created_at),$tutionfee->students->reg_no,$tutionfee->students->uuid], 'class' =>'form-inline form-delete','style'=>'display: inline;']) }}
{{Form::hidden('id', $tutionfee->id)}}
<button type="submit" name="delete_modal" class="btn btn-danger btn-xs"><i class="fa fa-trash-o" aria-hidden="true"></i>
</button>
{{Form::close()}}
@include('staff.add.destroy_modal')