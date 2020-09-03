<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class RoomRequest extends FormRequest
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
            'rooms.*.name' => 'required|min:3|max:100',
            'rooms.*.adults' => 'required|numeric|min:0|max:5',
            'rooms.*.children' => 'required|numeric|min:0|max:5',
        ];
    }
}
