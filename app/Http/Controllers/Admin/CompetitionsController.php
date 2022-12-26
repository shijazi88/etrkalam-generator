<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\MassDestroyCompetitionRequest;
use App\Http\Requests\StoreCompetitionRequest;
use App\Http\Requests\UpdateCompetitionRequest;
use App\Models\Competition;
use App\Models\Participant;
use Gate;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class CompetitionsController extends Controller
{
    public function index()
    {
        abort_if(Gate::denies('competition_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $competitions = Competition::with(['participant'])->get();

        return view('admin.competitions.index', compact('competitions'));
    }

    public function create()
    {
        abort_if(Gate::denies('competition_create'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $participants = Participant::pluck('name', 'id')->prepend(trans('global.pleaseSelect'), '');

        return view('admin.competitions.create', compact('participants'));
    }

    public function store(StoreCompetitionRequest $request)
    {
        $competition = Competition::create($request->all());

        return redirect()->route('admin.competitions.index');
    }

    public function edit(Competition $competition)
    {
        abort_if(Gate::denies('competition_edit'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $participants = Participant::pluck('name', 'id')->prepend(trans('global.pleaseSelect'), '');

        $competition->load('participant');

        return view('admin.competitions.edit', compact('competition', 'participants'));
    }

    public function update(UpdateCompetitionRequest $request, Competition $competition)
    {
        $competition->update($request->all());

        return redirect()->route('admin.competitions.index');
    }

    public function show(Competition $competition)
    {
        abort_if(Gate::denies('competition_show'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $competition->load('participant');

        return view('admin.competitions.show', compact('competition'));
    }

    public function destroy(Competition $competition)
    {
        abort_if(Gate::denies('competition_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $competition->delete();

        return back();
    }

    public function massDestroy(MassDestroyCompetitionRequest $request)
    {
        Competition::whereIn('id', request('ids'))->delete();

        return response(null, Response::HTTP_NO_CONTENT);
    }
}
