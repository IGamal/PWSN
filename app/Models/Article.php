<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Article extends Model
{
    use HasFactory, SoftDeletes;

    const Aprroved = 'ture';
    const UnApproved = 'false';

    protected static function boot()
    {
        parent::boot();

        static::creating(function($article)
        {
            $article->slug = str_slug($article->title);
        });
    }

    public function getRouteKeyName()
    {
       return 'slug';
    }

    //The attributes that are mass assignable.
    protected $fillable = ['title', 'slug', 'body', 'image', 'video', 'approved', 'user_id'];
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
}
