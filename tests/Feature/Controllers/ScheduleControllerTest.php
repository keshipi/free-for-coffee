<?php

namespace Tests\Feature\Controllers;

use App\Http\Controllers\ScheduleController;
use App\Schedule;
use App\Slot;
use App\User;
use Carbon\Carbon;
use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class ScheduleControllerTest extends TestCase
{
    use RefreshDatabase;

    /**
     * test store without schedule data in DB(Create)
     */
    public function testStoreCreate()
    {
        $user = factory(User::class)->create(['id' => 1]);
        $postData = [
            'slots' => ['10:00', '13:00', '16:00', '19:00']
        ];
        $this->actingAs($user)
            ->post(route('schedule.store'), $postData);
        $this->assertDatabaseHas('schedules', [
                'user_id' => $user->id,
                'date' => $tomorrow = Carbon::tomorrow()->format(config('app.date_format_db'))])
            ->assertDatabaseHas('slots', ['slot' => '10:00'])
            ->assertDatabaseHas('slots', ['slot' => '13:00'])
            ->assertDatabaseHas('slots', ['slot' => '16:00'])
            ->assertDatabaseHas('slots', ['slot' => '19:00']);
    }

    /**
     * test store with schedule data and slot data in DB(update)
     * update all slots
     */
    public function testStoreUpdate1()
    {
        $user = factory(User::class)->create(['id' => 1]);
        $schedule = factory(Schedule::class)->create(['user_id' => $user->id]);
        $storedSlots = ['10:00', '13:00', '16:00', '19:00'];
        foreach ($storedSlots as $slot) {
            factory(Slot::class)->create([
                'schedule_id' => $schedule->id,
                'slot' => $slot
                ]);
        }
        $postData = [
            'slots' => ['12:00', '15:00', '18:00']
        ];
        $this->actingAs($user)
            ->post(route('schedule.store'), $postData);

        $this->assertDatabaseHas('slots', ['slot' => '12:00'])
            ->assertDatabaseHas('slots', ['slot' => '15:00'])
            ->assertDatabaseHas('slots', ['slot' => '18:00'])
            ->assertDatabaseMissing('slots', ['slot' => '10:00'])
            ->assertDatabaseMissing('slots', ['slot' => '13:00'])
            ->assertDatabaseMissing('slots', ['slot' => '16:00'])
            ->assertDatabaseMissing('slots', ['slot' => '19:00']);
    }

    /**
     * test store with schedule data and slot data in DB(update)
     * make slots none
     */
    public function testStoreUpdate2()
    {
        $user = factory(User::class)->create(['id' => 1]);
        $schedule = factory(Schedule::class)->create(['user_id' => $user->id]);
        $storedSlots = ['10:00', '13:00', '16:00', '19:00'];
        foreach ($storedSlots as $slot) {
            factory(Slot::class)->create([
                'schedule_id' => $schedule->id,
                'slot' => $slot
                ]);
        }
        $postData = [
            'slots' => []
        ];
        $this->actingAs($user)
            ->post(route('schedule.store'), $postData);

        $this->assertDatabaseMissing('slots', ['slot' => '10:00'])
            ->assertDatabaseMissing('slots', ['slot' => '13:00'])
            ->assertDatabaseMissing('slots', ['slot' => '16:00'])
            ->assertDatabaseMissing('slots', ['slot' => '19:00']);
    }
}
