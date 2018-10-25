<?php

namespace App\Models;

use Carbon\Carbon;

class TimeSlot
{
    private static $start = '09:00';
    private static $end = '21:00';
    private static $length = 60;

    public static function getTimeSlot(): array
    {
        $start = new Carbon(Carbon::today()->format(config('app.date_format_db')) . ' ' . self::$start);
        $end = new Carbon(Carbon::today()->format(config('app.date_format_db')) . ' ' . self::$end);
        $slots = [] ;
        while ($start->lt($end)) {
            $slots[] = $start->format('H:i');
            $start->addMinutes(self::$length);
        }
        return $slots;
    }
}
