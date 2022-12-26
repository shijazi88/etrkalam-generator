<?php

namespace App\Http\Requests;

use App\Models\Participant;
use Gate;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Response;

class StoreParticipantRequest extends FormRequest
{
    public function authorize()
    {
        return Gate::allows('participant_create');
    }

    public function rules()
    {
        return [
            'name' => [
                'string',
                'nullable',
            ],
            'email' => [
                'string',
                'required',
                'unique:participants',
            ],
        ];
    }
}
