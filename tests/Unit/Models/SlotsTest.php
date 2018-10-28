<?php

namespace Tests\Unit\Models;

use App\Models\Slots;
use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class SlotsTest extends TestCase
{
    /**
     * test getScheduleId
     */
    public function testGetScheduleId()
    {
        $scheduleId = 1;
        $slots = new Slots($scheduleId, []);
        $this->assertEquals($slots->getScheduleId(), $scheduleId);
    }

    /**
     * test getSlots
     *
     * @dataProvider getSlotsDataProvider
     */
    public function testGetSlots($slots, $expected)
    {
        $slots = new Slots(1, $slots);
        $this->assertEquals($slots->getSlots(), $expected);
    }

    public function getSlotsDataProvider()
    {
        return [
            'array' => [
                ['09:00', '12:00', '15:00', '18:00'], ['09:00', '12:00', '15:00', '18:00']
            ],
            'null' => [
                null, []
            ]
        ];
    }

    /**
     * test hasSame
     *
     * @dataProvider hasSameDataProvider
     */
    public function testHasSame($slots, $slot, $expected)
    {
        $slots = new Slots(1, $slots);
        $this->assertEquals($slots->hasSame($slot), $expected);
    }

    public function hasSameDataProvider()
    {
        return [
            'match' => [
                ['09:00', '12:00', '15:00', '18:00'], '18:00', true
            ],
            'not match' => [
                ['09:00', '12:00', '15:00', '18:00'], '13:00', false
            ]
        ];
    }

}
