<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateRegisterbranchofficesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('registerbranchoffices', function (Blueprint $table) {
            $table->id();
            $table->foreignId("userId")
                ->references("id")
                ->on("users");
            $table->foreignId("branchOfficeId")
                  ->references("id")
                  ->on("branchoffices");
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
        Schema::dropIfExists('registerbranchoffices');
    }
}
