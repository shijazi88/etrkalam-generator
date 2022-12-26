<?php

namespace App\Http\Requests;

use App\Models\Country;
use Gate;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Response;

class UpdateCountryRequest extends FormRequest
{
    public function authorize()
    {
        return Gate::allows('country_edit');
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
                'unique:countries,dial_code,' . request()->route('country')->id,
            ],
            'code' => [
                'string',
                'required',
            ],
        ];
    }
}
