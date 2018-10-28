<?php

namespace Tests\Unit\Repositories;

use App\Models\Slots;
use App\Repositories\SlotsRepository;
use Mockery;
use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class SlotsRepositoryTest extends TestCase
{
    use RefreshDatabase;

    /**
     * test update
     */
    public function testUpdate()
    {
        $scheduleId = 10;
        $slots = array('10:00', '12:00', '14:00', '16:00', '18:00');

        $slotsMock = Mockery::mock(Slots::class);
        $slotsMock->shouldReceive('getSlots')->once()->andReturn($slots);

        $slotsRepository = new SlotsRepository();
        $slotsRepository->update(10, $slotsMock);

        $this->assertDatabaseHas('slots', [
            'schedule_id' => 10,
            'slot' => '10:00'
        ]);
        $this->assertDatabaseHas('slots', [
            'schedule_id' => 10,
            'slot' => '12:00'
        ]);
        $this->assertDatabaseHas('slots', [
            'schedule_id' => 10,
            'slot' => '14:00'
        ]);
        $this->assertDatabaseHas('slots', [
            'schedule_id' => 10,
            'slot' => '16:00'
        ]);
        $this->assertDatabaseHas('slots', [
            'schedule_id' => 10,
            'slot' => '18:00'
        ]);
    }
}
