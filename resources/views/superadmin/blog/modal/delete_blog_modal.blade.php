{{ Form::model($blog, ['method' => 'delete', 'route' => ['blog.delete',$blog->id,$blog->slug], 'class' =>'form-inline form-delete','style'=>'display: inline;']) }}
{{Form::hidden('id', $blog->id)}}
<button type="submit" name="delete_modal" class="btn btn-danger"><i class="fa fa-trash-o" aria-hidden="true"></i> DELETE
</button>
{{Form::close()}}
@include('superadmin.blog.modal.destroy_modal_blog')