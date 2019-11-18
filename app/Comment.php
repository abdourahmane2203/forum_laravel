<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Comment extends Model
{
    protected $guarded = [];

    /**
     * @return \Illuminate\Database\Eloquent\Relations\MorphTo
     * Comment a plusieurs parents
     */
    public function commentable()
    {
        return $this->morphTo();
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\MorphMany
     * Commentaire commentable
     */
    public function comments()
    {
        return $this->morphMany('App\Comment', 'commentable')->latest();
    }

    public function user()
    {
        return $this->belongsTo('App\User');
    }
}
