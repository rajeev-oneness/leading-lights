<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateOtherPaymentDetails extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('other_payment_details', function (Blueprint $table) {
            $table->id();
            $table->integer('payment_id');
            $table->integer('user_id');
            $table->integer('class_id')->nullable();
            $table->integer('course_id')->nullable();
            $table->string('fees_type');
            $table->date('next_due_date');
            $table->date('payment_month')->define('For which month you make Payment');
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
        Schema::dropIfExists('other_payment_details');
    }
}
