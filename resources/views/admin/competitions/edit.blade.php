@extends('layouts.admin')
@section('content')

<div class="card">
    <div class="card-header">
        {{ trans('global.edit') }} {{ trans('cruds.competition.title_singular') }}
    </div>

    <div class="card-body">
        <form method="POST" action="{{ route("admin.competitions.update", [$competition->id]) }}" enctype="multipart/form-data">
            @method('PUT')
            @csrf
            <div class="form-group">
                <label class="required" for="participant_id">{{ trans('cruds.competition.fields.participant') }}</label>
                <select class="form-control select2 {{ $errors->has('participant') ? 'is-invalid' : '' }}" name="participant_id" id="participant_id" required>
                    @foreach($participants as $id => $entry)
                        <option value="{{ $id }}" {{ (old('participant_id') ? old('participant_id') : $competition->participant->id ?? '') == $id ? 'selected' : '' }}>{{ $entry }}</option>
                    @endforeach
                </select>
                @if($errors->has('participant'))
                    <div class="invalid-feedback">
                        {{ $errors->first('participant') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.competition.fields.participant_helper') }}</span>
            </div>
            <div class="form-group">
                <label class="required">{{ trans('cruds.competition.fields.type') }}</label>
                <select class="form-control {{ $errors->has('type') ? 'is-invalid' : '' }}" name="type" id="type" required>
                    <option value disabled {{ old('type', null) === null ? 'selected' : '' }}>{{ trans('global.pleaseSelect') }}</option>
                    @foreach(App\Models\Competition::TYPE_SELECT as $key => $label)
                        <option value="{{ $key }}" {{ old('type', $competition->type) === (string) $key ? 'selected' : '' }}>{{ $label }}</option>
                    @endforeach
                </select>
                @if($errors->has('type'))
                    <div class="invalid-feedback">
                        {{ $errors->first('type') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.competition.fields.type_helper') }}</span>
            </div>
            <div class="form-group">
                <label class="required">{{ trans('cruds.competition.fields.status') }}</label>
                <select class="form-control {{ $errors->has('status') ? 'is-invalid' : '' }}" name="status" id="status" required>
                    <option value disabled {{ old('status', null) === null ? 'selected' : '' }}>{{ trans('global.pleaseSelect') }}</option>
                    @foreach(App\Models\Competition::STATUS_SELECT as $key => $label)
                        <option value="{{ $key }}" {{ old('status', $competition->status) === (string) $key ? 'selected' : '' }}>{{ $label }}</option>
                    @endforeach
                </select>
                @if($errors->has('status'))
                    <div class="invalid-feedback">
                        {{ $errors->first('status') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.competition.fields.status_helper') }}</span>
            </div>
            <div class="form-group">
                <button class="btn btn-danger" type="submit">
                    {{ trans('global.save') }}
                </button>
            </div>
        </form>
    </div>
</div>



@endsection