<?php

namespace Database\Factories;

use App\Models\Album;
use App\Models\Photo;
use Illuminate\Database\Eloquent\Factories\Factory;

class PhotoFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Photo::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'album_id'      => function () {
                return Album::factory()->create()->id;
            },
            'title'         => $this->faker->sentence,
            'url'           => $this->faker->url,
            'thumbnail_url' => $this->faker->url,
        ];
    }
}
