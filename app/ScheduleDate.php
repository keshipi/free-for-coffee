<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ScheduleDate extends Model
{
    protected $fillable = ['user_id', 'date'];

    public function scheduleDateSlots()
    {
        return $this->hasMany('App\ScheduleDateSlot');
    }
}
