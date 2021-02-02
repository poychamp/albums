<?php

namespace App\Http\Controllers;

use App\Http\Resources\AlbumResource;
use App\Http\Resources\PhotoResource;
use App\Models\Album;
use App\Models\Photo;
use App\Models\User;
use Illuminate\Http\Request;

class AlbumController extends Controller
{
    /**
     * @return \Illuminate\Http\Resources\Json\AnonymousResourceCollection
     */
    public function index()
    {
        return AlbumResource::collection(Album::paginate(15));
    }

    /**
     * @param \App\Models\Album $album
     *
     * @return \Illuminate\Http\Resources\Json\AnonymousResourceCollection
     */
    public function photos(Album $album)
    {
        $photos = Photo::where('album_id', $album->id)
            ->paginate(15);

        return PhotoResource::collection($photos);
    }

    /**
     * @param \App\Models\Album $album
     *
     * @return \App\Http\Resources\AlbumResource
     */
    public function show(Album $album)
    {
        return new AlbumResource($album);
    }

    /**
     * @param \App\Models\User $user
     *
     * @return \Illuminate\Http\Resources\Json\AnonymousResourceCollection
     */
    public function user(User $user)
    {
        $albums = Album::where('user_id', $user->id)->paginate(15);

        return AlbumResource::collection($albums);
    }
}
