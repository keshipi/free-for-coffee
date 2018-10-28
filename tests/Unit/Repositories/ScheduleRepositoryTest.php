<?php

namespace Tests\Unit\Repositories;

use App\Models\Schedule;
use App\Models\Slots;
use App\Repositories\ScheduleRepository;
use DB;
use Mockery;
use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class ScheduleRepositoryTest extends TestCase
{
    use RefreshDatabase;

    /**
     * test fetchSchedule
     */
    public function testFetchSchedule()
    {
        $scheduleRepo = new ScheduleRepository();

        // get schedule instance
        $id = DB::table('schedules')->insertGetId(
            ['user_id' => 1, 'date' => '2018-12-31']
        );
        DB::table('slots')->insert([
            ['schedule_id' => $id, 'slot' => '10:00'],
            ['schedule_id' => $id, 'slot' => '12:00'],
            ['schedule_id' => $id, 'slot' => '14:00'],
        ]);
        $slots1 = new Slots($id, ['10:00', '12:00', '14:00']);
        $schedule1 =  new Schedule($id, '2018-12-31', 1, $slots1);
        $this->assertEquals($scheduleRepo->fetchSchedule(1, '2018-12-31'), $schedule1);

        // null
        $this->assertEquals($scheduleRepo->fetchSchedule(2, '2018-12-31'), null);

        // slots is empty
        $id = DB::table('schedules')->insertGetId(
            ['user_id' => 10, 'date' => '2018-12-31']
        );
        $slots2 = new Slots($id, []);
        $schedule2 =  new Schedule($id, '2018-12-31', 10, $slots2);
        $this->assertEquals($scheduleRepo->fetchSchedule(10, '2018-12-31'), $schedule2);
    }

    /**
     * test save
     */
    public function testSave()
    {
        $scheduleMock = Mockery::mock(Schedule::class);
        $scheduleMock->shouldReceive('getDate')->once()->andReturn('2018/12/31');
        $scheduleMock->shouldReceive('getUserId')->once()->andReturn(10);
        $scheduleMock->shouldReceive('getSlots')->once()->andReturn(['10:00', '14:00', '18:00']);

        $scheduleRepo = new ScheduleRepository();
        $scheduleRepo->save($scheduleMock);

        $this->assertDatabaseHas('schedules', [
            'user_id' => 10,
            'date' => '2018/12/31'
        ]);
        $this->assertDatabaseHas('slots', ['slot' => '10:00']);
        $this->assertDatabaseHas('slots', ['slot' => '14:00']);
        $this->assertDatabaseHas('slots', ['slot' => '18:00']);
    }
}
