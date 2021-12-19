<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddTypeOfExamColumnInArrangeExamsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('arrange_exams', function (Blueprint $table) {
            $table->string('type_of_exam')->after('exam_type')->nullable()->comment('Class,weekly exam etc');
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
            $table->dropColumn('type_of_exam');
        });
    }
}
