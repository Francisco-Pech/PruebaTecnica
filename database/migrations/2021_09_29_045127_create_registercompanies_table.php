<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateRegistercompaniesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('registercompanies', function (Blueprint $table) {
            $table->id();
            $table->foreignId("userId")
                ->references("id")
                ->on("users");
            $table->foreignId("companyId")
                  ->references("id")
                  ->on("companies");
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
        Schema::dropIfExists('registercompanies');
    }
}
