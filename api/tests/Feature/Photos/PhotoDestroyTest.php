<?php

namespace Tests\Feature\Photos;

use App\Models\Photo;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class PhotoDestroyTest extends TestCase
{
    use RefreshDatabase;

    /** @test */
    public function destroy()
    {
        $photo = Photo::factory()->create();

        $response = $this->deleteJson("/api/photos/{$photo->id}");

        $response->assertStatus(200);

        $this->assertNull(Photo::find($photo->id));
    }
}
