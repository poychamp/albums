<?php

namespace Tests\Feature\Albums;

use App\Models\Album;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class AlbumShowTest extends TestCase
{
    use RefreshDatabase;

    /** @test */
    public function show()
    {
        $album = Album::factory()->create();

        $response = $this->get("/api/albums/{$album->id}");

        $response->assertStatus(200)
            ->assertJsonStructure([
                'data' => [
                    'title',
                    'user_id',
                ]
            ]);
    }
}
