<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class pdf extends Model
{
    protected $table = 'pdf';
    protected $fillable = ['user_id','name','size','type', 'description', 'title','image_url'];
}
