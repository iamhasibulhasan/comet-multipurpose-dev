<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Post extends Model
{
    use HasFactory;
    protected $guarded = [];

//    User Model Relationship[one to one]
    public function user(){
        return $this->belongsTo('App\Models\User');
    }
//    Categories relationship [many to many]
    public function categories(){
        return $this->belongsToMany('App\Models\Category');
    }
//    Tags relationship [many to many]
    public function tags(){
        return $this->belongsToMany('App\Models\Tag');
    }

    // Get all comments

    public function comments(){
        return $this->hasMany('App\Models\Comment');
    }
}
