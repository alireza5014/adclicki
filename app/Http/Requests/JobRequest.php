<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class JobRequest extends FormRequest
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

//            'title' => 'required|unique:jobs',
            'main_image' => 'required',
            'lat' => 'required',
            'lon' => 'required',
            'city_id' => 'required',
            'state_id' => 'required',
            'category_id' => 'required',
            'sub_category_id' => 'required',
//            'description' => 'required',
            'mobile' => 'required',

//            'from_time' => 'required',
            'address' => 'required|min:5',

//            'key_words' => 'required|min:10',
//            'meta_description' => 'required|min:10',



        ];
    }
}
