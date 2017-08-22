@extends('layouts.app')
@section('nav')
@include('superadmin.layouts.superadmin_nav')
@stop
@section('content')

    <div class="row">

       <div class="col-md-10 col-md-offset-1"> 

            <div class="panel panel-default">
                <div class="panel-heading">             
                 <button class="btn btn-primary btn-block">All Blog</button>
                </div>
                <div class="panel-body">
                   @foreach($blogs as $blog)
                     <h5><b>{{ $blog->blogcategories['name'] }}</b></h5>
                     <h3><a href="/superadmin/blog/{{ $blog->id }}/{{ $blog->slug }}">{{ $blog->title }}</a></h3><br>
                     <p class="pull-left">
                     	<b>@if($blog->published == 1)
                     	Published
                     	@else
                     	Unpublished
                     	@endif
                        </b>
                     </p>
                     <p  class="pull-right">Created at {{ $blog->created_at->format('d/m/Y H:i A') }}</p>
                     <p> Created By {{ $blog->blogger->name }}</p>

                   @endforeach
                </div>

                 {{ $blogs->links() }}
            </div>    

       </div>

    </div>


@stop    