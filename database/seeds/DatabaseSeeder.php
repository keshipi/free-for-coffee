<?php

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        // $this->call(UsersTableSeeder::class);
        $scheduleDates = factory(App\ScheduleDate::class, 5)->make();
        foreach ($scheduleDates as $i => $scheduleDate) {
            $scheduleDate->user_id = $i + 1;
            $scheduleDate->save();
            $scheduleDate
                ->scheduleDateSlots()
                ->saveMany(factory(App\ScheduleDateSlot::class, 3)->make(['schedule_date_id' => $scheduleDate->id]));
        }
    }
}
