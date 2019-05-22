<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class BlogComment extends Model
{
     protected $table = 'blog_comment';
    protected $fillable = ['name','email','message','website','blog_id'];
}
