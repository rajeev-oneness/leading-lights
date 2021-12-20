<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

class AddDataInClassesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        $data[] = [
            'name' => 'LKG',
            "monthly_fees" => 400,
            "admission_fees" => 800,
            "created_at" => date('Y-m-d H:i:s'),
            "updated_at" => date('Y-m-d H:i:s'),
        ];
        $data[] = [
            'name' => 'UKG',
            "monthly_fees" => 500,
            "admission_fees" => 1000,
            "created_at" => date('Y-m-d H:i:s'),
            "updated_at" => date('Y-m-d H:i:s'),
        ];
        $data[] = [
            'name' => 'Class I',
            "monthly_fees" => 600,
            "admission_fees" => 1200,
            "created_at" => date('Y-m-d H:i:s'),
            "updated_at" => date('Y-m-d H:i:s'),
        ];
        $data[] = [
            'name' => 'Class II',
            "monthly_fees" => 600,
            "admission_fees" => 1200,
            "created_at" => date('Y-m-d H:i:s'),
            "updated_at" => date('Y-m-d H:i:s'),
        ];
        $data[] = [
            'name' => 'Class III',
            "monthly_fees" => 700,
            "admission_fees" => 1400,
            "created_at" => date('Y-m-d H:i:s'),
            "updated_at" => date('Y-m-d H:i:s'),
        ];
        $data[] = [
            'name' => 'Class IV',
            "monthly_fees" => 700,
            "admission_fees" => 1400,
            "created_at" => date('Y-m-d H:i:s'),
            "updated_at" => date('Y-m-d H:i:s'),
        ];
        DB::table('classes')->insert($data);
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('classes', function (Blueprint $table) {
            //
        });
    }
}
