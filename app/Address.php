<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Address extends Model
{
    protected $fillable = [
      'object_id','object_type','index','place','street','street_number','flat'
    ];
    public function profile()
    {
        return $this->morphTo();
    }
}
