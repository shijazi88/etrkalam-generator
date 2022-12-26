<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\MassDestroyParticipantRequest;
use App\Http\Requests\StoreParticipantRequest;
use App\Http\Requests\UpdateParticipantRequest;
use App\Models\Participant;
use Gate;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use Yajra\DataTables\Facades\DataTables;

class ParticipantsController extends Controller
{
    public function index(Request $request)
    {
        abort_if(Gate::denies('participant_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        if ($request->ajax()) {
            $query = Participant::query()->select(sprintf('%s.*', (new Participant())->table));
            $table = Datatables::of($query);

            $table->addColumn('placeholder', '&nbsp;');
            $table->addColumn('actions', '&nbsp;');

            $table->editColumn('actions', function ($row) {
                $viewGate = 'participant_show';
                $editGate = 'participant_edit';
                $deleteGate = 'participant_delete';
                $crudRoutePart = 'participants';

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
            $table->editColumn('email', function ($row) {
                return $row->email ? $row->email : '';
            });

            $table->rawColumns(['actions', 'placeholder']);

            return $table->make(true);
        }

        return view('admin.participants.index');
    }

    public function create()
    {
        abort_if(Gate::denies('participant_create'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return view('admin.participants.create');
    }

    public function store(StoreParticipantRequest $request)
    {
        $participant = Participant::create($request->all());

        return redirect()->route('admin.participants.index');
    }

    public function edit(Participant $participant)
    {
        abort_if(Gate::denies('participant_edit'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return view('admin.participants.edit', compact('participant'));
    }

    public function update(UpdateParticipantRequest $request, Participant $participant)
    {
        $participant->update($request->all());

        return redirect()->route('admin.participants.index');
    }

    public function show(Participant $participant)
    {
        abort_if(Gate::denies('participant_show'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $participant->load('participantVoiceRecords');

        return view('admin.participants.show', compact('participant'));
    }

    public function destroy(Participant $participant)
    {
        abort_if(Gate::denies('participant_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $participant->delete();

        return back();
    }

    public function massDestroy(MassDestroyParticipantRequest $request)
    {
        Participant::whereIn('id', request('ids'))->delete();

        return response(null, Response::HTTP_NO_CONTENT);
    }
}
