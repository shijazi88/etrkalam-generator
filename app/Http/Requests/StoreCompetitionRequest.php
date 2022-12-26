<?php

namespace App\Http\Requests;

use App\Models\Competition;
use Gate;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Response;

class StoreCompetitionRequest extends FormRequest
{
    public function authorize()
    {
        return Gate::allows('competition_create');
    }

    public function rules()
    {
        return [
            'participant_id' => [
                'required',
                'integer',
            ],
            'type' => [
                'required',
            ],
            'status' => [
                'required',
            ],
        ];
    }
}
