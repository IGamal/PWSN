<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Like extends Model
{
    use HasFactory;

    protected $fillable = ["like", "user_id", "comment_id", "reply_id"];

    //The Relation With User Model
    public function user()
    {
        return $this->belongsTo("App/Models/User");
    }

    //The Relation With Comment Model
    public function comment()
    {
        return $this->belongsTo("App/Models/Comment");
    }

    //The Relation With Reply Model
    public function reply()
    {
        return $this->belongsTo("App/Models/Reply");
    }
}
