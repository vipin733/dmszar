{{ Form::model($blog, ['method' => 'patch', 'route' => ['blog.published',$blog->id,$blog->slug], 'class' =>'form-inline form-delete','style'=>'display: inline;']) }}
{{Form::hidden('id', $blog->id)}}
<button type="submit" name="delete_modal" class="btn btn-waring"><i class="fa fa-trash-o" aria-hidden="true"></i>
   @if($blog->published == 0)
             	Published
             	@else
             	Unpublished
             	@endif
</button>
{{Form::close()}}
@include('superadmin.blog.modal.pubunpub_modal_blog')