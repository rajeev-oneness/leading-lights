<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddGroupAccessInUsersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('users', function (Blueprint $table) {
            $table->dropColumn('is_special_approved');
        });
        Schema::table('users', function (Blueprint $table) {
            $table->tinyInteger('group_access')->default(1)->nullable()->after('is_rejected_document_uploaded')->comment('0:Not Access,1:Access');
            $table->tinyInteger('class_access')->nullable()->after('is_rejected_document_uploaded')->comment('0:Not Access,1:Access');
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
            $table->dropColumn('group_access');
            $table->dropColumn('class_access');
        });
    }
}
