<?php

namespace App\Events\Song;

use App\Events\BaseEvent as Event;
use App\Models\Song;
use App\Transformers\SongTransformer;


abstract class SongEvent extends Event
{
    /**
     * Create a new event instance.
     *
     * @param Song $song The song that has been updated.
     */
    public function __construct(Song $song)
    {
        $this->model = $song;
        $this->transformer = new SongTransformer();
    }

    /**
     * Get the channels the event should broadcast on.
     *
     * @return Channel|array
     */
    public function broadcastOn()
    {
        return ['song'];
    }
}