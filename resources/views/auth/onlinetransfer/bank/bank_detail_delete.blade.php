{{ Form::model($bankdetail, ['method' => 'delete', 'route' => ['bank_details_delete',$bankdetail->id,strtotime($bankdetail->created_at)], 'class' =>'form-inline form-delete','style'=>'display: inline;']) }}
 {{Form::hidden('id', $bankdetail->id)}}
 {{Form::hidden('created_at', strtotime($bankdetail->created_at))}}
 <button type="submit" name="delete_modal" class="btn btn-danger btn-sm"><i class="fa fa-trash-o" aria-hidden="true"></i></button>
 {{Form::close()}}

 @include('staff.add.destroy_modal')