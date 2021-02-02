<?php

namespace Tests\Feature\Albums;

use App\Models\Album;
use App\Models\Photo;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class AlbumPhotosTest extends TestCase
{
    use RefreshDatabase;

    /** @test */
    public function photos()
    {
        $album = Album::factory()->create();

        Photo::factory(20)->create([
            'album_id' => $album->id,
        ]);
        Photo::factory(30)->create();

        $response = $this->getJson("/api/albums/{$album->id}/photos");

        $response->assertStatus(200)
            ->assertJsonStructure([
                'data' => [
                    [
                        'album_id',
                        'title',
                        'url',
                        'thumbnail_url',
                    ]
                ]
            ])->assertJsonCount(15, 'data');

        $this->assertCount(50, Photo::all());
    }
}
