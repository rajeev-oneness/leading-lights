<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateArrangeExamsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('arrange_exams', function (Blueprint $table) {
            $table->id();
            $table->bigInteger('user_id');
            $table->integer('class');
            $table->integer('subject');
            $table->date('date');
            $table->time('start_time');
            $table->time('end_time');
            $table->string('upload_file');
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
        Schema::dropIfExists('arrange_exams');
    }
}
