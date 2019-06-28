<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ClickCalculateRequest extends FormRequest
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
           'click_count'=>'required|integer|min:200|max:200000'
        ];
    }
}
