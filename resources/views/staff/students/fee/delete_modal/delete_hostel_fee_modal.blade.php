{{ Form::model($hostelfee, ['method' => 'delete', 'route' => ['hostel.destroy',$hostelfee->id,strtotime($hostelfee->created_at),$hostelfee->students->reg_no,$hostelfee->students->uuid], 'class' =>'form-inline form-delete','style'=>'display: inline;']) }}
{{Form::hidden('id', $hostelfee->id)}}
<button type="submit" name="delete_modal" class="btn btn-danger btn-xs"><i class="fa fa-trash-o" aria-hidden="true"></i>
</button>
{{Form::close()}}
@include('staff.add.destroy_modal')