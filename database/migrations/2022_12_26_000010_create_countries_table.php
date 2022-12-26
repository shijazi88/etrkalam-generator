<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCountriesTable extends Migration
{
    public function up()
    {
        Schema::create('countries', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('arabic_name');
            $table->string('english_name');
            $table->string('dial_code')->unique();
            $table->string('code');
            $table->timestamps();
            $table->softDeletes();
        });
    }
}
