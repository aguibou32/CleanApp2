<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCollectionInvoicesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('collection_invoices', function (Blueprint $table) {
            $table->id();
            $table->string('material_type')->nullable();
            $table->integer('material_quantity')->nullable();
            $table->double('collection_value')->nullable();
            $table->double('tax')->nullable();
            $table->double('total')->nullable();
            $table->double('resident_share')->nullable();
            $table->double('collector_share')->nullable();
            $table->double('cleanapp_share')->nullable();
            $table->unsignedBigInteger('collector_id')->nullable();
            $table->unsignedBigInteger('collection_id')->nullable();

            $table->unsignedBigInteger('buy_back_center_id');
            $table->timestamps();
            
            $table->foreign('buy_back_center_id')->references('id')->on('buy_back_centers')->onDelete('cascade');
        
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('collection_invoices');
    }
}
