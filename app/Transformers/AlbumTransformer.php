<?php

namespace App\Transformers;

use App\Transformers\BaseTransformer as Transformer;

class AlbumTransformer extends Transformer
{
    /**
     * {@inheritdoc}
     */
    public function transform($album) : array
    {
        return [
            'id'           => (int) $album->id,
            'title'        => $album->title,
            'release_date' => $album->release_date->toDateString(),
        ];
    }
}