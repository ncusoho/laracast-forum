<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\App;

class Reply extends Model
{
    protected $guarded = [];

    public function owner()
    {
        return $this->belongsTo('App\User', 'user_id');
    }

    public function favorites()
    {
        return $this->morphMany('App\Favorite', 'favorited');
    }

    public function favorite()
    {
        $attributes = [
            'user_id' => auth()->id(),
        ];
        if ( ! $this->favorites()->where($attributes)->exists()) {
            $this->favorites()->create($attributes);
        }
    }

    public function isFavorited()
    {
        $attributes = [
            'user_id' => auth()->id(),
        ];

        return $this->favorites()->where($attributes)->exists();
    }
}
