<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class FreeJobRequest extends FormRequest
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
            'title' => 'required|unique:jobs',
            'main_image' => 'required',
            'lat' => 'required',
            'lon' => 'required',
            'city_id' => 'required',
            'state_id' => 'required',
            'category_id' => 'required',
            'sub_category_id' => 'required',
            'description' => 'required',
            'mobile' => 'required|unique:users|min:11|max:11',

            'address' => 'required|min:5',

        ];
    }
}
