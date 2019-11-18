<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Topic extends Model
{
    protected $guarded = [];
   

    public function user()
    {
        //belongsTo un topic est crée par un user
        // Un topic appartient à un user
        return $this->belongsTo('App\User');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\MorphMany
     */
    public function comments()
    {
        return $this->morphMany('App\Comment', 'commentable')->latest();
    }
}
