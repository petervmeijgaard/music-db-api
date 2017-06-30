<?php

namespace App\Transformers;

use Illuminate\Support\Collection;

abstract class BaseTransformer
{
    /**
     * Method used to transform a collection of items.
     *
     * @param Collection $items The items in a collection.
     *
     * @return Collection The transformed collection.
     */
    public function transformCollection(Collection $items) : Collection
    {
        return $items->map(function ($item) {
            return $this->transform($item);
        });
    }

    /**
     * Method used to transform an item.
     *
     * @param $item mixed The item to be transformed.
     *
     * @return array The transformed item.
     */
    abstract public function transform($item) : array;
}