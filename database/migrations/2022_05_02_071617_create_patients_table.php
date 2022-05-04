<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('Patient', function (Blueprint $table) {
            $table->string("name");
            $table->string("email");
            $table->string("address");
            $table->string("phoneNumber");
            $table->string("blood");
            $table->string("sex");
            $table->integer("age");
            $table->string("patientsStatements");
            $table->id("patient_id");
            $table->foreignId("doctor_id");
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('patients');
    }
};
