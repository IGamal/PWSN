<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Reply extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = ['body', 'user_id', 'comment_id'];

    //The Relation With User Model
    public function user()
    {
        return $this->belongsTo('App\Models\User');
    }

    //The Relation With Comment Model
    public function comment()
    {
        return $this->belongsTo('App\Models\Comment');
    }

    //The Relation With Like Model
    public function likes()
    {
        return $this->hasMany('App\Models\Like');
    }
}
