<?php

namespace App\Http\Controllers\SuperAdmin\Blog;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Intervention\Image\ImageManagerStatic as Image;
use Illuminate\Support\Facades\Storage;
use Carbon\Carbon;
use App\Model\Blog\Blog;
use Auth;

class SuperAdminBlogController extends Controller
{
    public function __construct()
    {
	  
        $this->middleware(['auth:superadmin']); 

    }

    public function index()
    {
    	 $blogs = Blog::with('blogcategories','blogger')->latest()->paginate(10);

    	return view('superadmin.blog.index_blog',compact('blogs'));
    }

    public function show($id= null,$slug = null)
    {
    	 $blog = Blog::where('id',$id)->where('slug',$slug)->with('blogcategories','blogger')->first();

       //return $blog;

    	return view('superadmin.blog.show_blog',compact('blog'));
    }

    public function create()
    {

     	return view('superadmin.blog.create_blog');
     	
    }


    public function store(Request $request)
    {
      
      $this->validate($request,[
            'title'            =>      'required',
            'category'         =>      'required|integer',
            'blog_image'       =>      'nullable|image|max:10240',
            'body'             =>      'required'
        ]);

     // return $request->all();

      if ($request->hasFile('blog_image')) {
          
        $filename = time() . ".jpg";
        $id = Auth::id();
        $blog_image  ='https://s3.ap-south-1.amazonaws.com/dbmszar/blog_image'.'/'.$id.'/'. $filename;
        $image = Image::make($request->file('blog_image'));
        $image->encode('jpg');
        Storage::disk('s3')->put("blog_image/$id/$filename", $image->__toString());
          }else{
          	$blog_image = null;
          }


           $data = [
	        'blog_category_id' => $request->category,
	        'blog_image'       => $blog_image,
	        'title'            => $request->title,
	        'body'             => $request->body,
	        'slug'             => str_slug($request->title, "-"),
        ];

        Auth::user()->blogs()->create($data);

        flash()->success('Successfully Blog Created, take "Review" then published');

        return redirect()->to('/superadmin/blog/index');
     	
    }

      public function edit($id= null,$slug = null)
    {
    	 $blog = Blog::where('id',$id)->where('slug',$slug)->with('blogcategories','blogger')->first();

    	return view('superadmin.blog.edit_blog',compact('blog'));
    }


     public function update(Request $request,$id= null,$slug = null)
    {
      
      $this->validate($request,[
            'title'            =>      'required',
            'category'         =>      'required|integer',
            'blog_image'       =>      'nullable|image|max:10240',
            'body'             =>      'required'
        ]);

       $blog = Blog::where('id',$id)->where('slug',$slug)->first();

      if ($request->hasFile('blog_image')) {
          
        $filename = time() . ".jpg";
        $id = Auth::id();
        $blog_image  ='https://s3.ap-south-1.amazonaws.com/dbmszar/blog_image'.'/'.$id.'/'. $filename;
        $image = Image::make($request->file('qr_code'));
        $image->encode('jpg');
        Storage::disk('s3')->put("blog_image/$id/$filename", $image->__toString());
          }else{
          	$blog_image =  $blog->blog_image;
          }


           $data = [
	        'blog_category_id' => $request->category,
	        'blog_image'       => $blog_image,
	        'title'            => $request->title,
	        'body'             => $request->body,
	        'slug'             => str_slug($request->title, "-"),
        ];

       $blog->update($data);

        flash()->success('Successfully Blog updated!');

        return redirect()->to('/superadmin/blog/index');
     	
    }

     public function delete($id= null,$slug = null)
    {

       $blog = Blog::where('id',$id)->where('slug',$slug)->first(); 

        $blog->delete();      

        flash()->success('Successfully blog dleted!');

        return redirect()->to('/superadmin/blog/index');
     	
    }

     public function published($id= null,$slug = null)
    {

       $blog = Blog::where('id',$id)->where('slug',$slug)->first(); 

       if ($blog->published == 0) {

       	   $data = [
       	      'published' => 1,
       	      'published_at' => Carbon::now()
       	   ];

       	 $blog->update($data); 

        flash()->success('Successfully blog published!');
          	
         }else{
         	$data = [
       	      'published' => 0,
       	      'published_at' => Carbon::now()
       	   ];

       	    $blog->update($data); 

            flash()->success('Successfully blog unpublished!');
         }  

        return redirect()->to('/superadmin/blog/index');
     	
    }
}
