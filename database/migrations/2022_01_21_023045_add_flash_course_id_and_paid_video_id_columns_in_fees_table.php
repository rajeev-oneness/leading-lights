<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddFlashCourseIdAndPaidVideoIdColumnsInFeesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('fees', function (Blueprint $table) {
            $table->bigInteger('flash_course_id')->default(0)->after('course_id');
            $table->bigInteger('paid_video_id')->default(0)->after('flash_course_id');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('fees', function (Blueprint $table) {
            $table->dropColumn('flash_course_id');
            $table->dropColumn('paid_video_id');
        });
    }
}
