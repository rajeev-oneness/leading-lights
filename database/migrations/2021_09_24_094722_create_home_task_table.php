<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateHomeTaskTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('home_task', function (Blueprint $table) {
            $table->id();
            $table->bigInteger('user_id');
            $table->string('class');
            $table->string('subject');
            $table->date('submission_date');
            $table->time('submission_time');
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
        Schema::dropIfExists('home_task');
    }
}
