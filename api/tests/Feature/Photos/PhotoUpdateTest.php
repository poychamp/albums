<?php

namespace Tests\Feature\Photos;

use App\Models\Photo;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class PhotoUpdateTest extends TestCase
{
    use RefreshDatabase;

    /** @test */
    public function update()
    {
        $photo = Photo::factory()->create();
        $data = [
            'title'         => 'New Title',
            'url'           => 'http://new-url.com',
            'thumbnail_url' => 'http://new-thumbnail-url.com',
        ];

        $response = $this->putJson("/api/photos/{$photo->id}", $data);

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

        $photo->refresh();

        $this->assertEquals($data['title'], $photo->title);
        $this->assertEquals($data['url'], $photo->url);
        $this->assertEquals($data['thumbnail_url'], $photo->thumbnail_url);
    }

    /** @test */
    public function invalid_required()
    {
        $photo = Photo::factory()->create();
        $data = [
            'title'         => '',
            'url'           => '',
            'thumbnail_url' => '',
        ];

        $response = $this->putJson("/api/photos/{$photo->id}", $data);

        $response->assertStatus(422);

        $errors = $response->json('errors');

        $this->assertStringContainsString('required', $errors['title'][0]);
        $this->assertStringContainsString('required', $errors['url'][0]);
        $this->assertStringContainsString('required', $errors['thumbnail_url'][0]);
    }

    /** @test */
    public function invalid_urls()
    {
        $photo = Photo::factory()->create();
        $data = [
            'title'         => 'sadsad',
            'url'           => 'wrong-url',
            'thumbnail_url' => 'wrong-url',
        ];

        $response = $this->putJson("/api/photos/{$photo->id}", $data);

        $response->assertStatus(422);

        $errors = $response->json('errors');

        $this->assertStringContainsString('url', $errors['url'][0]);
        $this->assertStringContainsString('url', $errors['thumbnail_url'][0]);
    }
}
