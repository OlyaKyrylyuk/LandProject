<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Users_deal extends Model
{
    protected $fillable = [
        'user_id','deal_id'
    ];

    public function user()
    {
        return $this->belongsTo('User');
    }

    public function deal()
    {
        return $this->belongsTo('Deal');
    }


}
