<?php

namespace App\Repositories;

use App\Schedule as EloquentSchedule;
use App\Slot as EloquentSlot;
use App\Models\Schedule;
use App\Models\Slots;
use Carbon\Carbon;
use DB;

class ScheduleRepository
{
    /**
     * fetch tomottow's schedule from DB
     *
     * @param int $userId
     * @return Schedule|null
     */
    public function fetchTomorrow($userId): ?Schedule
    {
        $tomorrow = Carbon::tomorrow()->format(config('app.date_format_db'));
        return $this->fetchSchedule($userId, $tomorrow);
    }

    /**
     * fetch a schedule from DB
     *
     * @param int $userId
     * @param string $date
     * @return Schedule|null
     */
    public function fetchSchedule($userId, $date): ?Schedule
    {
        $schedule = EloquentSchedule::where('user_id', $userId)
            ->where('date', $date)
            ->first();

        if (!$schedule) {
            return null;
        }

        $slots = new Slots($schedule->id, $schedule->slots->pluck('slot')->toArray());
        return new Schedule($schedule->id, $schedule->date, $schedule->user_id, $slots);
    }

    /**
     * create new Schedule instance
     *
     * @param int $userId
     * @param string $date
     * @param Slots $slots
     * @return Schedule
     */
    public function new($userId, $date, $slots): Schedule
    {
        return new Schedule(null, $date, $userId, $slots);
    }

    /**
     * save schedule and slots
     *
     * @param Schedule $schedule
     * @return boolean
     */
    public function save($schedule): bool
    {
        DB::beginTransaction();
        try {
            $eloquentSchedule = new EloquentSchedule();
            $eloquentSchedule->date = $schedule->getDate();
            $eloquentSchedule->user_id = $schedule->getUserId();
            $eloquentSchedule->save();
            foreach ($schedule->getSlots() as $slot) {
                $eloquentSlot = new EloquentSlot();
                $eloquentSlot->schedule_id = $eloquentSchedule->id;
                $eloquentSlot->slot = $slot;
                $eloquentSlot->save();
            }
        } catch (\Exception $e) {
            DB::rollBack();
            abort(500);
        }
        DB::commit();
        return true;
    }
}
