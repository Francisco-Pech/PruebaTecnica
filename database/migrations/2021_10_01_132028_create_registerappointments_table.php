<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateRegisterappointmentsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('registerappointments', function (Blueprint $table) {
            $table->id();
            $table->foreignId("userId")
                ->references("id")
                ->on("users");
            $table->foreignId("appointmentId")
                ->references("id")
                ->on("appointments");
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
        Schema::dropIfExists('registerappointments');
    }
}
