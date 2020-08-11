<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Post extends Model
{
    public function likes()
    {
        return $this->hasMany('App\Like');
    }

    public function isLikedByLoggedInUser()
    {
        return $this->likes->where('user_id', auth()->user()->id)->isEmpty() ? false : true;
    }
}
