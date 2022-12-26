@extends('layouts.admin')
@section('content')

<div class="card">
    <div class="card-header">
        {{ trans('global.show') }} {{ trans('cruds.competition.title') }}
    </div>

    <div class="card-body">
        <div class="form-group">
            <div class="form-group">
                <a class="btn btn-default" href="{{ route('admin.competitions.index') }}">
                    {{ trans('global.back_to_list') }}
                </a>
            </div>
            <table class="table table-bordered table-striped">
                <tbody>
                    <tr>
                        <th>
                            {{ trans('cruds.competition.fields.id') }}
                        </th>
                        <td>
                            {{ $competition->id }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.competition.fields.participant') }}
                        </th>
                        <td>
                            {{ $competition->participant->name ?? '' }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.competition.fields.type') }}
                        </th>
                        <td>
                            {{ App\Models\Competition::TYPE_SELECT[$competition->type] ?? '' }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.competition.fields.status') }}
                        </th>
                        <td>
                            {{ App\Models\Competition::STATUS_SELECT[$competition->status] ?? '' }}
                        </td>
                    </tr>
                </tbody>
            </table>
            <div class="form-group">
                <a class="btn btn-default" href="{{ route('admin.competitions.index') }}">
                    {{ trans('global.back_to_list') }}
                </a>
            </div>
        </div>
    </div>
</div>



@endsection