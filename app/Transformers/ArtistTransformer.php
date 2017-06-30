<?php

namespace App\Transformers;

use App\Transformers\BaseTransformer as Transformer;

class ArtistTransformer extends Transformer
{
    /**
     * {@inheritdoc}
     */
    public function transform($artist) : array
    {
        return [
            'id'         => (int) $artist->id,
            'first_name' => $artist->first_name,
            'last_name'  => $artist->last_name,
            'biography'  => $artist->biography,
            'birthday'   => $artist->birthday ? $artist->birthday->toDateString() : null,
            'gender'     => ucfirst($artist->gender),
        ];
    }
}