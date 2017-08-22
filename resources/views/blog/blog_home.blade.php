@extends('product.layouts.layouts')
@section('title')
Blog DMSZar
@stop
@section('css')
 <style type="text/css">
 <?php $i = 0 ?>
    @foreach ($blogs->slice(0, 4) as $blog)       
<?php $i++ ?>
.blog-slider .slide.slide-{{$i}} {
  background: #253340 url('{{$blog->blog_image}}') no-repeat 50% top;
  -webkit-background-size: cover;
  -moz-background-size: cover;
  -o-background-size: cover;
  background-size: cover;
}
@endforeach
 </style>
@stop
@section('content')  
   <div class="wrapper">
           
        
        <section class="featured-blog-posts section">       
       
            <div class="flexslider blog-slider">
                <ul class="slides">
                     <?php $i = 0 ?>
                    @foreach ($blogs->slice(0, 4) as $blog)       
                     <?php $i++ ?>
                        <li class="slide slide-{{$i}}">
                            <div class="flex-caption container">
                                <h3 class="title"><a href="/blog/{{$blog->id}}/{{$blog->slug}}">{{ $blog['title'] }}</a></h3>
                                <div class="meta">{{ $blog->published_at->format('jS  F, Y  g:i A') }}</div>
                                <a class="more-link" href="/blog/{{$blog->id}}/{{$blog->slug}}">Read more &rarr;</a>
                            </div><!--//flex-caption-->
                        </li>
                        
                    @endforeach
                </ul><!--//slides-->
            </div><!--//flexslider-->
                    
        </section><!--//featured-blog-posts-->
        
        <!-- ******BLOG LIST****** --> 
        <div class="blog container">
            <div class="row">
                <div id="blog-mansonry" class="blog-list">

                 @foreach ($blogs as $blog) 
                    
                    <article class="post col-md-4 col-sm-6 col-xs-12">
                        <div class="post-inner">
                            <figure class="post-thumb">
                                <a href="/blog/{{$blog->id}}/{{$blog->slug}}"><img class="img-responsive" src="{{$blog->blog_image}}" alt="" /></a>                                
                            </figure><!--//post-thumb-->
                            <div class="content">
                                <h3 class="post-title"><a href="/blog/{{$blog->id}}/{{$blog->slug}}">{{ $blog['title'] }}</a></h3>
                                <div class="post-entry">
                                    <p> {!! mb_strimwidth($blog->body, 0, 300, ".") !!}

                                   </p>
                                    <a class="read-more" href="/blog/{{$blog->id}}/{{$blog->slug}}">Read more <i class="fa fa-long-arrow-right"></i></a>
                                </div>
                                <div class="meta">
                                    <ul class="meta-list list-inline">                                       
                                        <li class="post-time post_date date updated">{{ $blog->published_at->format('jS  F, Y') }}</li>
                                        <li class="post-author"> by <a href="#">{{ $blog->blogger->name }}</a></li>
                                        
                                    </ul><!--//meta-list-->                             
                                </div><!--meta-->
                            </div><!--//content-->
                        </div><!--//post-inner-->
                    </article><!--//post-->

                  @endforeach  
                                                            
                </div><!--//blog-list-->  
            </div><!--//row-->
            {{ $blogs->links() }}
        </div><!--//blog-->        
    </div><!--//wrapper-->
 
    <!-- Javascript -->             
    
@stop

@section('script')
 <!-- blog specific js starts -->

    <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/jquery.imagesloaded/4.1.3/imagesloaded.pkgd.min.js"></script>     
    <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/masonry/4.2.0/masonry.pkgd.min.js"></script> 
    <script type="text/javascript" src="/js/blog.js"></script>
    <!-- blog specific js ends -->  
@stop