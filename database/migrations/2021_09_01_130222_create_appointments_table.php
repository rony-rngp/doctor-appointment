<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateAppointmentsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('appointments', function (Blueprint $table) {
            $table->id();
            $table->foreignId('patient_id');
            $table->foreignId('doctor_id')->constrained('doctors')->onDelete('cascade');
            $table->foreignId('schedule_id');
            $table->foreignId('day_id');
            $table->date('appointment_date');
            $table->float('fees');
            $table->string('clinic_name');
            $table->string('clinic_address');
            $table->string('schedule');
            $table->string('patient_name');
            $table->string('patient_phone');
            $table->string('patient_gender');
            $table->string('patient_dob');
            $table->string('patient_blood_group');
            $table->string('payment_method')->nullable();
            $table->string('payment_status')->nullable();
            $table->string('transaction_id')->nullable();
            $table->string('currency')->nullable();
            $table->string('status')->default('Pending');
            $table->string('is_seen')->default('Unseen');
            $table->integer('opt')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('appointments');
    }
}
