<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Governorate extends Model
{
    use HasFactory;

    protected $fillable = ['name'];

    //The Relation With Donation Model.
    public function donations()
    {
        return $this->hasMany('App\Model\Donation');
    }

    //The Relation With Job Model.
    public function jobs()
    {
        return $this->hasMany('App\Model\Job');
    }
}
