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
}
