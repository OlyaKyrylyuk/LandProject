<?php

namespace App;

use DateTime;
use Illuminate\Database\Eloquent\Model;

class Step extends Model
{
    protected $fillable = [
        'type','date','deal_start','deal_end','decision','deal_id','institution_id'
    ];

    public function contests()
    {
        return $this->hasMany(Contest::class);
    }
    public function deal()
    {
        return $this->belongsTo('Deal');
    }
    public function institution()
    {
        return $this->belongsTo('Institution');
    }

    /**
     * Get the event's title
     *
     * @return string
     */
    public function getTitle()
    {
        // TODO: Implement getTitle() method.
    }

    /**
     * Is it an all day event?
     *
     * @return bool
     */
    public function isAllDay()
    {
        // TODO: Implement isAllDay() method.
    }

    /**
     * Get the start time
     *
     * @return DateTime
     */
    public function getStart()
    {
        // TODO: Implement getStart() method.
    }

    /**
     * Get the end time
     *
     * @return DateTime
     */
    public function getEnd()
    {
        // TODO: Implement getEnd() method.
    }

    /**
     * Get the event's ID
     *
     * @return int|string|null
     */
    public function getId()
    {
        // TODO: Implement getId() method.
    }
}
