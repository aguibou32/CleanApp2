<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateRecyclingRequestsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('recycling_requests', function (Blueprint $table) {
            $table->id();
            $table->string('material_type')->nullable();
            $table->integer('material_quantity')->nullable();
            $table->integer('collection_value')->nullable();
            $table->string('collection_status')->nullable();
            $table->string('collection_QRCode')->nullable();
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
        Schema::dropIfExists('recycling_requests');
    }
}
