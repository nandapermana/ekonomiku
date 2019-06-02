<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Post extends Model
{
    protected $table = 'post';
    protected $fillable = ['user_id','title','body','image_url'];

    public function headerImage()
    {
    	return $this->hasMany('App\HeaderImage','post_id');
    }

    public function getOnlyImage(){
    	return $this->hasOne('App\HeaderImage');
    }
}
