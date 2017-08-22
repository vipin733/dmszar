{{ Form::model($appdetail, ['method' => 'delete', 'route' => ['app_details_delete',$appdetail->id,strtotime($appdetail->created_at)], 'class' =>'form-inline form-delete','style'=>'display: inline;']) }}
 {{Form::hidden('id', $appdetail->id)}}
 {{Form::hidden('created_at', strtotime($appdetail->created_at))}}
 <button type="submit" name="delete_modal" class="btn btn-danger btn-sm"><i class="fa fa-trash-o" aria-hidden="true"></i></button>
 {{Form::close()}}

 @include('staff.add.destroy_modal')