<?php

namespace App\Http\Requests;

use App\Models\Participant;
use Gate;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Response;

class UpdateParticipantRequest extends FormRequest
{
    public function authorize()
    {
        return Gate::allows('participant_edit');
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
                'unique:participants,email,' . request()->route('participant')->id,
            ],
        ];
    }
}
