{{ Form::model($transportfee, ['method' => 'delete', 'route' => ['transport.destroy',$transportfee->id,strtotime($transportfee->created_at),$transportfee->students->reg_no,$transportfee->students->uuid], 'class' =>'form-inline form-delete','style'=>'display: inline;']) }}
{{Form::hidden('id', $transportfee->id)}}
<button type="submit" name="delete_modal" class="btn btn-danger btn-xs"><i class="fa fa-trash-o" aria-hidden="true"></i>
</button>
{{Form::close()}}
@include('staff.add.destroy_modal')