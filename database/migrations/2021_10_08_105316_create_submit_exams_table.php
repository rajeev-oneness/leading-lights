<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSubmitExamsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('submit_exams', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('class');
            $table->string('subject');
            $table->string('roll_no');
            $table->integer('marks')->nullable();
            $table->string('comment')->nullable();
            $table->string('upload_doc');
            $table->bigInteger('exam_id');
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
        Schema::dropIfExists('submit_exams');
    }
}
