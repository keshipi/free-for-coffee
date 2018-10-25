<?php

namespace App\Repositories;

use App\Slot as EloquentSlot;
use App\Models\Slots;
use DB;

class SlotsRepository
{
    /**
     * create new Slots instance
     *
     * @param array $slots
     * @return Slots
     */
    public function new($slots): Slots
    {
        return new Slots(null, $slots);
    }

    /**
     * update(delete/insert)
     *
     * @param int $schedule_id
     * @param Slots $slots
     * @return boolean
     */
    public function update($schedule_id, $slots): bool
    {
        DB::beginTransaction();
        try {
            EloquentSlot::where('schedule_id', $schedule_id)->delete();
            foreach ($slots->getSlots() as $slot) {
                $eloquentSlot = new EloquentSlot();
                $eloquentSlot->schedule_id = $schedule_id;
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
