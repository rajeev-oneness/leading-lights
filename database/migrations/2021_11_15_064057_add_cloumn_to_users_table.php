<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddCloumnToUsersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('users', function (Blueprint $table) {
            $table->dropColumn('last_login_time');
        });
        Schema::table('users', function (Blueprint $table) {
            $table->tinyInteger('is_rejected_document_uploaded')->define('1 means after rejection documents uploaded,0 means documents ok')->default(0)->after('rejected');
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
            $table->date('last_login_time')->nullable();
            $table->dropColumn('is_rejected_document_uploaded');
        });
    }
}
