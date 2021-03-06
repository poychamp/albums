<?php

namespace App\Http\Controllers;

use App\Http\Resources\PhotoResource;
use App\Models\Photo;
use Illuminate\Http\Request;

class PhotoController extends Controller
{
    /**
     * @param \App\Models\Photo $photo
     *
     * @return \App\Http\Resources\PhotoResource
     */
    public function show(Photo $photo)
    {
        return new PhotoResource($photo);
    }

    public function update(Photo $photo, Request $request)
    {
        $data = $request->validate([
            'title'         => ['required'],
            'url'           => ['required', 'url'],
            'thumbnail_url' => ['required', 'url'],
        ]);

        $photo->update($data);

        return new PhotoResource($photo);
    }

    /**
     * @param \App\Models\Photo $photo
     *
     * @return \Illuminate\Http\JsonResponse
     * @throws \Exception
     */
    public function destroy(Photo $photo)
    {
        $photo->delete();

        return response()->json([
            'success' => true,
        ]);
    }
}
