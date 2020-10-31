<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Category extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = ['name', 'description', 'user_id'];
    protected $hidden = ['pivot'];

    //The Relation With User Model
    public function user()
    {
        return $this->belongsTo('App\Models\User');
    }

    //The Relation With Article Model
    public function articles()
    {
        return $this->belongsToMany('App\Models\Article');
    }

    //The Relation With Donation Model
    public function donations()
    {
        return $this->belongsToMany('App\Models\Donation');
    }
}
