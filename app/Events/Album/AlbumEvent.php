<?php

namespace App\Events\Album;

use App\Events\BaseEvent as Event;
use App\Models\Album;
use App\Transformers\AlbumTransformer;


abstract class AlbumEvent extends Event
{
    /**
     * Create a new event instance.
     *
     * @param Album $album The album that has been updated.
     */
    public function __construct(Album $album)
    {
        $this->model = $album;
        $this->transformer = new AlbumTransformer();
    }

    /**
     * Get the channels the event should broadcast on.
     *
     * @return Channel|array
     */
    public function broadcastOn()
    {
        return ['album'];
    }
}