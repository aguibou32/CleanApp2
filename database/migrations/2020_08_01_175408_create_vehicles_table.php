<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateVehiclesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('vehicles', function (Blueprint $table) {
            $table->id();
            $table->string('number_plate')->nullable();
            $table->string('vehicle_model')->nullable();
            $table->string('vehicle_make')->nullable();

            $table->unsignedBigInteger('collector_id');
            $table->foreign('collector_id')->references('id')->on('independent_collectors')->onDelete('cascade');
            
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
        Schema::dropIfExists('vehicles');
    }

}
