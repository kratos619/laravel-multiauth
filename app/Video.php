<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Video extends Model
{
    
    return $this->morphToMany('App\Tag','taggable');
}
