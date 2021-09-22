<?php

use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateRolesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('roles', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('slug');
            $table->timestamps();
        });

        $data[] = [
            'id' => 1,
            'name' => 'Admin',
            'slug' => 'admin'
        ];
        $data[] = [
            'id' => 2,
            'name' => 'HR',
            'slug' => 'hr'
        ];
        $data[] = [
            'id' => 3,
            'name' => 'Teacher',
            'slug' => 'teacher'
        ];
        $data[] = [
            'id' => 4,
            'name' => 'Student',
            'slug' => 'Student'
        ];

        DB::table('roles')->insert($data);
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('roles');
    }
}
