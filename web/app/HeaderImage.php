<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class HeaderImage extends Model
{
    protected $table = 'header_image';
    protected $fillable = ['post_id','name','size','type'];
}
