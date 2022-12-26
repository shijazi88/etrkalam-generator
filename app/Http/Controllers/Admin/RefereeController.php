<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\MassDestroyRefereeRequest;
use App\Http\Requests\StoreRefereeRequest;
use App\Http\Requests\UpdateRefereeRequest;
use App\Models\Referee;
use Gate;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use Yajra\DataTables\Facades\DataTables;

class RefereeController extends Controller
{
    public function index(Request $request)
    {
        abort_if(Gate::denies('referee_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        if ($request->ajax()) {
            $query = Referee::query()->select(sprintf('%s.*', (new Referee())->table));
            $table = Datatables::of($query);

            $table->addColumn('placeholder', '&nbsp;');
            $table->addColumn('actions', '&nbsp;');

            $table->editColumn('actions', function ($row) {
                $viewGate = 'referee_show';
                $editGate = 'referee_edit';
                $deleteGate = 'referee_delete';
                $crudRoutePart = 'referees';

                return view('partials.datatablesActions', compact(
                'viewGate',
                'editGate',
                'deleteGate',
                'crudRoutePart',
                'row'
            ));
            });

            $table->editColumn('id', function ($row) {
                return $row->id ? $row->id : '';
            });
            $table->editColumn('name', function ($row) {
                return $row->name ? $row->name : '';
            });
            $table->editColumn('type', function ($row) {
                return $row->type ? Referee::TYPE_SELECT[$row->type] : '';
            });
            $table->editColumn('email', function ($row) {
                return $row->email ? $row->email : '';
            });

            $table->rawColumns(['actions', 'placeholder']);

            return $table->make(true);
        }

        return view('admin.referees.index');
    }

    public function create()
    {
        abort_if(Gate::denies('referee_create'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return view('admin.referees.create');
    }

    public function store(StoreRefereeRequest $request)
    {
        $referee = Referee::create($request->all());

        return redirect()->route('admin.referees.index');
    }

    public function edit(Referee $referee)
    {
        abort_if(Gate::denies('referee_edit'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return view('admin.referees.edit', compact('referee'));
    }

    public function update(UpdateRefereeRequest $request, Referee $referee)
    {
        $referee->update($request->all());

        return redirect()->route('admin.referees.index');
    }

    public function show(Referee $referee)
    {
        abort_if(Gate::denies('referee_show'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return view('admin.referees.show', compact('referee'));
    }

    public function destroy(Referee $referee)
    {
        abort_if(Gate::denies('referee_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $referee->delete();

        return back();
    }

    public function massDestroy(MassDestroyRefereeRequest $request)
    {
        Referee::whereIn('id', request('ids'))->delete();

        return response(null, Response::HTTP_NO_CONTENT);
    }
}
