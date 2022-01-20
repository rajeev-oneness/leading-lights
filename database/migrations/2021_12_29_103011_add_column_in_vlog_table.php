<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddColumnInVlogTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('vlog', function (Blueprint $table) {
            $table->text('description')->after('title');
            $table->string('file_path')->after('description');
            $table->string('facebook_link')->after('file_path')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('vlog', function (Blueprint $table) {
            $table->dropColumn('description');
            $table->dropColumn('file_path');
            $table->dropColumn('facebook_link');
        });
    }
}
