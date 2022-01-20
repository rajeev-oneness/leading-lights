<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddFlashCourseIdInUsersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('users', function (Blueprint $table) {
            $table->integer('flash_course_id')->nullable()->after('special_course_ids');
            $table->tinyInteger('registration_type')->after('flash_course_id')->default(1)->comment('1:Regular class, 2:Special Course, 3:Flash Course');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('users', function (Blueprint $table) {
            $table->dropColumn('flash_course_id');
            $table->dropColumn('registration_type');
        });
    }
}
