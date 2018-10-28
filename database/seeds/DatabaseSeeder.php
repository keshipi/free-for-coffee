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
        factory(App\User::class, 30)->create()->each(function ($user) {
            $schedule = factory(App\Schedule::class)->make(['user_id' => $user->id]);
            $schedule->save();
            $schedule
                ->slots()
                ->saveMany(factory(App\Slot::class, 4)->make(['schedule_id' => $schedule->id]));
        });
    }
}
