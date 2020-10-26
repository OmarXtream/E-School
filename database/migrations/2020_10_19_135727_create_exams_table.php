<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateExamsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('exams', function (Blueprint $table) {
            $table->id();
            $table->tinyInteger('level')->comment('three Levels')->index();
            $table->unsignedBigInteger('teacher_id');
            $table->foreign('teacher_id')
            ->references('id')->on('teachers')
            ->onDelete('cascade');
            $table->integer('count');
            $table->json('info');

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
        Schema::dropIfExists('exams');
    }
}
