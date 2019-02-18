<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Blogs extends Model
{
    public function comments()
    {
        return $this->morphMany('App\Comments', 'commentable');
    }
}
