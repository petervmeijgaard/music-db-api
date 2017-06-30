<?php

namespace App\Http\Requests\Song;

use App\Http\Requests\BaseRequest as Request;
use Illuminate\Validation\Rule;

class StoreRequest extends Request
{

    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'title'    => [
                'required',
            ],
            'album_id' => [
                'required',
                Rule::exists('albums', 'id'),
            ],
        ];
    }
}