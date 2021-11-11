<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddCloumnInHomeTaskTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('home_task', function (Blueprint $table) {
            $table->dropColumn('class');
        });
        Schema::table('home_task', function (Blueprint $table) {
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
        Schema::table('home_task', function (Blueprint $table) {
           $table->integer('class')->after('user_id');
           $table->integer('group_id')->after('user_id');
        });
    }
}
