<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Profile extends Model
{
    //4
    protected $guarded = [];

    // protected $casts = [
    //     'posts' => 'array'
    // ];

    public function user(){
        return $this->belongsTo(User::class);
    }

    // public function posts(){
    //     return $this->hasMany(Post::class);
    // }
}
