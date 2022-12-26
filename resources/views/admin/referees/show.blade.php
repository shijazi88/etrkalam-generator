@extends('layouts.admin')
@section('content')

<div class="card">
    <div class="card-header">
        {{ trans('global.show') }} {{ trans('cruds.referee.title') }}
    </div>

    <div class="card-body">
        <div class="form-group">
            <div class="form-group">
                <a class="btn btn-default" href="{{ route('admin.referees.index') }}">
                    {{ trans('global.back_to_list') }}
                </a>
            </div>
            <table class="table table-bordered table-striped">
                <tbody>
                    <tr>
                        <th>
                            {{ trans('cruds.referee.fields.id') }}
                        </th>
                        <td>
                            {{ $referee->id }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.referee.fields.name') }}
                        </th>
                        <td>
                            {{ $referee->name }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.referee.fields.type') }}
                        </th>
                        <td>
                            {{ App\Models\Referee::TYPE_SELECT[$referee->type] ?? '' }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.referee.fields.email') }}
                        </th>
                        <td>
                            {{ $referee->email }}
                        </td>
                    </tr>
                </tbody>
            </table>
            <div class="form-group">
                <a class="btn btn-default" href="{{ route('admin.referees.index') }}">
                    {{ trans('global.back_to_list') }}
                </a>
            </div>
        </div>
    </div>
</div>



@endsection