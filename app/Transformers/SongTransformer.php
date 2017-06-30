<?php

namespace App\Transformers;

use App\Transformers\BaseTransformer as Transformer;

class SongTransformer extends Transformer
{
    /**
     * {@inheritdoc}
     */
    public function transform($song) : array
    {
        return [
            'id'    => (int) $song->id,
            'title' => $song->title,
        ];
    }
}