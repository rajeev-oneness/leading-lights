<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSubmitHomeTaskTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('submit_home_task', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->integer('class');
            $table->integer('subject');
            $table->string('id_no');
            $table->string('review')->nullable();
            $table->string('comment')->nullable();
            $table->string('upload_doc');
            $table->bigInteger('task_id');
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
        Schema::dropIfExists('submit_home_task');
    }
}
