<?php

namespace Tests\Feature\Photos;

use App\Models\Photo;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class PhotoShowTest extends TestCase
{
    use RefreshDatabase;

    /** @test */
    public function show()
    {
        $photo = Photo::factory()->create();

        $response = $this->getJson("/api/photos/{$photo->id}");

        $response->assertStatus(200)
            ->assertJsonStructure([
                'data' => [
                    'id',
                    'album_id',
                    'title',
                    'url',
                    'thumbnail_url',
                ]
            ]);
    }
}
