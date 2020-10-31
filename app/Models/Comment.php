<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Comment extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = ['body', 'user_id', 'article_id', 'news_id', 'donation_id', 'job_id'];

    //The Relation With User Model
    public function user()
    {
        return $this->belongsTo('App\Models\User');
    }

    //The Relation With Article Model
    public function article()
    {
        return $this->belongsTo('App\Models\Article');
    }

    //The Relation With News Model
    public function news()
    {
        return $this->belongsTo('App\Models\News');
    }

    //The Relation With Donation Model
    public function donation()
    {
        return $this->belongsTo('App\Models\Donation');
    }

    //The Relation With Job Model
    public function job()
    {
        return $this->belongsTo('App\Models\Job');
    }

    //The Relation With Education Model
    public function education()
    {
        return $this->belongsTo('App\Models\Education');
    }

    //The Relation With Reply Model
    public function replies()
    {
        return $this->hasMany('App\Models\Reply');
    }

    //The Relation With Like Model
    public function likes()
    {
        return $this->hasMany('App\Models\Like');
    }
}
