<?php

namespace Tests\Unit\Models;

use App\Models\Schedule;
use App\Models\Slots;
use Mockery;
use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class ScheduleTest extends TestCase
{
    /**
     * test getId
     */
    public function testGetId()
    {
        $id = 10;
        $schedule = new Schedule($id, '2020/12/31', 20, null);
        $this->assertEquals($schedule->getId(), $id);
    }

    /**
     * test getDate
     */
    public function testGetDate()
    {
        $date = '2020/12/31';
        $schedule = new Schedule(10, $date, 20, null);
        $this->assertEquals($schedule->getDate(), $date);
    }

    /**
     * test getUserId
     */
    public function testGetUserId()
    {
        $userId = 100;
        $schedule = new Schedule(10, '2020/12/31', $userId, null);
        $this->assertEquals($schedule->getUserId(), $userId);
    }

    /**
     * test getSlots
     */
    public function testGetSlots()
    {
        $slots = ['09:00', '12:00', '15:00', '18:00'];

        $slotsMock = Mockery::mock(Slots::class);
        $slotsMock->shouldReceive('getSlots')->once()->andReturn($slots);

        $schedule = new Schedule(10, '2020/12/31', 20, $slotsMock);
        $this->assertEquals($schedule->getSlots(), $slots);
    }

    /**
     * test hasSlot
     *
     * @dataProvider hasSlotDataProvider
     */
    public function testHasSlot($bool, $expected)
    {
        $slotsMock = Mockery::mock(Slots::class);
        $slotsMock->shouldReceive('hasSame')->once()->andReturn($bool);
        $schedule = new Schedule(10, '2020/12/31', 20, $slotsMock);

        $slots = ['09:00', '12:00', '15:00', '18:00'];
        $this->assertEquals($schedule->hasSlot($slots), $expected);
    }

    /**
     * test matchSlots
     *
     * @dataProvider matchSlotsDataProvider
     */
    public function testMatchSlots($slotsA, $slotsB, $expected)
    {
        $slotsMock = Mockery::mock(Slots::class);
        $slotsMock->shouldReceive('getSlots')->once()->andReturn($slotsA);

        $schedule = new Schedule(10, '2020/12/31', 20, $slotsMock);

        $this->assertEquals($schedule->matchSlots($slotsB), $expected);
    }

    public function constructDataProvider()
    {
        return [
            [
                10, '2020/12/31', 20, $slotsMock
            ]
        ];
    }

    public function hasSlotDataProvider()
    {
        return [
            'slots has slot' => [
                true, true
            ],
            'slots doesn\'t have slot' => [
                false, false
            ]
        ];
    }

    public function matchSlotsDataProvider()
    {
        $slots = ['09:00', '12:00', '15:00', '18:00'];
        
        return [
            'all same' => [
                $slots, ['09:00', '12:00', '15:00', '18:00'], ['09:00', '12:00', '15:00', '18:00']
            ],
            'one same' => [
                $slots, ['09:00', '10:00', '14:00', '17:00'], ['09:00']
            ],
            'two same' => [
                $slots, ['09:00', '10:00', '15:00', '17:00'], ['09:00', '15:00']
            ],
            'none' => [
                $slots, ['10:00', '13:00', '16:00', '19:00'], []
            ],
        ];
    }
}
