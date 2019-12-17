<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Defendant extends Model
{
    protected $fillable = [
        'surname','name','fathersname'
    ];

    public function deals()
    {
        return $this->hasMany(Deal::class);
    }
    public function claim()
    {
        return $this->belongsTo('Claim');
    }
}
