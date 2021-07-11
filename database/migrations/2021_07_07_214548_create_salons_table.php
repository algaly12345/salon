<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSalonsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('salons', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('salon_name');
            $table->string('salon_description');
            $table->string('salon_address');
            $table->string('longitude');
            $table->string('latitude');
            $table->string('price');
            $table->string('data_id');
            $table->integer('owner_id');
            $table->string('salon_email');
            $table->integer('category_id');
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
        Schema::dropIfExists('salons');
    }
}