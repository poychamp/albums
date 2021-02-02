<?php

namespace Tests\Feature\Albums;

use App\Models\Album;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class AlbumIndexTest extends TestCase
{
    use RefreshDatabase;

    /** @test */
    public function index()
    {
        Album::factory(18)->create();

        $response = $this->getJson('/api/albums/');

        $response->assertStatus(200)
            ->assertJsonStructure([
                'data' => [
                    [
                        'title',
                        'user_id',
                    ]
                ]
            ])->assertJsonCount(15, 'data');
    }

    /** @test */
    public function page_two()
    {
        Album::factory(18)->create();

        $response = $this->getJson('/api/albums/?page=2');

        $response->assertStatus(200)
            ->assertJsonCount(3, 'data');
    }
}
