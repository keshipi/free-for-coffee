<?php

namespace App\Repositories;

use App\User as EloquentUser;
use App\Models\User;
use Carbon\Carbon;
use DB;

class UserRepository
{
    /**
     * fetch user by ID
     *
     * @param int $id
     * @return User|null
     */
    public function getUser($id): ?User
    {
        $user = EloquentUser::find($id);
        if (!$user) {
            return null;
        }
        return new User($user->id, $user->name);
    }

    /**
     * fetch partners who have already registerd their schedule
     *
     * @param int $id
     * @return array
     */
    public function fetchPertners($id): array
    {
        $schedules = \DB::table('schedules')
            ->join('users', 'users.id', '=', 'schedules.user_id')
            ->where('user_id', '!=', $id)
            ->where('date', Carbon::tomorrow()->format(config('app.date_format_db')))
            ->get();
        $partners = [];
        foreach ($schedules as $schedule) {
            $partners[] = new User($schedule->user_id, $schedule->name);
        }
        return $partners;
    }
}
