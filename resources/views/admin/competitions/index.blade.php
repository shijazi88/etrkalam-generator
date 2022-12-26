@extends('layouts.admin')
@section('content')
@can('competition_create')
    <div style="margin-bottom: 10px;" class="row">
        <div class="col-lg-12">
            <a class="btn btn-success" href="{{ route('admin.competitions.create') }}">
                {{ trans('global.add') }} {{ trans('cruds.competition.title_singular') }}
            </a>
        </div>
    </div>
@endcan
<div class="card">
    <div class="card-header">
        {{ trans('cruds.competition.title_singular') }} {{ trans('global.list') }}
    </div>

    <div class="card-body">
        <div class="table-responsive">
            <table class=" table table-bordered table-striped table-hover datatable datatable-Competition">
                <thead>
                    <tr>
                        <th width="10">

                        </th>
                        <th>
                            {{ trans('cruds.competition.fields.id') }}
                        </th>
                        <th>
                            {{ trans('cruds.competition.fields.participant') }}
                        </th>
                        <th>
                            {{ trans('cruds.competition.fields.type') }}
                        </th>
                        <th>
                            {{ trans('cruds.competition.fields.status') }}
                        </th>
                        <th>
                            &nbsp;
                        </th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($competitions as $key => $competition)
                        <tr data-entry-id="{{ $competition->id }}">
                            <td>

                            </td>
                            <td>
                                {{ $competition->id ?? '' }}
                            </td>
                            <td>
                                {{ $competition->participant->name ?? '' }}
                            </td>
                            <td>
                                {{ App\Models\Competition::TYPE_SELECT[$competition->type] ?? '' }}
                            </td>
                            <td>
                                {{ App\Models\Competition::STATUS_SELECT[$competition->status] ?? '' }}
                            </td>
                            <td>
                                @can('competition_show')
                                    <a class="btn btn-xs btn-primary" href="{{ route('admin.competitions.show', $competition->id) }}">
                                        {{ trans('global.view') }}
                                    </a>
                                @endcan

                                @can('competition_edit')
                                    <a class="btn btn-xs btn-info" href="{{ route('admin.competitions.edit', $competition->id) }}">
                                        {{ trans('global.edit') }}
                                    </a>
                                @endcan

                                @can('competition_delete')
                                    <form action="{{ route('admin.competitions.destroy', $competition->id) }}" method="POST" onsubmit="return confirm('{{ trans('global.areYouSure') }}');" style="display: inline-block;">
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



@endsection
@section('scripts')
@parent
<script>
    $(function () {
  let dtButtons = $.extend(true, [], $.fn.dataTable.defaults.buttons)
@can('competition_delete')
  let deleteButtonTrans = '{{ trans('global.datatables.delete') }}'
  let deleteButton = {
    text: deleteButtonTrans,
    url: "{{ route('admin.competitions.massDestroy') }}",
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
  let table = $('.datatable-Competition:not(.ajaxTable)').DataTable({ buttons: dtButtons })
  $('a[data-toggle="tab"]').on('shown.bs.tab click', function(e){
      $($.fn.dataTable.tables(true)).DataTable()
          .columns.adjust();
  });
  
})

</script>
@endsection