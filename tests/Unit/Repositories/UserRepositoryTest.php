<?php

namespace Tests\Unit\Repositories;

use App\Models\User;
use App\Repositories\UserRepository;
use Carbon\Carbon;
use DB;
use Mockery;
use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class UserRepositoryTest extends TestCase
{
    use RefreshDatabase;

    /**
     * test getUser
     */
    public function testGetUser()
    {
        $userRepo = new UserRepository();

        // get user instance
        DB::table('users')->insert([
            'id' => 10,
            'name' => 'John Smith',
            'email' => 'example@example.com',
            'password' => '$2y$10$TKh8H1.PfQx37YgCzwiKb.KjNyWgaHb9cbcoQgdIVFlYg7B77UdFm', // secret
            'remember_token' => str_random(10)
        ]);
        $this->assertEquals($userRepo->getUser(10), new User(10, 'John Smith'));

        // null
        $this->assertEquals($userRepo->getUser(100), null);
    }

    /**
     * test fetchPartners
     */
    public function testFetchPertners()
    {
        $userRepo = new UserRepository();

        $password = '$2y$10$TKh8H1.PfQx37YgCzwiKb.KjNyWgaHb9cbcoQgdIVFlYg7B77UdFm'; // secret
        DB::table('users')->insert([
            ['id' => 1, 'name' => 'Bob', 'email' => 'a@a.com', 'password' => $password, 'remember_token' => str_random(10)],
            ['id' => 2, 'name' => 'John', 'email' => 'b@b.com', 'password' => $password, 'remember_token' => str_random(10)],
            ['id' => 3, 'name' => 'Stan', 'email' => 'c@c.com', 'password' => $password, 'remember_token' => str_random(10)]
        ]);

        $tomorrow = Carbon::tomorrow()->format(config('app.date_format_db'));
        DB::table('schedules')->insert([
            ['user_id' => 2, 'date' => $tomorrow],
            ['user_id' => 3, 'date' => $tomorrow]
        ]);

        // not include myself
        $this->assertEquals(
            $userRepo->fetchPertners(1),
            [
                new User(2, 'John'),
                new User(3, 'Stan')
            ]
        );

        // exclude myself
        $this->assertEquals(
            $userRepo->fetchPertners(2),
            [
                new User(3, 'Stan')
            ]
        );

        DB::table('schedules')->where('date', $tomorrow)->delete();

        // none
        $this->assertEquals($userRepo->fetchPertners(1), []);
    }
}
