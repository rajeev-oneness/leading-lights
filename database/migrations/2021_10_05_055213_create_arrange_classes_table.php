<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateArrangeClassesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('arrange_classes', function (Blueprint $table) {
            $table->id();
            $table->bigInteger('user_id');
            $table->string('class');
            $table->string('subject');
            $table->date('date');
            $table->time('start_time');
            $table->time('end_time');
            $table->string('meeting_url');
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
        Schema::dropIfExists('arrange_classes');
    }
}
