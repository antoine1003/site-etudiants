<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;


class Event extends Model implements \MaddHatter\LaravelFullcalendar\Event
{
    protected $fillable = ['id','title','start_date','end_date'];
    protected $dates = ['start', 'end'];

    public function eventuser()
    {
        return $this->belongTo('App\Models\EventUser');
    }

    public function eventcategorie()
    {
        return $this->hasOne('App\Models\EventCategorie');
    }

    public function eventetat()
    {
        return $this->hasOne('App\Models\EventEtat');
    }

    /**
     * Get the event's id number
     *
     * @return int
     */
    public function getId() {
		return $this->id;
	}

    /**
     * Get the event's title
     *
     * @return string
     */
    public function getTitle()
    {
        return $this->title;
    }

    /**
     * Is it an all day event?
     *
     * @return bool
     */
    public function isAllDay()
    {
        return (bool)$this->all_day;
    }

    /**
     * Get the start time
     *
     * @return DateTime
     */
    public function getStart()
    {
        return $this->start;
    }

    /**
     * Get the end time
     *
     * @return DateTime
     */
    public function getEnd()
    {
        return $this->end;
    }
}
