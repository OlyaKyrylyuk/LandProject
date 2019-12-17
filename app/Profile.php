<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Profile extends Model
{
    protected $fillable = [
        'type','surname','name','fathersname','date_of_birth','phone','post','user_id'
    ];

    public function user()
    {
        return $this->belongsTo('User');
    }
    public function phone()
    {
        return $this->morphMany('App\Phone', 'profile');
    }
    public function address()
    {
        return $this->morphOne('App\Address', 'profile');
    }

}
