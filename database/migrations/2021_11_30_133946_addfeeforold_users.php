<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddfeeforoldUsers extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        $users = \App\Models\User::get();
        $feedata = [];
        foreach ($users as $key => $user) {
            $checkFee = \App\Models\Fee::where('user_id', $user->id)->first();
            if (!$checkFee) {
                if (!empty($user->special_course_ids)) {
                    $specialCourId = explode(',', $user->special_course_ids);
                    foreach ($specialCourId as $key => $course) {
                        $s_course = \App\Models\SpecialCourse::where('id', $course)->first();
                        if ($s_course) {
                            $feedata[] = [
                                'user_id' => $user->id,
                                'class_id' => 0,
                                'course_id' => $s_course->id,
                                'fee_type' => 'course_fee',
                                'due_date' => date('Y-m-d', strtotime('+1 day')),
                                'payment_month' => date('F', strtotime('+1 day')),
                                'amount' => $s_course->monthly_fees,
                            ];
                        }
                    }
                }
                if (!empty($user->class) && $user->class > 0) {
                    $check_class = \App\Models\Classes::where('id', $user->class)->first();
                    if ($check_class) {
                        $feedata[] = [
                            'user_id' => $user->id,
                            'class_id' => $check_class->id,
                            'course_id' => 0,
                            'fee_type' => 'admission_fee',
                            'due_date' => date('Y-m-d', strtotime('+1 day')),
                            'payment_month' => date('F', strtotime('+1 day')),
                            'amount' => $check_class->monthly_fees + $check_class->admission_fees,
                        ];
                    }
                }
            }
        }

        if (count($feedata) > 0) {
            DB::table('fees')->insert($feedata);
        }
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        //
    }
}
