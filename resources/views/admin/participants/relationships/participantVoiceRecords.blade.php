@can('voice_record_create')
    <div style="margin-bottom: 10px;" class="row">
        <div class="col-lg-12">
            <a class="btn btn-success" href="{{ route('admin.voice-records.create') }}">
                {{ trans('global.add') }} {{ trans('cruds.voiceRecord.title_singular') }}
            </a>
        </div>
    </div>
@endcan

<div class="card">
    <div class="card-header">
        {{ trans('cruds.voiceRecord.title_singular') }} {{ trans('global.list') }}
    </div>

    <div class="card-body">
        <div class="table-responsive">
            <table class=" table table-bordered table-striped table-hover datatable datatable-participantVoiceRecords">
                <thead>
                    <tr>
                        <th width="10">

                        </th>
                        <th>
                            {{ trans('cruds.voiceRecord.fields.id') }}
                        </th>
                        <th>
                            {{ trans('cruds.voiceRecord.fields.participant') }}
                        </th>
                        <th>
                            {{ trans('cruds.participant.fields.email') }}
                        </th>
                        <th>
                            {{ trans('cruds.voiceRecord.fields.phase') }}
                        </th>
                        <th>
                            &nbsp;
                        </th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($voiceRecords as $key => $voiceRecord)
                        <tr data-entry-id="{{ $voiceRecord->id }}">
                            <td>

                            </td>
                            <td>
                                {{ $voiceRecord->id ?? '' }}
                            </td>
                            <td>
                                {{ $voiceRecord->participant->name ?? '' }}
                            </td>
                            <td>
                                {{ $voiceRecord->participant->email ?? '' }}
                            </td>
                            <td>
                                {{ $voiceRecord->phase ?? '' }}
                            </td>
                            <td>
                                @can('voice_record_show')
                                    <a class="btn btn-xs btn-primary" href="{{ route('admin.voice-records.show', $voiceRecord->id) }}">
                                        {{ trans('global.view') }}
                                    </a>
                                @endcan

                                @can('voice_record_edit')
                                    <a class="btn btn-xs btn-info" href="{{ route('admin.voice-records.edit', $voiceRecord->id) }}">
                                        {{ trans('global.edit') }}
                                    </a>
                                @endcan

                                @can('voice_record_delete')
                                    <form action="{{ route('admin.voice-records.destroy', $voiceRecord->id) }}" method="POST" onsubmit="return confirm('{{ trans('global.areYouSure') }}');" style="display: inline-block;">
                                        <input type="hidden" name="_method" value="DELETE">
                                        <input type="hidden" name="_token" value="{{ csrf_token() }}">
                                        <input type="submit" class="btn btn-xs btn-danger" value="{{ trans('global.delete') }}">
                                    </form>
                                @endcan

                            </td>

                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
</div>

@section('scripts')
@parent
<script>
    $(function () {
  let dtButtons = $.extend(true, [], $.fn.dataTable.defaults.buttons)
@can('voice_record_delete')
  let deleteButtonTrans = '{{ trans('global.datatables.delete') }}'
  let deleteButton = {
    text: deleteButtonTrans,
    url: "{{ route('admin.voice-records.massDestroy') }}",
    className: 'btn-danger',
    action: function (e, dt, node, config) {
      var ids = $.map(dt.rows({ selected: true }).nodes(), function (entry) {
          return $(entry).data('entry-id')
      });

      if (ids.length === 0) {
        alert('{{ trans('global.datatables.zero_selected') }}')

        return
      }

      if (confirm('{{ trans('global.areYouSure') }}')) {
        $.ajax({
          headers: {'x-csrf-token': _token},
          method: 'POST',
          url: config.url,
          data: { ids: ids, _method: 'DELETE' }})
          .done(function () { location.reload() })
      }
    }
  }
  dtButtons.push(deleteButton)
@endcan

  $.extend(true, $.fn.dataTable.defaults, {
    orderCellsTop: true,
    order: [[ 1, 'desc' ]],
    pageLength: 100,
  });
  let table = $('.datatable-participantVoiceRecords:not(.ajaxTable)').DataTable({ buttons: dtButtons })
  $('a[data-toggle="tab"]').on('shown.bs.tab click', function(e){
      $($.fn.dataTable.tables(true)).DataTable()
          .columns.adjust();
  });
  
})

</script>
@endsection