<?php

namespace App\Events\Artist;

use App\Events\BaseEvent as Event;
use App\Models\Artist;
use App\Transformers\ArtistTransformer;


abstract class ArtistEvent extends Event
{
    /**
     * Create a new event instance.
     *
     * @param Artist $artist The artist that has been updated.
     */
    public function __construct(Artist $artist)
    {
        $this->model = $artist;
        $this->transformer = new ArtistTransformer();
    }

    /**
     * Get the channels the event should broadcast on.
     *
     * @return Channel|array
     */
    public function broadcastOn()
    {
        return ['artist'];
    }
}