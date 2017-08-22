@extends('layouts.app')
@section('nav')
@include('superadmin.layouts.superadmin_nav')
@stop
@section('content')

    <div class="row">

       <div class="panel panel-default">
            <div class="panel-heading">
             <button class="btn btn-primary btn-block">Blog</button>
            </div>
            
            <div class="panel-body">
                <table class="table table-bordered  table-hover" data-form="deleteForm">
                     <a href="#" class="thumbnail"> 
                        <img src="{{$blog->blog_image}}" alt="{{ Auth::user()->name }}" class="img-responsive img-rounded">
                    </a>
                      <h3>{{$blog->title}}</h3><br>
                      <p class="pull-left">
                     	@if($blog->published == 1)
                     	Published
                     	@else
                     	Unpublished
                     	@endif
                     </p>
                     <p>Created at {{ $blog->created_at->format('d/m/Y H:i A') }}</p>
                     <p>Created By {{ $blog->blogger->name }}</p>
                     <div>
                     	{!! $blog->body !!}
                     </div>

                     <div class="text-center">
                     	<a class="btn btn-primary" href="/superadmin/blog/{{$blog->id}}/{{$blog->slug}}/edit">Edit</a>
                     	@include('superadmin.blog.modal.pubunpub_blog_modal')
                     	@include('superadmin.blog.modal.delete_blog_modal')
                     </div>
                </table>     
            </div>
        </div>        

    </div>

@stop    


@section('script')
@include('superadmin.blog.modal.destroy_modal_javascript_blog')
@endsection
