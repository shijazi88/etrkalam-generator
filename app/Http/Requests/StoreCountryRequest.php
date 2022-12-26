<?php

namespace App\Http\Requests;

use App\Models\Country;
use Gate;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Response;

class StoreCountryRequest extends FormRequest
{
    public function authorize()
    {
        return Gate::allows('country_create');
    }

    public function rules()
    {
        return [
            'arabic_name' => [
                'string',
                'required',
            ],
            'english_name' => [
                'string',
                'required',
            ],
            'dial_code' => [
                'string',
                'required',
                'unique:countries',
            ],
            'code' => [
                'string',
                'required',
            ],
        ];
    }
}
