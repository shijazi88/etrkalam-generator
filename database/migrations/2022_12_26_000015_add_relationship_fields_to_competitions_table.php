<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddRelationshipFieldsToCompetitionsTable extends Migration
{
    public function up()
    {
        Schema::table('competitions', function (Blueprint $table) {
            $table->unsignedBigInteger('participant_id')->nullable();
            $table->foreign('participant_id', 'participant_fk_7759208')->references('id')->on('participants');
        });
    }
}
