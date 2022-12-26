<?php

namespace App\Http\Requests;

use App\Models\Referee;
use Gate;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Response;

class StoreRefereeRequest extends FormRequest
{
    public function authorize()
    {
        return Gate::allows('referee_create');
    }

    public function rules()
    {
        return [
            'name' => [
                'string',
                'required',
            ],
            'type' => [
                'required',
            ],
            'email' => [
                'required',
                'unique:referees',
            ],
            'password' => [
                'required',
            ],
        ];
    }
}
