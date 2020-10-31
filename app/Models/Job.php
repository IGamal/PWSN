<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Job extends Model
{
    use HasFactory, SoftDeletes;

    const Aprroved = 'ture';
    const UnApproved = 'false';

    protected static function boot()
    {
        parent::boot();

        static::creating(function($job)
        {
            $job->slug = str_slug($job->title);
        });
    }

    public function getRouteKeyName()
    {
        return 'slug';
    }

    //The attributes that are mass assignable.
    protected $fillable = ['title', 'slug', 'description', 'requirements', 'salary', 'phone', 'approved', 'governorate_id', 'user_id'];
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

    //The Relation With Governorate Model.
    public function governorate()
    {
        return $this->belongsTo('App\Models\Governorate');
    }

    //The Relation With Comment Model.
    public function comments()
    {
        return $this->hasMany('App\Models\Comment');
    }
}

