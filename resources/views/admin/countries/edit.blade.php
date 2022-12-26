@extends('layouts.admin')
@section('content')

<div class="card">
    <div class="card-header">
        {{ trans('global.edit') }} {{ trans('cruds.country.title_singular') }}
    </div>

    <div class="card-body">
        <form method="POST" action="{{ route("admin.countries.update", [$country->id]) }}" enctype="multipart/form-data">
            @method('PUT')
            @csrf
            <div class="form-group">
                <label class="required" for="arabic_name">{{ trans('cruds.country.fields.arabic_name') }}</label>
                <input class="form-control {{ $errors->has('arabic_name') ? 'is-invalid' : '' }}" type="text" name="arabic_name" id="arabic_name" value="{{ old('arabic_name', $country->arabic_name) }}" required>
                @if($errors->has('arabic_name'))
                    <div class="invalid-feedback">
                        {{ $errors->first('arabic_name') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.country.fields.arabic_name_helper') }}</span>
            </div>
            <div class="form-group">
                <label class="required" for="english_name">{{ trans('cruds.country.fields.english_name') }}</label>
                <input class="form-control {{ $errors->has('english_name') ? 'is-invalid' : '' }}" type="text" name="english_name" id="english_name" value="{{ old('english_name', $country->english_name) }}" required>
                @if($errors->has('english_name'))
                    <div class="invalid-feedback">
                        {{ $errors->first('english_name') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.country.fields.english_name_helper') }}</span>
            </div>
            <div class="form-group">
                <label class="required" for="dial_code">{{ trans('cruds.country.fields.dial_code') }}</label>
                <input class="form-control {{ $errors->has('dial_code') ? 'is-invalid' : '' }}" type="text" name="dial_code" id="dial_code" value="{{ old('dial_code', $country->dial_code) }}" required>
                @if($errors->has('dial_code'))
                    <div class="invalid-feedback">
                        {{ $errors->first('dial_code') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.country.fields.dial_code_helper') }}</span>
            </div>
            <div class="form-group">
                <label class="required" for="code">{{ trans('cruds.country.fields.code') }}</label>
                <input class="form-control {{ $errors->has('code') ? 'is-invalid' : '' }}" type="text" name="code" id="code" value="{{ old('code', $country->code) }}" required>
                @if($errors->has('code'))
                    <div class="invalid-feedback">
                        {{ $errors->first('code') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.country.fields.code_helper') }}</span>
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