<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Controllers\Traits\MediaUploadingTrait;
use App\Http\Requests\MassDestroyVoiceRecordRequest;
use App\Http\Requests\StoreVoiceRecordRequest;
use App\Http\Requests\UpdateVoiceRecordRequest;
use App\Models\Participant;
use App\Models\VoiceRecord;
use Gate;
use Illuminate\Http\Request;
use Spatie\MediaLibrary\MediaCollections\Models\Media;
use Symfony\Component\HttpFoundation\Response;
use Yajra\DataTables\Facades\DataTables;

class VoiceRecordsController extends Controller
{
    use MediaUploadingTrait;

    public function index(Request $request)
    {
        abort_if(Gate::denies('voice_record_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        if ($request->ajax()) {
            $query = VoiceRecord::with(['participant'])->select(sprintf('%s.*', (new VoiceRecord())->table));
            $table = Datatables::of($query);

            $table->addColumn('placeholder', '&nbsp;');
            $table->addColumn('actions', '&nbsp;');

            $table->editColumn('actions', function ($row) {
                $viewGate = 'voice_record_show';
                $editGate = 'voice_record_edit';
                $deleteGate = 'voice_record_delete';
                $crudRoutePart = 'voice-records';

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
            $table->addColumn('participant_name', function ($row) {
                return $row->participant ? $row->participant->name : '';
            });

            $table->editColumn('participant.email', function ($row) {
                return $row->participant ? (is_string($row->participant) ? $row->participant : $row->participant->email) : '';
            });
            $table->editColumn('phase', function ($row) {
                return $row->phase ? $row->phase : '';
            });

            $table->rawColumns(['actions', 'placeholder', 'participant']);

            return $table->make(true);
        }

        return view('admin.voiceRecords.index');
    }

    public function create()
    {
        abort_if(Gate::denies('voice_record_create'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $participants = Participant::pluck('name', 'id')->prepend(trans('global.pleaseSelect'), '');

        return view('admin.voiceRecords.create', compact('participants'));
    }

    public function store(StoreVoiceRecordRequest $request)
    {
        $voiceRecord = VoiceRecord::create($request->all());

        if ($request->input('file_url', false)) {
            $voiceRecord->addMedia(storage_path('tmp/uploads/' . basename($request->input('file_url'))))->toMediaCollection('file_url');
        }

        if ($media = $request->input('ck-media', false)) {
            Media::whereIn('id', $media)->update(['model_id' => $voiceRecord->id]);
        }

        return redirect()->route('admin.voice-records.index');
    }

    public function edit(VoiceRecord $voiceRecord)
    {
        abort_if(Gate::denies('voice_record_edit'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $participants = Participant::pluck('name', 'id')->prepend(trans('global.pleaseSelect'), '');

        $voiceRecord->load('participant');

        return view('admin.voiceRecords.edit', compact('participants', 'voiceRecord'));
    }

    public function update(UpdateVoiceRecordRequest $request, VoiceRecord $voiceRecord)
    {
        $voiceRecord->update($request->all());

        if ($request->input('file_url', false)) {
            if (!$voiceRecord->file_url || $request->input('file_url') !== $voiceRecord->file_url->file_name) {
                if ($voiceRecord->file_url) {
                    $voiceRecord->file_url->delete();
                }
                $voiceRecord->addMedia(storage_path('tmp/uploads/' . basename($request->input('file_url'))))->toMediaCollection('file_url');
            }
        } elseif ($voiceRecord->file_url) {
            $voiceRecord->file_url->delete();
        }

        return redirect()->route('admin.voice-records.index');
    }

    public function show(VoiceRecord $voiceRecord)
    {
        abort_if(Gate::denies('voice_record_show'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $voiceRecord->load('participant');

        return view('admin.voiceRecords.show', compact('voiceRecord'));
    }

    public function destroy(VoiceRecord $voiceRecord)
    {
        abort_if(Gate::denies('voice_record_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $voiceRecord->delete();

        return back();
    }

    public function massDestroy(MassDestroyVoiceRecordRequest $request)
    {
        VoiceRecord::whereIn('id', request('ids'))->delete();

        return response(null, Response::HTTP_NO_CONTENT);
    }

    public function storeCKEditorImages(Request $request)
    {
        abort_if(Gate::denies('voice_record_create') && Gate::denies('voice_record_edit'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $model         = new VoiceRecord();
        $model->id     = $request->input('crud_id', 0);
        $model->exists = true;
        $media         = $model->addMediaFromRequest('upload')->toMediaCollection('ck-media');

        return response()->json(['id' => $media->id, 'url' => $media->getUrl()], Response::HTTP_CREATED);
    }
}
