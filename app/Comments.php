<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Comments extends Model
{

    // commentable name is same as column name in comments table
    public function commentable()
    {
        return $this->morphTo();
    }
}
