<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Ads extends Model
{
    protected $table = 'ads';
    protected $fillable =['user_id','name', 'size', 'description','url','file_name', 'type'];
}
