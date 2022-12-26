<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddRelationshipFieldsToVoiceRecordsTable extends Migration
{
    public function up()
    {
        Schema::table('voice_records', function (Blueprint $table) {
            $table->unsignedBigInteger('participant_id')->nullable();
            $table->foreign('participant_id', 'participant_fk_7750243')->references('id')->on('participants');
        });
    }
}
