<?php

namespace App\Models;

class Slots
{
    /** @var int */
    private $schedule_id;

    /** @var array */
    private $slots;

    public function __construct($schedule_id, $slots)
    {
        $this->schedule_id = $schedule_id;
        $this->slots = $slots;
    }

    public function getScheduleId(): int
    {
        return $this->schedule_id;
    }

    public function getSlots(): array
    {
        if (!$this->slots) {
            return [];
        }
        return $this->slots;
    }

    /**
     * check if the slot is same as passed arg
     *
     * @param string $slot
     * @return boolean
     */
    public function hasSame($slot): bool
    {
        foreach ($this->slots as $s) {
            if ($s === $slot) {
                return true;
            }
        }
        return false;
    }
}
