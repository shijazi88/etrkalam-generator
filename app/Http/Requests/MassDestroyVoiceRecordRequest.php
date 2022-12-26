<?php

namespace App\Http\Requests;

use App\Models\VoiceRecord;
use Gate;
use Illuminate\Foundation\Http\FormRequest;
use Symfony\Component\HttpFoundation\Response;

class MassDestroyVoiceRecordRequest extends FormRequest
{
    public function authorize()
    {
        abort_if(Gate::denies('voice_record_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return true;
    }

    public function rules()
    {
        return [
            'ids'   => 'required|array',
            'ids.*' => 'exists:voice_records,id',
        ];
    }
}
