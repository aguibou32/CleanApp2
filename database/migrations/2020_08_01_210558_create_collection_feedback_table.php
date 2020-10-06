<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCollectionFeedbackTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('collection_feedback', function (Blueprint $table) {
            $table->id();
            $table->string('feedback_message');
            $table->integer('rating');
            $table->unsignedBigInteger('collection_id');
            $table->unsignedBigInteger('collector_id');
            $table->timestamps();
            $table->foreign('collection_id')->references('id')->on('collections')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('collection_feedback');
    }
}
