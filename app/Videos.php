<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Videos extends Model
{
    public function comments()
    {
        return $this->morphMany('App\Comments', 'commentable');
    }
}
