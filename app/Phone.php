<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Phone extends Model
{
    protected $fillable = [
        'object_id','object_type','phone'
    ];
    public function profile()
    {
        return $this->morphTo();
    }
}
