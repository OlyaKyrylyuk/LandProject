<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Claim extends Model
{
    protected $fillable = [
        'number','reason','date_filling','user_id','created_at','updated_at'
    ];



    public function deals()
    {
        return $this->hasMany(Deal::class);
    }


    public function user()
    {
        return $this->belongsTo('User');
    }
}
