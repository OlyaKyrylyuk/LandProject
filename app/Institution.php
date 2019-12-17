<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Institution extends Model
{
    protected $fillable = [
        'name','email',
    ];

    public function steps()
    {
        return $this->hasMany(Step::class);
    }
}
