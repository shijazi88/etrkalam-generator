<?php

namespace App\Http\Requests;

use App\Models\VoiceRecord;
use Gate;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Response;

class StoreVoiceRecordRequest extends FormRequest
{
    public function authorize()
    {
        return Gate::allows('voice_record_create');
    }

    public function rules()
    {
        return [
            'participant_id' => [
                'required',
                'integer',
            ],
            'file_url' => [
                'required',
            ],
        ];
    }
}
