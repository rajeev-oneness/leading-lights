<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class ModifyColumnInUsersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('users', function (Blueprint $table) {
            $table->dropColumn('qualification');
        });
        Schema::table('users', function (Blueprint $table) {
            $table->integer('qualification_id')->after('doj')->nullable()->default(0);
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
            $table->dropColumn('qualification_id')->nullable();
        });
        Schema::table('users', function (Blueprint $table) {
            $table->string('qualification')->after('doj')->nullable();
        });
    }
}
