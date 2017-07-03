<?php

namespace App\Http\Controllers\Songs;

use App\Http\Controllers\BaseController as Controller;
use App\Http\Requests\Album\ShowRequest;
use App\Models\Song;
use App\Transformers\AlbumTransformer;
use Illuminate\Http\JsonResponse;

class AlbumsController extends Controller
{
    /**
     * @var AlbumTransformer The transformer used to transform the model.
     */
    protected $transformer;

    /**
     * The constructor for the controller.
     *
     * @param AlbumTransformer $transformer The transformer used to transform the model.
     */
    public function __construct(AlbumTransformer $transformer)
    {
        $this->transformer = $transformer;
    }

    /**
     * Display the specified resource.
     *
     * @param ShowRequest $request
     * @param  Song $song
     *
     * @return JsonResponse
     */
    public function show(ShowRequest $request, Song $song): JsonResponse
    {
        $album = $song->album;

        return $this->respond($this->transformer->transform($album));
    }
}
