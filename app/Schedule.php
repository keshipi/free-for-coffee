<?php

namespace App;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;

class Schedule extends Model
{
    protected $fillable = ['user_id', 'date'];

    public function slots()
    {
        return $this->hasMany('App\Slot');
    }
}
