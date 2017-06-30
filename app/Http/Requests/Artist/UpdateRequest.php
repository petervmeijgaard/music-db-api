<?php

namespace App\Http\Requests\Artist;

use App\Http\Requests\BaseRequest as Request;
use Illuminate\Validation\Rule;

class UpdateRequest extends Request
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
            'first_name' => [
                'required',
            ],
            'last_name'  => [
                'required',
            ],
            'biography'  => [
            ],
            'birthday'   => [
                'date',
            ],
            'gender'     => [
                'required',
                Rule::in(['Male', 'Female']),
            ],
        ];
    }
}