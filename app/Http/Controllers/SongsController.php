<?php

namespace App\Http\Controllers;

use App\Http\Controllers\BaseController as Controller;
use App\Http\Requests\Song\DestroyRequest;
use App\Http\Requests\Song\IndexRequest;
use App\Http\Requests\Song\ShowRequest;
use App\Http\Requests\Song\StoreRequest;
use App\Http\Requests\Song\UpdateRequest;
use App\Models\Song;
use App\Transformers\SongTransformer;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\Input;

class SongsController extends Controller
{
    /**
     * @var SongTransformer The transformer used to transform the model.
     */
    protected $transformer;

    /**
     * The constructor for the controller.
     *
     * @param SongTransformer $transformer The transformer used to transform the model.
     */
    public function __construct(SongTransformer $transformer)
    {
        $this->transformer = $transformer;
    }

    /**
     * Display a listing of the resource.
     *
     * @param IndexRequest $request
     *
     * @return JsonResponse
     */
    public function index(IndexRequest $request) : JsonResponse
    {
        if (Input::get('limit')) {
            $this->setPagination(Input::get('limit'));
        }

        $pagination = Input::get('q') ?
            Song::search(Input::get('q'))->paginate($this->getPagination()) :
            Song::paginate($this->getPagination());

        $songs = $this->transformer->transformCollection(collect($pagination->items()));

        return $this->respondWithPagination($pagination, [
            'data' => $songs,
        ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param StoreRequest $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function store(StoreRequest $request)
    {
        $song = new Song($request->all());
        $song->album()->associate($request->get('album_id'));
        $song->save();

        return $this->respondCreated('The song has been created');
    }

    /**
     * Display the specified resource.
     *
     * @param ShowRequest $request
     * @param  Song       $song
     * @return JsonResponse
     */
    public function show(ShowRequest $request, Song $song) : JsonResponse
    {
        return $this->respond($this->transformer->transform($song));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param UpdateRequest $request
     * @param Song          $song
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function update(UpdateRequest $request, Song $song)
    {
        $song->fill($request->all());
        $song->album()->associate($request->get('album_id'));
        $song->save();

        return $this->respondCreated('The song has been updated');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param DestroyRequest $request
     * @param Song           $song
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function destroy(DestroyRequest $request, Song $song)
    {
        $song->delete();

        return $this->respondWithSuccess('The song has been deleted');
    }
}
