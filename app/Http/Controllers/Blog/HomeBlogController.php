<?php

namespace App\Http\Controllers\Blog;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Model\Blog\Blog;

class HomeBlogController extends Controller
{
    

    public function index()
   {
   	   $blogs = Blog::where('published',1)->with('blogcategories','blogger')->latest()->paginate(9);

   	  // return $blogs;  	  

   	  return view('blog.blog_home',compact('blogs'));
   }

   public function blog_show($id= null,$slug = null)
   {
   	  $blog = Blog::where(function($q) use($id,$slug){
                        $q->where('id',$id)
                        ->where('slug',$slug)
                        ->where('published',1);
   	                   })->with('blogcategories','blogger')
   	                   ->first();

         $limit = strip_tags($blog->body);

   	  return view('blog.show_blog',compact('blog','limit'));
   }

 


}
