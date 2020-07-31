<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class HotelRequest extends FormRequest
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
        $checkHotel = ($this->hotel ? ",{$this->hotel->id}" : '');

        return [
            'type_id' => 'required',
            'name' => 'required|string|max:100|min:5|unique:hotels,name' . $checkHotel,
            'email' => 'required|email|unique:hotels,email' . $checkHotel,
            'phone' => 'required|numeric|min:10|unique:hotels,phone' . $checkHotel,
            'address' => 'required|string|min:10|max:30|unique:hotels,address' . $checkHotel,
        ];
    }
}
