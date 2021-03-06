<?php

namespace App;
use Illuminate\Database\Eloquent\Model;

class Post extends Model
{  
    protected $fillable=['title', 'content'];

    public function likes() {
    	return $this->hasMany('App\Like'); ////$this->hasMany('App\Like', 'post_id')
    }

    public function tags(){
    	return $this->belongsToMany('App\Tag')->withTimestamps(); //$this->belongsToMany('App\Post', 'post_tag', 'post_id', 'tag_id')
    }

    //mutator
    public function setTitleAttribute($value) {
    	$this->attributes['title']=strtolower($value);
    }

    //accessor
    public function getTitleAttribute($value) {
    	return strtoupper($value);
    }
}