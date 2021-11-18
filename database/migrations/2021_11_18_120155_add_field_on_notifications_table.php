<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddFieldOnNotificationsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('notifications', function (Blueprint $table) {
            $table->bigInteger('user_id')->after('id');
            $table->date('date')->nullable()->after('title');
            $table->time('time')->nullable()->after('date');
            $table->date('start_date')->nullable()->after('time');
            $table->date('end_date')->nullable()->after('start_date');
            $table->time('start_time')->nullable()->after('end_date');
            $table->time('end_time')->nullable()->after('start_time');
            $table->tinyinteger('is_viewd')->default(0)->after('end_time');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('notifications', function (Blueprint $table) {
            $table->dropColumn('user_id');
            $table->dropColumn('date');
            $table->dropColumn('time');
            $table->dropColumn('start_date');
            $table->dropColumn('end_date');
            $table->dropColumn('start_time');
            $table->dropColumn('end_time');
            $table->dropColumn('is_viewd');
        });
    }
}
