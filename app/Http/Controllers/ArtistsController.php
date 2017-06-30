<?php

namespace App\Http\Controllers;

use App\Http\Controllers\BaseController as Controller;
use App\Http\Requests\Artist\DestroyRequest;
use App\Http\Requests\Artist\IndexRequest;
use App\Http\Requests\Artist\ShowRequest;
use App\Http\Requests\Artist\StoreRequest;
use App\Http\Requests\Artist\UpdateRequest;
use App\Models\Artist;
use App\Transformers\ArtistTransformer;
use Carbon\Carbon;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\Input;

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
     * Display a listing of the resource.
     *
     * @param IndexRequest $request
     * @return JsonResponse
     */
    public function index(IndexRequest $request) : JsonResponse
    {
        if (Input::get('limit')) {
            $this->setPagination(Input::get('limit'));
        }

        $pagination = Input::get('q') ?
            Artist::search(Input::get('q'))->paginate($this->getPagination()) :
            Artist::paginate($this->getPagination());

        $artists = $this->transformer->transformCollection(collect($pagination->items()));

        return $this->respondWithPagination($pagination, [
            'data' => $artists,
        ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param StoreRequest $request
     *
     * @return JsonResponse
     */
    public function store(StoreRequest $request)
    {
        $artist = new Artist($request->except('birthday'));
        $artist->birthday = new Carbon($request->birthday);
        $artist->save();

        return $this->respondCreated('The artist has been created');
    }

    /**
     * Display the specified resource.
     *
     * @param ShowRequest $request
     * @param  Artist     $artist
     *
     * @return JsonResponse
     */
    public function show(ShowRequest $request, Artist $artist) : JsonResponse
    {
        return $this->respond($this->transformer->transform($artist));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param UpdateRequest $request
     * @param Artist        $artist
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function update(UpdateRequest $request, Artist $artist)
    {
        $artist->fill($request->except('birthday'));
        $artist->birthday = new Carbon($request->birthday);
        $artist->save();

        return $this->respondCreated('The artist has been updated');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param DestroyRequest $request
     * @param Artist         $artist
     *
     * @return JsonResponse
     */
    public function destroy(DestroyRequest $request, Artist $artist)
    {
        $artist->delete();

        return $this->respondWithSuccess('The artist has been deleted');
    }
}
