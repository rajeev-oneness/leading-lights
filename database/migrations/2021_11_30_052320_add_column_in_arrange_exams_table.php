<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddColumnInArrangeExamsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('arrange_exams', function (Blueprint $table) {
            $table->integer('full_marks')->after('end_time');
            $table->date('result_date')->after('end_time');
            $table->tinyInteger('negative_marks')->after('end_time')->default(0)->comment('0:non negative and 1: negative');
            $table->integer('pass_marks')->after('end_time');
            $table->tinyInteger('exam_type')->after('end_time')->comment('1:MCQ,2:Desc,3:Mixed');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('arrange_exams', function (Blueprint $table) {
            $table->dropColumn('full_marks');
            $table->dropColumn('result_date');
            $table->dropColumn('negative_marks');
            $table->dropColumn('pass_marks');
            $table->dropColumn('exam_type');
        });

    }
}
