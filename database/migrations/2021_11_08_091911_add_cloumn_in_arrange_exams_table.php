<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddCloumnInArrangeExamsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('arrange_exams', function (Blueprint $table) {
            $table->dropColumn('class');
        });
        Schema::table('arrange_exams', function (Blueprint $table) {
            $table->integer('group_id')->nullable()->after('user_id');
            $table->integer('class')->nullable()->after('user_id');
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
            $table->dropColumn('class');
            $table->dropColumn('group_id');
        });
    }
}
