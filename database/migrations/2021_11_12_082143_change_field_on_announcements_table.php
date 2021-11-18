<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class ChangeFieldOnAnnouncementsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        // Schema::table('announcements', function (Blueprint $table) {
        //     $table->dropIfExists('description');
        // });
        // Schema::table('announcements', function (Blueprint $table) {
        //     $table->text('description')->after('title');
        //     $table->bigInteger('user_id')->after('id');
        //     $table->string('class_id')->after('user_id');
        // });
        Schema::create('announcements', function (Blueprint $table) {
            $table->id();
            $table->date('date');
            $table->bigInteger('user_id');
            $table->string('class_id');
            $table->string('title');
            $table->longText('description');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('announcements');
    }
}
