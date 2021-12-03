<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\DB;

class InsertNewCountryCodeInCountriesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('countries', function (Blueprint $table) {

            DB::table('countries')->truncate();
            $data = [

                ['sortname' => 'IN', 'name' => 'India', 'phonecode' => '+91'],
                ['sortname' => 'AU', 'name' => 'Australia', 'phonecode' => '+61'],

            ];
            DB::table('countries')->insert($data);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('countries', function (Blueprint $table) {
            //
        });
    }
}
