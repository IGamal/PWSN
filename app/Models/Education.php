<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Education extends Model
{
    use HasFactory, SoftDeletes;

    const Aprroved = 'ture';
    const UnApproved = 'false';

    protected static function boot()
    {
        parent::boot();

        static::creating(function($education)
        {
            $education->slug = str_slug($education->title);
        });
    }

    public function getRouteKeyName()
    {
        return 'slug';
    }

    //The attributes that are mass assignable.
    protected $fillable = ['title', 'slug', 'body', 'video', 'book', 'approved', 'user_id'];
    protected $hidden = ['pivot'];

    //The Relation With User Model.
    public function user()
    {
        return $this->belongsTo('App\Models\User');
    }

    //The Relation With Category Model.
    public function categories()
    {
        return $this->belongsToMany('App\Models\Category');
    }

    //The Relation With Comment Model.
    public function comments()
    {
        return $this->hasMany('App\Models\Comment');
    }

    //The Relation With Favourite Model.
    public function favourites()
    {
        return $this->hasMany('App\Models\Favourite');
    }

    //The Relation With Save Model.
    public function saves()
    {
        return $this->hasMany('App\Models\Save');
    }
}
