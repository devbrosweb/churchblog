<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Post extends Model
{
    protected $fillable = ['title', 'slug', 'body', 'status', 'approved'];

    protected $cats = ['status' => 'boolean', 'approved' => 'boolean'];

    public function user(){
        return $this->belongsTo('App\User');
    }

    public function categories(){
        return $this->belongsToMany('App\Category');
    }

    public function tags(){
        return $this->belongsToMany('App\Tag');
    }

    public function is_approved()
    {
        return $this->approved;
    }
    public function is_published()
    {
        return $this->status;
    }

}
