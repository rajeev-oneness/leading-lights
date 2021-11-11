<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddColumnToPaymentsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('payments', function (Blueprint $table) {
            $table->string('fees_type')->after('payment_method');
            $table->date('next_due_date')->after('payment_method')->nullable();
            $table->date('payment_month')->after('payment_method')->nullable()->define('For which month you make Payment');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('payments', function (Blueprint $table) {
            $table->dropColumn('fees_type');
            $table->dropColumn('next_due_date');
            $table->dropColumn('payment_month');
        });
    }
}
