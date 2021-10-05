<?php

use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateUsersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('users', function (Blueprint $table) {
            $table->id();
            $table->integer('role_id')->default(4);
            $table->string('first_name');
            $table->string('last_name');
            $table->string('email')->unique();
            $table->timestamp('email_verified_at')->nullable();
            $table->string('password');
            $table->string('fathers_name')->nullable();
            $table->string('gender')->nullable();
            $table->string('class')->nullable();
            $table->string('mobile')->nullable();
            $table->string('address')->nullable();
            $table->string('dob')->nullable()->comment('Date of Birth');
            $table->string('doj')->nullable()->comment('Date of Joining');
            $table->string('latest_certificate')->nullable();
            $table->string('qualification')->nullable();
            $table->string('special_subject')->nullable();
            $table->string('id_no')->unique();
            $table->string('image')->nullable();
            $table->string('about_us')->nullable();
            $table->tinyInteger('status')->default(0);
            $table->rememberToken();
            $table->timestamps();
        });

        $data[] = [
            'role_id' => 1,
            'first_name' => 'Admin',
            'last_name' => 'user',
            'email' => 'admin@gmail.com',
            'password' => Hash::make('123'),
            'status' => 1,
            'id_no' => 'LLA005003'
        ];
        $data[] = [
            'role_id' => 2,
            'first_name' => 'HR',
            'last_name' => 'user',
            'email' => 'hr@gmail.com',
            'password' => Hash::make('123'),
            'status' => 1,
            'id_no' => 'LLHR003897'
        ];
        $data[] = [
            'role_id' => 3,
            'first_name' => 'Teacher',
            'last_name' => 'user',
            'email' => 'teacher@gmail.com',
            'password' => Hash::make('123'),
            'status' => 1,
            'id_no' => 'LLT003456'
        ];
        $data[] = [
            'role_id' => 4,
            'first_name' => 'Student',
            'last_name' => 'user',
            'email' => 'student@gmail.com',
            'password' => Hash::make('123'),
            'status' => 1,
            'id_no' => 'LLST003567'
        ];
        DB::table('users')->insert($data);
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('users');
    }
}
