<?php

namespace App\Model\Blog;

use Illuminate\Database\Eloquent\Model;
use App\Model\SuperAdmin\SuperAdmin;
use App\Model\Blog\BlogCategory;

class Blog extends Model
{
     protected $fillable = [
        
      'blogger_id', 'blog_category_id','blog_image','title','body','published','published_at','slug'
    ];

     protected $dates = ['published_at'];

    public function blogger()
    {
        return $this->belongsTo(SuperAdmin::class,'blogger_id');
    }

    public function blogcategories()
    {
        return $this->belongsTo(BlogCategory::class,'blog_category_id');
    }

}
