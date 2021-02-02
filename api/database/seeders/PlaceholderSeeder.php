<?php

namespace Database\Seeders;

use App\Models\Album;
use App\Models\Photo;
use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Http;

class PlaceholderSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        if (User::count()) {
            return;
        }

        $this->seedUsers();
        $this->seedAlbums();
        $this->seedPhotos();
    }

    private function seedUsers()
    {
        $response = Http::get('https://jsonplaceholder.typicode.com/users');

        foreach ($response->json() as $data) {
            $user = User::factory()->create([
                'name'     => $data['name'],
                'username' => $data['username'],
                'email'    => $data['email'],
                'phone'    => $data['phone'],
                'website'  => $data['website'],
            ]);

            $addressData = $data['address'];

            $user->address()->create([
                'street'   => $addressData['street'],
                'suite'    => $addressData['suite'],
                'city'     => $addressData['city'],
                'zip_code' => $addressData['zipcode'],
                'geo'      => json_encode($addressData['geo']),
            ]);

            $companyData = $data['company'];

            $user->company()->create([
                'name'         => $companyData['name'],
                'catch_phrase' => $companyData['catchPhrase'],
                'bs'           => $companyData['bs'],
            ]);
        }
    }

    private function seedAlbums()
    {
        $response = Http::get('https://jsonplaceholder.typicode.com/albums');

        foreach ($response->json() as $data) {
            Album::factory()->create([
                'title'   => $data['title'],
                'user_id' => $data['userId'],
            ]);
        }
    }

    private function seedPhotos()
    {
        $response = Http::get('https://jsonplaceholder.typicode.com/photos');

        foreach ($response->json() as $data) {
            Photo::factory()->create([
                'album_id'      => $data['albumId'],
                'title'         => $data['title'],
                'url'           => $data['url'],
                'thumbnail_url' => $data['thumbnailUrl'],
            ]);
        }
    }
}
