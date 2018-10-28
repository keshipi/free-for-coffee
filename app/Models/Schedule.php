<?php

namespace App\Models;

class Schedule
{
    /** @var int */
    private $id;

    /** @var string */
    private $date;

    /** @var int */
    private $userId;

    /** @var Slots */
    private $slots;

    public function __construct($id, $date, $userId, $slots)
    {
        $this->id = $id;
        $this->date = $date;
        $this->userId = $userId;
        $this->slots = $slots;
    }

    public function getId(): int
    {
        return $this->id;
    }

    public function getDate(): string
    {
        return $this->date;
    }

    public function getUserId(): int
    {
        return $this->userId;
    }

    public function getSlots(): array
    {
        return $this->slots->getSlots();
    }

    public function setId($id)
    {
        $this->id = $id;
    }

    /**
     * check if the schedule has a same slot
     *
     * @param string $slot
     * @return boolean
     */
    public function hasSlot($slot): bool
    {
        return $this->slots->hasSame($slot);
    }

    /**
     * get matched slots
     *
     * @param array $slots
     * @return array
     */
    public function matchSlots($slots): array
    {
        return array_values(array_intersect($this->getSlots(), $slots));
    }
}
