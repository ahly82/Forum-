<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;

class Reply extends Model
{
    protected $guarded = [];

    public function owner()
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    public function thread()
    {
        return $this->belongsTo(Thread::class, 'thread_id');
    }

    public function favourites()
    {
//        morphMany => dynamic (class type , class id)
        return $this->morphMany(Favourite::class, 'favourited');
    }

    public function favourite($userId)
    {

        $attributes = ['user_id' => $userId];

        if (!$this->favourites()->where($attributes)->exists()) {
            return $this->favourites()->create($attributes);
        }
    }

        public function isFavourited()
        {
            return $this->favourites()->where('user_id',Auth::id())->exists();
        }

}
