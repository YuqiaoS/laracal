<?php

namespace Calendar;

use Illuminate\Database\Eloquent\Model;

class Event extends Model
{
    protected $fillable=['event', 'event_date'];

    function user(){
    	return $this->belongsTo(User::class);
    }
}
