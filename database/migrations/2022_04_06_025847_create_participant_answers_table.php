<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateParticipantAnswersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('participant_answers', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('participant_id')->index();
            $table->unsignedBigInteger('quiz_answer_id')->index();
            $table->foreign('participant_id')->references('id')->on('participants')->onDelete('cascade');
            $table->foreign('quiz_answer_id')->references('id')->on('quiz_answers')->onDelete('cascade');
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
        Schema::dropIfExists('participant_answers');
    }
}
