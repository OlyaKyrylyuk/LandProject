<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Deal extends Model
{
    protected $fillable = [
        'number','judge','subject_claim','claim_id','defendant_id'
    ];

    public function usersdeals()
    {
        return $this->hasMany(Users_deal::class);
    }
    public function steps()
    {
        return $this->hasMany(Step::class);
    }

    public function claim()
    {
        return $this->belongsTo('Claim');
    }
}
