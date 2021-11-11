<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSpecialCoursesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('special_courses', function (Blueprint $table) {
            $table->id();
            $table->string('title')->unique();
            $table->integer('class_id');
            $table->date('start_date')->nullable();
            $table->date('end_date')->nullable();
            $table->integer('monthly_fees');
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
        Schema::dropIfExists('special_courses');
    }
}
