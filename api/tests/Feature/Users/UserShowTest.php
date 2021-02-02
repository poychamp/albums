<?php

namespace Tests\Feature\Users;

use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class UserShowTest extends TestCase
{
    use RefreshDatabase;

    /** @test */
    public function show()
    {
        $user = User::factory()->create();

        $response = $this->get("/api/users/{$user->id}");

        $response->assertStatus(200)
            ->assertJsonStructure([
                'data' => [
                    'id',
                    'name',
                    'username',
                    'email',
                    'phone',
                    'website',
                ]
            ]);
    }
}
