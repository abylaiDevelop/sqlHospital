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
        Schema::create('PatientsRecord', function (Blueprint $table) {
            $table->id("record_id");
            $table->string("patientDiagnos");
            $table->dateTime("observationDate");
            $table->string("Appointment");
            $table->foreignId("patient_id");
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('patients_records');
    }
};
