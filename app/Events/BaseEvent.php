<?php

namespace App\Events;


use App\Transformers\BaseTransformer;
use Illuminate\Database\Eloquent\Model;

abstract class BaseEvent
{
    /**
     * @var Model The model that has been updated.
     */
    protected $model;

    /**
     * @var BaseTransformer The transformer used to transform the model.
     */
    protected $transformer;

    /**
     * The data being broadcasted.
     *
     * @return mixed[] The items being broadcasted.
     */
    public function broadcastWith()
    {
        return $this->transformer->transform($this->model);
    }
}