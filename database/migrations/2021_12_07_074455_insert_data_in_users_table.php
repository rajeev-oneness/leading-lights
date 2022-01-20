<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Schema;

class InsertDataInUsersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        $data[] = [
            'role_id' => 5,
            'first_name' => 'Super Admin',
            'last_name' => 'user',
            'email' => 'superadmin@gmail.com',
            'password' => Hash::make('123'),
            'status' => 1,
            'id_no' => 'LLSA003567',
        ];
        // DB::table('users')->insert($data);
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
    }
}
