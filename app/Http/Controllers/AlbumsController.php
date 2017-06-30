<?php

namespace App\Http\Controllers;

use App\Http\Controllers\BaseController as Controller;
use App\Http\Requests\Album\DestroyRequest;
use App\Http\Requests\Album\IndexRequest;
use App\Http\Requests\Album\ShowRequest;
use App\Http\Requests\Album\StoreRequest;
use App\Http\Requests\Album\UpdateRequest;
use App\Models\Album;
use App\Models\Artist;
use App\Transformers\AlbumTransformer;
use Carbon\Carbon;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\Input;

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
            Album::search(Input::get('q'))->paginate($this->getPagination()) :
            Album::paginate($this->getPagination());

        $albums = $this->transformer->transformCollection(collect($pagination->items()));

        return $this->respondWithPagination($pagination, [
            'data' => $albums,
        ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param StoreRequest $request
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function store(StoreRequest $request)
    {
        $album = new Album($request->except('release_date'));
        $album->release_date = new Carbon($request->release_date);
        $album->artist()->associate($request->get('artist_id'));
        $album->save();

        return $this->respondCreated('The album has been created');
    }

    /**
     * Display the specified resource.
     *
     * @param ShowRequest $request
     * @param  Album      $album
     *
     * @return JsonResponse
     */
    public function show(ShowRequest $request, Album $album) : JsonResponse
    {
        return $this->respond($this->transformer->transform($album));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param UpdateRequest $request
     * @param Album         $album
     * @return \Illuminate\Http\JsonResponse
     */
    public function update(UpdateRequest $request, Album $album)
    {
        $album->fill($request->except('release_date'));
        $album->release_date = new Carbon($request->release_date);
        $album->artist()->associate($request->get('artist_id'));
        $album->save();

        return $this->respondCreated('The album has been updated');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param DestroyRequest $request
     * @param Album          $album
     * @return \Illuminate\Http\JsonResponse
     */
    public function destroy(DestroyRequest $request, Album $album)
    {
        $album->delete();

        return $this->respondWithSuccess('The album has been deleted');
    }
}
