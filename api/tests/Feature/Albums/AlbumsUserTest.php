<?php

namespace Tests\Feature\Albums;

use App\Models\Album;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class AlbumsUserTest extends TestCase
{
    use RefreshDatabase;

    /** @test */
    public function test_example()
    {
        $user = User::factory()->create();

        Album::factory(18)->create([
            'user_id' => $user->id,
        ]);
        Album::factory(2)->create();

        $response = $this->getJson("/api/users/{$user->id}/albums");

        $response->assertStatus(200)
            ->assertJsonStructure([
                'data' => [
                    [
                        'user_id',
                        'title',
                    ]
                ]
            ])->assertJsonCount(15, 'data');
    }
}
