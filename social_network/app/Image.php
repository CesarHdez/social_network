<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Image extends Model
{
    protected $table = 'images';
    
    //relation one to mmany
    public function comments(){
        return $this->hasMany('App\Comment')->orderBy('id', 'desc');
    }
    
    //relation one to mmany
    public function likes(){
        return $this->hasMany('App\Like');
    }
    
    //relation many to one
    public function user(){
        return $this->belongsTo('App\User', 'user_id');
    }
}
