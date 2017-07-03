<?php

namespace App\Http\Controllers\Albums;

use App\Http\Controllers\BaseController as Controller;
use App\Http\Requests\Artist\ShowRequest;
use App\Models\Album;
use App\Transformers\ArtistTransformer;
use Illuminate\Http\JsonResponse;

class ArtistsController extends Controller
{
    /**
     * @var ArtistTransformer The transformer used to transform the model.
     */
    protected $transformer;

    /**
     * The constructor for the controller.
     *
     * @param ArtistTransformer $transformer The transformer used to transform the model.
     */
    public function __construct(ArtistTransformer $transformer)
    {
        $this->transformer = $transformer;
    }

    /**
     * Display the specified resource.
     *
     * @param ShowRequest $request
     * @param Album       $album
     *
     * @return JsonResponse
     */
    public function show(ShowRequest $request, Album $album) : JsonResponse
    {
        $artist = $album->artist;

        return $this->respond($this->transformer->transform($artist));
    }
}
