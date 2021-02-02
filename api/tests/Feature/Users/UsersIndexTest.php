<?php

namespace Tests\Feature\Users;

use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class UsersIndexTest extends TestCase
{
    use RefreshDatabase;

    /** @test */
    public function index()
    {
        User::factory(18)->create();

        $response = $this->getJson('/api/users');

        $response->assertStatus(200)
            ->assertJsonStructure([
                'data' => [
                    [
                        'id',
                        'name',
                        'username',
                        'email',
                        'phone',
                        'website',
                    ]
                ]
            ])->assertJsonCount(15, 'data');

        $this->assertCount(18, User::all());
    }
}
