<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddMultipleColumnInArrangeExamsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('arrange_exams', function (Blueprint $table) {
            $table->string('name_of_exam')->nullable()->after('type_of_exam');
            $table->string('selected_month')->nullable()->after('name_of_exam');
            $table->string('selected_session')->nullable()->after('name_of_exam');
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
            $table->dropColumn('name_of_exam');
            $table->dropColumn('selected_month');
            $table->dropColumn('selected_session');
        });
    }
}
