<?php

namespace App\Http\Controllers;

use App\Http\Resources\AlbumResource;
use App\Http\Resources\PhotoResource;
use App\Models\Album;
use App\Models\Photo;
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
}
