<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddColumnInResultsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('results', function (Blueprint $table) {
            $table->string('skipped_ans')->after('no_ans')->nullable();
            $table->tinyInteger('is_auto_submitted')->after('skipped_ans')->default('0')->comment('1:User submitted,0:Auto submitted');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('results', function (Blueprint $table) {
            $table->dropColumn('skipped_ans');
            $table->dropColumn('is_auto_submitted');
        });
    }
}
