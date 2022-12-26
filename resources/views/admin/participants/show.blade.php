@extends('layouts.admin')
@section('content')

<div class="card">
    <div class="card-header">
        {{ trans('global.show') }} {{ trans('cruds.participant.title') }}
    </div>

    <div class="card-body">
        <div class="form-group">
            <div class="form-group">
                <a class="btn btn-default" href="{{ route('admin.participants.index') }}">
                    {{ trans('global.back_to_list') }}
                </a>
            </div>
            <table class="table table-bordered table-striped">
                <tbody>
                    <tr>
                        <th>
                            {{ trans('cruds.participant.fields.id') }}
                        </th>
                        <td>
                            {{ $participant->id }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.participant.fields.name') }}
                        </th>
                        <td>
                            {{ $participant->name }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.participant.fields.email') }}
                        </th>
                        <td>
                            {{ $participant->email }}
                        </td>
                    </tr>
                </tbody>
            </table>
            <div class="form-group">
                <a class="btn btn-default" href="{{ route('admin.participants.index') }}">
                    {{ trans('global.back_to_list') }}
                </a>
            </div>
        </div>
    </div>
</div>

<div class="card">
    <div class="card-header">
        {{ trans('global.relatedData') }}
    </div>
    <ul class="nav nav-tabs" role="tablist" id="relationship-tabs">
        <li class="nav-item">
            <a class="nav-link" href="#participant_voice_records" role="tab" data-toggle="tab">
                {{ trans('cruds.voiceRecord.title') }}
            </a>
        </li>
    </ul>
    <div class="tab-content">
        <div class="tab-pane" role="tabpanel" id="participant_voice_records">
            @includeIf('admin.participants.relationships.participantVoiceRecords', ['voiceRecords' => $participant->participantVoiceRecords])
        </div>
    </div>
</div>

@endsection