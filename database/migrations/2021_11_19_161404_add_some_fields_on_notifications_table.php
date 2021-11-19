<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddSomeFieldsOnNotificationsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('notifications', function (Blueprint $table) {
            $table->bigInteger('class_id')->after('user_id');
            $table->bigInteger('group_id')->after('class_id');
            $table->string('message')->nullable()->after('title');
            $table->tinyinteger('read_flag')->default(0)->comment('0 is unread, 1 is read')->after('end_time');
            $table->string('route')->nullable()->after('read_flag');
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
            $table->dropColumn('class_id');
            $table->dropColumn('group_id');
            $table->dropColumn('message');
            $table->dropColumn('read_flag');
            $table->dropColumn('route');
        });
    }
}
