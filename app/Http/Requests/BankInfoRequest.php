<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class BankInfoRequest extends FormRequest
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
           'card_number'=>'required|min:16|max:16',
           'shaba_number'=>'required|min:26|max:26',
        ];
    }
}
