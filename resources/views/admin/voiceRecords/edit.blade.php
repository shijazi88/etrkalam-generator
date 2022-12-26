@extends('layouts.admin')
@section('content')

<div class="card">
    <div class="card-header">
        {{ trans('global.edit') }} {{ trans('cruds.voiceRecord.title_singular') }}
    </div>

    <div class="card-body">
        <form method="POST" action="{{ route("admin.voice-records.update", [$voiceRecord->id]) }}" enctype="multipart/form-data">
            @method('PUT')
            @csrf
            <div class="form-group">
                <label class="required" for="participant_id">{{ trans('cruds.voiceRecord.fields.participant') }}</label>
                <select class="form-control select2 {{ $errors->has('participant') ? 'is-invalid' : '' }}" name="participant_id" id="participant_id" required>
                    @foreach($participants as $id => $entry)
                        <option value="{{ $id }}" {{ (old('participant_id') ? old('participant_id') : $voiceRecord->participant->id ?? '') == $id ? 'selected' : '' }}>{{ $entry }}</option>
                    @endforeach
                </select>
                @if($errors->has('participant'))
                    <div class="invalid-feedback">
                        {{ $errors->first('participant') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.voiceRecord.fields.participant_helper') }}</span>
            </div>
            <div class="form-group">
                <label class="required" for="file_url">{{ trans('cruds.voiceRecord.fields.file_url') }}</label>
                <div class="needsclick dropzone {{ $errors->has('file_url') ? 'is-invalid' : '' }}" id="file_url-dropzone">
                </div>
                @if($errors->has('file_url'))
                    <div class="invalid-feedback">
                        {{ $errors->first('file_url') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.voiceRecord.fields.file_url_helper') }}</span>
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

@section('scripts')
<script>
    Dropzone.options.fileUrlDropzone = {
    url: '{{ route('admin.voice-records.storeMedia') }}',
    maxFilesize: 2, // MB
    maxFiles: 1,
    addRemoveLinks: true,
    headers: {
      'X-CSRF-TOKEN': "{{ csrf_token() }}"
    },
    params: {
      size: 2
    },
    success: function (file, response) {
      $('form').find('input[name="file_url"]').remove()
      $('form').append('<input type="hidden" name="file_url" value="' + response.name + '">')
    },
    removedfile: function (file) {
      file.previewElement.remove()
      if (file.status !== 'error') {
        $('form').find('input[name="file_url"]').remove()
        this.options.maxFiles = this.options.maxFiles + 1
      }
    },
    init: function () {
@if(isset($voiceRecord) && $voiceRecord->file_url)
      var file = {!! json_encode($voiceRecord->file_url) !!}
          this.options.addedfile.call(this, file)
      file.previewElement.classList.add('dz-complete')
      $('form').append('<input type="hidden" name="file_url" value="' + file.file_name + '">')
      this.options.maxFiles = this.options.maxFiles - 1
@endif
    },
     error: function (file, response) {
         if ($.type(response) === 'string') {
             var message = response //dropzone sends it's own error messages in string
         } else {
             var message = response.errors.file
         }
         file.previewElement.classList.add('dz-error')
         _ref = file.previewElement.querySelectorAll('[data-dz-errormessage]')
         _results = []
         for (_i = 0, _len = _ref.length; _i < _len; _i++) {
             node = _ref[_i]
             _results.push(node.textContent = message)
         }

         return _results
     }
}
</script>
@endsection