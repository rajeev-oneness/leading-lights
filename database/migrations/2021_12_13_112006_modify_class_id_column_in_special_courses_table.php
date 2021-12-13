<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class ModifyClassIdColumnInSpecialCoursesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        if (Schema::hasColumn('special_courses', 'title')){
            Schema::table('special_courses', function (Blueprint $table) {
                $table->dropColumn('title');
            });
        }
        if (Schema::hasColumn('special_courses', 'class_id')){
            Schema::table('special_courses', function (Blueprint $table) {
                $table->dropColumn('class_id');
            });
        }
        
        Schema::table('special_courses', function (Blueprint $table) {
            $table->string('title')->after('id');
            $table->integer('class_id')->after('title')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('special_courses', function (Blueprint $table) {
            $table->dropColumn('title');
            $table->dropColumn('class_id');
        });
    }
}
