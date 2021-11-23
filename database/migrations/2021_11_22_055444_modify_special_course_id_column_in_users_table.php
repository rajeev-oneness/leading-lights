<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class ModifySpecialCourseIdColumnInUsersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('users', function (Blueprint $table) {
            $table->dropColumn('special_course_id');
        });
        Schema::table('users', function (Blueprint $table) {
            $table->string('special_course_ids')->after('class')->nullable();
            $table->integer('country_code')->after('group_ids')->nullable();
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
            $table->integer('special_course_id')->after('class')->nullable();
        });
        Schema::table('users', function (Blueprint $table) {
            $table->dropColumn('special_course_ids');
            $table->dropColumn('country_code');
        });
    }
}
