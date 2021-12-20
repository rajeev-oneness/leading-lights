<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

class AddDataInSpecialClasses extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        $data[] = [
            'title' => 'Abacus',
            "monthly_fees" => 300,
            "class_id" => 1,
            "start_date" => "2022-01-20",
            "created_at" => date('Y-m-d H:i:s'),
            "updated_at" => date('Y-m-d H:i:s'),
        ];
        $data[] = [
            'title' => 'Abacus',
            "monthly_fees" => 300,
            "class_id" => 2,
            "start_date" => "2022-01-20",
            "created_at" => date('Y-m-d H:i:s'),
            "updated_at" => date('Y-m-d H:i:s'),
        ];
        $data[] = [
            'title' => 'Abacus',
            "monthly_fees" => 300,
            "class_id" => 3,
            "start_date" => "2022-01-20",
            "created_at" => date('Y-m-d H:i:s'),
            "updated_at" => date('Y-m-d H:i:s'),
        ];
        $data[] = [
            'title' => 'Abacus',
            "monthly_fees" => 300,
            "class_id" => 4,
            "start_date" => "2022-01-20",
            "created_at" => date('Y-m-d H:i:s'),
            "updated_at" => date('Y-m-d H:i:s'),
        ];
        $data[] = [
            'title' => 'Abacus',
            "monthly_fees" => 300,
            "class_id" => 5,
            "start_date" => "2022-01-20",
            "created_at" => date('Y-m-d H:i:s'),
            "updated_at" => date('Y-m-d H:i:s'),
        ];
        $data[] = [
            'title' => 'Abacus',
            "monthly_fees" => 300,
            "class_id" => 6,
            "start_date" => "2022-01-20",
            "created_at" => date('Y-m-d H:i:s'),
            "updated_at" => date('Y-m-d H:i:s'),
        ];
        $data[] = [
            'title' => 'Abacus',
            "monthly_fees" => 300,
            "class_id" => 7,
            "start_date" => "2022-01-20",
            "created_at" => date('Y-m-d H:i:s'),
            "updated_at" => date('Y-m-d H:i:s'),
        ];
        $data[] = [
            'title' => 'Abacus',
            "monthly_fees" => 300,
            "class_id" => 8,
            "start_date" => "2022-01-20",
            "created_at" => date('Y-m-d H:i:s'),
            "updated_at" => date('Y-m-d H:i:s'),
        ];
        $data[] = [
            'title' => 'Abacus',
            "monthly_fees" => 300,
            "class_id" => null,
            "start_date" => "2022-01-20",
            "created_at" => date('Y-m-d H:i:s'),
            "updated_at" => date('Y-m-d H:i:s'),
        ];
        //
        $data[] = [
            'title' => 'Drawing (Painting, Art & Craft etc)',
            "monthly_fees" => 400,
            "class_id" => null,
            "start_date" => "2022-01-20",
            "created_at" => date('Y-m-d H:i:s'),
            "updated_at" => date('Y-m-d H:i:s'),
        ];
        $data[] = [
            'title' => 'Drawing (Painting, Art & Craft etc)',
            "monthly_fees" => 400,
            "class_id" => 1,
            "start_date" => "2022-01-20",
            "created_at" => date('Y-m-d H:i:s'),
            "updated_at" => date('Y-m-d H:i:s'),
        ];
        $data[] = [
            'title' => 'Drawing (Painting, Art & Craft etc)',
            "monthly_fees" => 400,
            "class_id" => 2,
            "start_date" => "2022-01-20",
            "created_at" => date('Y-m-d H:i:s'),
            "updated_at" => date('Y-m-d H:i:s'),
        ];
        $data[] = [
            'title' => 'Drawing (Painting, Art & Craft etc)',
            "monthly_fees" => 400,
            "class_id" => 3,
            "start_date" => "2022-01-20",
            "created_at" => date('Y-m-d H:i:s'),
            "updated_at" => date('Y-m-d H:i:s'),
        ];
        $data[] = [
            'title' => 'Drawing (Painting, Art & Craft etc)',
            "monthly_fees" => 400,
            "class_id" => 4,
            "start_date" => "2022-01-20",
            "created_at" => date('Y-m-d H:i:s'),
            "updated_at" => date('Y-m-d H:i:s'),
        ];
        $data[] = [
            'title' => 'Drawing (Painting, Art & Craft etc)',
            "monthly_fees" => 400,
            "class_id" => 5,
            "start_date" => "2022-01-20",
            "created_at" => date('Y-m-d H:i:s'),
            "updated_at" => date('Y-m-d H:i:s'),
        ];
        $data[] = [
            'title' => 'Drawing (Painting, Art & Craft etc)',
            "monthly_fees" => 400,
            "class_id" => 6,
            "start_date" => "2022-01-20",
            "created_at" => date('Y-m-d H:i:s'),
            "updated_at" => date('Y-m-d H:i:s'),
        ];
        $data[] = [
            'title' => 'Drawing (Painting, Art & Craft etc)',
            "monthly_fees" => 400,
            "class_id" => 7,
            "start_date" => "2022-01-20",
            "created_at" => date('Y-m-d H:i:s'),
            "updated_at" => date('Y-m-d H:i:s'),
        ];
        $data[] = [
            'title' => 'Drawing (Painting, Art & Craft etc)',
            "monthly_fees" => 400,
            "class_id" => 8,
            "start_date" => "2022-01-20",
            "created_at" => date('Y-m-d H:i:s'),
            "updated_at" => date('Y-m-d H:i:s'),
        ];
        //
        $data[] = [
            'title' => 'Spoken English Classes',
            "monthly_fees" => 400,
            "class_id" => null,
            "start_date" => "2022-01-20",
            "created_at" => date('Y-m-d H:i:s'),
            "updated_at" => date('Y-m-d H:i:s'),
        ];
        $data[] = [
            'title' => 'Spoken English Classes',
            "monthly_fees" => 400,
            "class_id" => 1,
            "start_date" => "2022-01-20",
            "created_at" => date('Y-m-d H:i:s'),
            "updated_at" => date('Y-m-d H:i:s'),
        ];
        $data[] = [
            'title' => 'Spoken English Classes',
            "monthly_fees" => 400,
            "class_id" => 2,
            "start_date" => "2022-01-20",
            "created_at" => date('Y-m-d H:i:s'),
            "updated_at" => date('Y-m-d H:i:s'),
        ];
        $data[] = [
            'title' => 'Spoken English Classes',
            "monthly_fees" => 400,
            "class_id" => 3,
            "start_date" => "2022-01-20",
            "created_at" => date('Y-m-d H:i:s'),
            "updated_at" => date('Y-m-d H:i:s'),
        ];
        $data[] = [
            'title' => 'Spoken English Classes',
            "monthly_fees" => 400,
            "class_id" => 4,
            "start_date" => "2022-01-20",
            "created_at" => date('Y-m-d H:i:s'),
            "updated_at" => date('Y-m-d H:i:s'),
        ];
        $data[] = [
            'title' => 'Spoken English Classes',
            "monthly_fees" => 400,
            "class_id" => 5,
            "start_date" => "2022-01-20",
            "created_at" => date('Y-m-d H:i:s'),
            "updated_at" => date('Y-m-d H:i:s'),
        ];
        $data[] = [
            'title' => 'Spoken English Classes',
            "monthly_fees" => 400,
            "class_id" => 6,
            "start_date" => "2022-01-20",
            "created_at" => date('Y-m-d H:i:s'),
            "updated_at" => date('Y-m-d H:i:s'),
        ];
        $data[] = [
            'title' => 'Spoken English Classes',
            "monthly_fees" => 400,
            "class_id" => 7,
            "start_date" => "2022-01-20",
            "created_at" => date('Y-m-d H:i:s'),
            "updated_at" => date('Y-m-d H:i:s'),
        ];
        $data[] = [
            'title' => 'Spoken English Classes',
            "monthly_fees" => 400,
            "class_id" => 8,
            "start_date" => "2022-01-20",
            "created_at" => date('Y-m-d H:i:s'),
            "updated_at" => date('Y-m-d H:i:s'),
        ];
        //
        $data[] = [
            'title' => 'Computer Classes',
            "monthly_fees" => 400,
            "class_id" => null,
            "start_date" => "2022-01-20",
            "created_at" => date('Y-m-d H:i:s'),
            "updated_at" => date('Y-m-d H:i:s'),
        ];
        $data[] = [
            'title' => 'Computer Classes',
            "monthly_fees" => 400,
            "class_id" => 1,
            "start_date" => "2022-01-20",
            "created_at" => date('Y-m-d H:i:s'),
            "updated_at" => date('Y-m-d H:i:s'),
        ];
        $data[] = [
            'title' => 'Computer Classes',
            "monthly_fees" => 400,
            "class_id" => 2,
            "start_date" => "2022-01-20",
            "created_at" => date('Y-m-d H:i:s'),
            "updated_at" => date('Y-m-d H:i:s'),
        ];
        $data[] = [
            'title' => 'Computer Classes',
            "monthly_fees" => 400,
            "class_id" => 3,
            "start_date" => "2022-01-20",
            "created_at" => date('Y-m-d H:i:s'),
            "updated_at" => date('Y-m-d H:i:s'),
        ];
        $data[] = [
            'title' => 'Computer Classes',
            "monthly_fees" => 400,
            "class_id" => 4,
            "start_date" => "2022-01-20",
            "created_at" => date('Y-m-d H:i:s'),
            "updated_at" => date('Y-m-d H:i:s'),
        ];
        $data[] = [
            'title' => 'Computer Classes',
            "monthly_fees" => 400,
            "class_id" => 5,
            "start_date" => "2022-01-20",
            "created_at" => date('Y-m-d H:i:s'),
            "updated_at" => date('Y-m-d H:i:s'),
        ];
        $data[] = [
            'title' => 'Computer Classes',
            "monthly_fees" => 400,
            "class_id" => 6,
            "start_date" => "2022-01-20",
            "created_at" => date('Y-m-d H:i:s'),
            "updated_at" => date('Y-m-d H:i:s'),
        ];
        $data[] = [
            'title' => 'Computer Classes',
            "monthly_fees" => 400,
            "class_id" => 7,
            "start_date" => "2022-01-20",
            "created_at" => date('Y-m-d H:i:s'),
            "updated_at" => date('Y-m-d H:i:s'),
        ];
        $data[] = [
            'title' => 'Computer Classes',
            "monthly_fees" => 400,
            "class_id" => 8,
            "start_date" => "2022-01-20",
            "created_at" => date('Y-m-d H:i:s'),
            "updated_at" => date('Y-m-d H:i:s'),
        ];
        //
        $data[] = [
            'title' => 'Career Development Programs',
            "monthly_fees" => 400,
            "class_id" => null,
            "start_date" => "2022-01-20",
            "created_at" => date('Y-m-d H:i:s'),
            "updated_at" => date('Y-m-d H:i:s'),
        ];
        //
        $data[] = [
            'title' => 'Child and Adult interview preparation sessions',
            "monthly_fees" => 500,
            "class_id" => null,
            "start_date" => "2022-01-20",
            "created_at" => date('Y-m-d H:i:s'),
            "updated_at" => date('Y-m-d H:i:s'),
        ];
        //
        $data[] = [
            'title' => 'Handwriting Improvement Courses',
            "monthly_fees" => 200,
            "class_id" => 1,
            "start_date" => "2022-01-20",
            "created_at" => date('Y-m-d H:i:s'),
            "updated_at" => date('Y-m-d H:i:s'),
        ];
        $data[] = [
            'title' => 'Handwriting Improvement Courses',
            "monthly_fees" => 200,
            "class_id" => 2,
            "start_date" => "2022-01-20",
            "created_at" => date('Y-m-d H:i:s'),
            "updated_at" => date('Y-m-d H:i:s'),
        ];
        $data[] = [
            'title' => 'Handwriting Improvement Courses',
            "monthly_fees" => 200,
            "class_id" => 3,
            "start_date" => "2022-01-20",
            "created_at" => date('Y-m-d H:i:s'),
            "updated_at" => date('Y-m-d H:i:s'),
        ];
        $data[] = [
            'title' => 'Handwriting Improvement Courses',
            "monthly_fees" => 200,
            "class_id" => 4,
            "start_date" => "2022-01-20",
            "created_at" => date('Y-m-d H:i:s'),
            "updated_at" => date('Y-m-d H:i:s'),
        ];
        $data[] = [
            'title' => 'Handwriting Improvement Courses',
            "monthly_fees" => 200,
            "class_id" => 5,
            "start_date" => "2022-01-20",
            "created_at" => date('Y-m-d H:i:s'),
            "updated_at" => date('Y-m-d H:i:s'),
        ];
        $data[] = [
            'title' => 'Handwriting Improvement Courses',
            "monthly_fees" => 200,
            "class_id" => 6,
            "start_date" => "2022-01-20",
            "created_at" => date('Y-m-d H:i:s'),
            "updated_at" => date('Y-m-d H:i:s'),
        ];
        $data[] = [
            'title' => 'Handwriting Improvement Courses',
            "monthly_fees" => 200,
            "class_id" => 7,
            "start_date" => "2022-01-20",
            "created_at" => date('Y-m-d H:i:s'),
            "updated_at" => date('Y-m-d H:i:s'),
        ];
        $data[] = [
            'title' => 'Handwriting Improvement Courses',
            "monthly_fees" => 200,
            "class_id" => 8,
            "start_date" => "2022-01-20",
            "created_at" => date('Y-m-d H:i:s'),
            "updated_at" => date('Y-m-d H:i:s'),
        ];
        //
        $data[] = [
            'title' => 'Dance (Western and Classical)',
            "monthly_fees" => 200,
            "class_id" => 1,
            "start_date" => "2022-01-20",
            "created_at" => date('Y-m-d H:i:s'),
            "updated_at" => date('Y-m-d H:i:s'),
        ];
        $data[] = [
            'title' => 'Dance (Western and Classical)',
            "monthly_fees" => 200,
            "class_id" => 2,
            "start_date" => "2022-01-20",
            "created_at" => date('Y-m-d H:i:s'),
            "updated_at" => date('Y-m-d H:i:s'),
        ];
        $data[] = [
            'title' => 'Dance (Western and Classical)',
            "monthly_fees" => 200,
            "class_id" => 3,
            "start_date" => "2022-01-20",
            "created_at" => date('Y-m-d H:i:s'),
            "updated_at" => date('Y-m-d H:i:s'),
        ];
        $data[] = [
            'title' => 'Dance (Western and Classical)',
            "monthly_fees" => 200,
            "class_id" => 4,
            "start_date" => "2022-01-20",
            "created_at" => date('Y-m-d H:i:s'),
            "updated_at" => date('Y-m-d H:i:s'),
        ];
        $data[] = [
            'title' => 'Dance (Western and Classical)',
            "monthly_fees" => 200,
            "class_id" => 5,
            "start_date" => "2022-01-20",
            "created_at" => date('Y-m-d H:i:s'),
            "updated_at" => date('Y-m-d H:i:s'),
        ];
        $data[] = [
            'title' => 'Dance (Western and Classical)',
            "monthly_fees" => 200,
            "class_id" => 6,
            "start_date" => "2022-01-20",
            "created_at" => date('Y-m-d H:i:s'),
            "updated_at" => date('Y-m-d H:i:s'),
        ];
        $data[] = [
            'title' => 'Dance (Western and Classical)',
            "monthly_fees" => 200,
            "class_id" => 7,
            "start_date" => "2022-01-20",
            "created_at" => date('Y-m-d H:i:s'),
            "updated_at" => date('Y-m-d H:i:s'),
        ];
        $data[] = [
            'title' => 'Dance (Western and Classical)',
            "monthly_fees" => 200,
            "class_id" => 8,
            "start_date" => "2022-01-20",
            "created_at" => date('Y-m-d H:i:s'),
            "updated_at" => date('Y-m-d H:i:s'),
        ];
        $data[] = [
            'title' => 'Dance (Western and Classical)',
            "monthly_fees" => 200,
            "class_id" => null,
            "start_date" => "2022-01-20",
            "created_at" => date('Y-m-d H:i:s'),
            "updated_at" => date('Y-m-d H:i:s'),
        ];
        //
        $data[] = [
            'title' => 'Lead Absolute (An Exquisite Overall Development Course)',
            "monthly_fees" => 200,
            "class_id" => null,
            "start_date" => "2022-01-20",
            "created_at" => date('Y-m-d H:i:s'),
            "updated_at" => date('Y-m-d H:i:s'),
        ];
        //
        $data[] = [
            'title' => 'Singing Classes',
            "monthly_fees" => 200,
            "class_id" => null,
            "start_date" => "2022-01-20",
            "created_at" => date('Y-m-d H:i:s'),
            "updated_at" => date('Y-m-d H:i:s'),
        ];
        $data[] = [
            'title' => 'Singing Classes',
            "monthly_fees" => 200,
            "class_id" => 1,
            "start_date" => "2022-01-20",
            "created_at" => date('Y-m-d H:i:s'),
            "updated_at" => date('Y-m-d H:i:s'),
        ];
        $data[] = [
            'title' => 'Singing Classes',
            "monthly_fees" => 200,
            "class_id" => 2,
            "start_date" => "2022-01-20",
            "created_at" => date('Y-m-d H:i:s'),
            "updated_at" => date('Y-m-d H:i:s'),
        ];
        $data[] = [
            'title' => 'Singing Classes',
            "monthly_fees" => 200,
            "class_id" => 3,
            "start_date" => "2022-01-20",
            "created_at" => date('Y-m-d H:i:s'),
            "updated_at" => date('Y-m-d H:i:s'),
        ];
        $data[] = [
            'title' => 'Singing Classes',
            "monthly_fees" => 200,
            "class_id" => 4,
            "start_date" => "2022-01-20",
            "created_at" => date('Y-m-d H:i:s'),
            "updated_at" => date('Y-m-d H:i:s'),
        ];
        $data[] = [
            'title' => 'Singing Classes',
            "monthly_fees" => 200,
            "class_id" => 5,
            "start_date" => "2022-01-20",
            "created_at" => date('Y-m-d H:i:s'),
            "updated_at" => date('Y-m-d H:i:s'),
        ];
        $data[] = [
            'title' => 'Singing Classes',
            "monthly_fees" => 200,
            "class_id" => 6,
            "start_date" => "2022-01-20",
            "created_at" => date('Y-m-d H:i:s'),
            "updated_at" => date('Y-m-d H:i:s'),
        ];
        $data[] = [
            'title' => 'Singing Classes',
            "monthly_fees" => 200,
            "class_id" => 7,
            "start_date" => "2022-01-20",
            "created_at" => date('Y-m-d H:i:s'),
            "updated_at" => date('Y-m-d H:i:s'),
        ];
        $data[] = [
            'title' => 'Singing Classes',
            "monthly_fees" => 200,
            "class_id" => 8,
            "start_date" => "2022-01-20",
            "created_at" => date('Y-m-d H:i:s'),
            "updated_at" => date('Y-m-d H:i:s'),
        ];
        //
        $data[] = [
            'title' => 'Musical Instruments (Guitar, Keyboard etc)',
            "monthly_fees" => 200,
            "class_id" => null,
            "start_date" => "2022-01-20",
            "created_at" => date('Y-m-d H:i:s'),
            "updated_at" => date('Y-m-d H:i:s'),
        ];
        //
        $data[] = [
            'title' => 'Banking and other competitive course preparation',
            "monthly_fees" => 200,
            "class_id" => null,
            "start_date" => "2022-01-20",
            "created_at" => date('Y-m-d H:i:s'),
            "updated_at" => date('Y-m-d H:i:s'),
        ];
        //
        $data[] = [
            'title' => 'Parent and Child Counselling sessions',
            "monthly_fees" => 500,
            "class_id" => null,
            "start_date" => "2022-01-20",
            "created_at" => date('Y-m-d H:i:s'),
            "updated_at" => date('Y-m-d H:i:s'),
        ];
        //
        $data[] = [
            'title' => 'Montessori Teacher Training program',
            "monthly_fees" => 500,
            "class_id" => null,
            "start_date" => "2022-01-20",
            "created_at" => date('Y-m-d H:i:s'),
            "updated_at" => date('Y-m-d H:i:s'),
        ];
        //
        $data[] = [
            'title' => 'Basic and Advance Yoga Classes',
            "monthly_fees" => 500,
            "class_id" => null,
            "start_date" => "2022-01-20",
            "created_at" => date('Y-m-d H:i:s'),
            "updated_at" => date('Y-m-d H:i:s'),
        ];
        //
        $data[] = [
            'title' => 'Online Skit classes for kids',
            "monthly_fees" => 500,
            "class_id" => null,
            "start_date" => "2022-01-20",
            "created_at" => date('Y-m-d H:i:s'),
            "updated_at" => date('Y-m-d H:i:s'),
        ];
        //
        $data[] = [
            'title' => 'Coding Classes',
            "monthly_fees" => 500,
            "class_id" => null,
            "start_date" => "2022-01-20",
            "created_at" => date('Y-m-d H:i:s'),
            "updated_at" => date('Y-m-d H:i:s'),
        ];
        $data[] = [
            'title' => 'Coding Classes',
            "monthly_fees" => 500,
            "class_id" => 1,
            "start_date" => "2022-01-20",
            "created_at" => date('Y-m-d H:i:s'),
            "updated_at" => date('Y-m-d H:i:s'),
        ];
        $data[] = [
            'title' => 'Coding Classes',
            "monthly_fees" => 500,
            "class_id" => 2,
            "start_date" => "2022-01-20",
            "created_at" => date('Y-m-d H:i:s'),
            "updated_at" => date('Y-m-d H:i:s'),
        ];
        $data[] = [
            'title' => 'Coding Classes',
            "monthly_fees" => 500,
            "class_id" => 3,
            "start_date" => "2022-01-20",
            "created_at" => date('Y-m-d H:i:s'),
            "updated_at" => date('Y-m-d H:i:s'),
        ];
        $data[] = [
            'title' => 'Coding Classes',
            "monthly_fees" => 500,
            "class_id" => 4,
            "start_date" => "2022-01-20",
            "created_at" => date('Y-m-d H:i:s'),
            "updated_at" => date('Y-m-d H:i:s'),
        ];
        $data[] = [
            'title' => 'Coding Classes',
            "monthly_fees" => 500,
            "class_id" => 5,
            "start_date" => "2022-01-20",
            "created_at" => date('Y-m-d H:i:s'),
            "updated_at" => date('Y-m-d H:i:s'),
        ];
        $data[] = [
            'title' => 'Coding Classes',
            "monthly_fees" => 500,
            "class_id" => 6,
            "start_date" => "2022-01-20",
            "created_at" => date('Y-m-d H:i:s'),
            "updated_at" => date('Y-m-d H:i:s'),
        ];
        $data[] = [
            'title' => 'Coding Classes',
            "monthly_fees" => 500,
            "class_id" => 7,
            "start_date" => "2022-01-20",
            "created_at" => date('Y-m-d H:i:s'),
            "updated_at" => date('Y-m-d H:i:s'),
        ];
        $data[] = [
            'title' => 'Coding Classes',
            "monthly_fees" => 500,
            "class_id" => 8,
            "start_date" => "2022-01-20",
            "created_at" => date('Y-m-d H:i:s'),
            "updated_at" => date('Y-m-d H:i:s'),
        ];
        //
        $data[] = [
            'title' => 'Cooking Classes',
            "monthly_fees" => 500,
            "class_id" => null,
            "start_date" => "2022-01-20",
            "created_at" => date('Y-m-d H:i:s'),
            "updated_at" => date('Y-m-d H:i:s'),
        ];
        //
        $data[] = [
            'title' => 'Chess classes',
            "monthly_fees" => 500,
            "class_id" => null,
            "start_date" => "2022-01-20",
            "created_at" => date('Y-m-d H:i:s'),
            "updated_at" => date('Y-m-d H:i:s'),
        ];

        DB::table('special_courses')->insert($data);
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('special_classes', function (Blueprint $table) {
            //
        });
    }
}
