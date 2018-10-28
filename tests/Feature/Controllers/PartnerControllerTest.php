<?php

namespace Tests\Feature\Controllers;

use App\Schedule;
use App\User;
use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class PartnerControllerTest extends TestCase
{
    use RefreshDatabase;

    /**
     * test Show
     */
    public function testShow()
    {
        $user = factory(User::class)->create(['id' => 1]);
        factory(Schedule::class)->create(['user_id' => $user->id]);
        $partner = factory(User::class)->create(['id' => 2]);
        factory(Schedule::class)->create(['user_id' => $partner->id]);

        $response = $this->actingAs($user)
            ->get(route('partner.show', 2));
        $response->assertStatus(200);
    }

    /**
     * test Show
     * a user doesn't exist
     */
    public function testShowWithException1()
    {
        $user = factory(User::class)->create(['id' => 1]);
        $response = $this->actingAs($user)
            ->get(route('partner.show', 1));
        $response->assertStatus(500);
    }

    /**
     * test Show
     * no user's schedule
     */
    public function testShowWithException2()
    {
        $user = factory(User::class)->create(['id' => 1]);
        $partner = factory(User::class)->create(['id' => 2]);
        $response = $this->actingAs($user)
            ->get(route('partner.show', 2));
        $response->assertStatus(500);
    }

    /**
     * test Show
     * no partner's schedule
     */
    public function testShowWithException3()
    {
        $user = factory(User::class)->create(['id' => 1]);
        factory(Schedule::class)->create(['user_id' => $user->id]);
        $partner = factory(User::class)->create(['id' => 2]);
        $response = $this->actingAs($user)
            ->get(route('partner.show', 2));
        $response->assertStatus(500);
    }
}
