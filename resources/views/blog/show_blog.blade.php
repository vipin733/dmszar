@extends('product.layouts.layouts')
@section('title')
{{$blog->title}}
@stop
@section('description'){{ str_limit($limit, 100) }}@stop

@section('auther'){{ $blog->blogger->name  }}@stop

@section('css')
 <style type="text/css">
.blog-entry-wrapper .blog-entry .blog-entry-heading {
  margin-bottom: 60px;
  position: relative;
  height: 500px;
  background: #253340 url('{{$blog->blog_image}}') no-repeat 50% top;
  -webkit-background-size: cover;
  -moz-background-size: cover;
  -o-background-size: cover;
  background-size: cover;
  color: #fff;
}

 </style>
@stop
@section('content')    
    <div class="wrapper">
             
        <div class="blog-entry-wrapper"> 

            <div class="blog-entry">                 
                <article class="post">
                    <header class="blog-entry-heading">
                        <div class="container text-center">
                            <h1 class="title">{{$blog->blogcategories['name']}}</h1>                        
                            <h2 class="title">{{$blog->title}}</h2>
                            <div class="meta">
                                <ul class="meta-list list-inline">                                       
                                	<li class="post-time">{{ $blog->published_at->format('jS  F, Y  g:i A') }}</li>
                                	<li class="post-author"> by <a href="#">{{ $blog->blogger->name }}</a></li>
                            	</ul><!--//meta-list-->    	
                            </div><!--meta-->
                        </div><!--//container-->
                        
                    </header><!--//blog-entry-heading-->

                    <div class="container">
                        <div class="row">
                            <div class="blog-entry-content col-md-8 col-sm-10 col-xs-12  col-md-offset-2 col-sm-offset-1 col-xs-offset-0">
                                
                                {!! $blog->body !!}

                                                            
                            </div><!--//blog-entry-content-->
                           
                            
                                   				           				
                        </div><!--//row-->
                    </div><!--//container-->                                               
                </article><!--//post-->  

                  <div class="sharethis-inline-share-buttons"></div>
                                                      
            </div><!--//blog-entry-->
        </div><!--//blog-entry-wrapper-->  
    </div><!--//wrapper-->


    
@stop
    
@section('script')
  
    <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/jquery.imagesloaded/4.1.3/imagesloaded.pkgd.min.js"></script>     
    <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/masonry/4.2.0/masonry.pkgd.min.js"></script> 
    <script type="text/javascript" src="/js/blog.js"></script>
@stop

