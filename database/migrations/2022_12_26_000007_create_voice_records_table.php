<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateVoiceRecordsTable extends Migration
{
    public function up()
    {
        Schema::create('voice_records', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('phase')->nullable();
            $table->timestamps();
            $table->softDeletes();
        });
    }
}
