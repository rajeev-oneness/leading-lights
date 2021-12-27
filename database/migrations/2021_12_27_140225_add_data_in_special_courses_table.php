<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

class AddDataInSpecialCoursesTable extends Migration
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
            'description' => 'Improve your calculation ability, brain development, mental arithmetic and number sense-Become an Abacus Master
            ',
            'image' => 'courses/drawing.jpg',
            "monthly_fees" => 300,
            "class_id" => 1,
            "start_date" => "2022-01-20",
            "created_at" => date('Y-m-d H:i:s'),
            "updated_at" => date('Y-m-d H:i:s'),
        ];
        $data[] = [
            'title' => 'Abacus',
            'description' => 'Improve your calculation ability, brain development, mental arithmetic and number sense-Become an Abacus Master
            ',
            'image' => 'courses/drawing.jpg',
            "monthly_fees" => 300,
            "class_id" => 2,
            "start_date" => "2022-01-20",
            "created_at" => date('Y-m-d H:i:s'),
            "updated_at" => date('Y-m-d H:i:s'),
        ];
        $data[] = [
            'title' => 'Abacus',
            'description' => 'Improve your calculation ability, brain development, mental arithmetic and number sense-Become an Abacus Master
            ',
            'image' => 'courses/drawing.jpg',
            "monthly_fees" => 300,
            "class_id" => 3,
            "start_date" => "2022-01-20",
            "created_at" => date('Y-m-d H:i:s'),
            "updated_at" => date('Y-m-d H:i:s'),
        ];
        $data[] = [
            'title' => 'Abacus',
            'description' => 'Improve your calculation ability, brain development, mental arithmetic and number sense-Become an Abacus Master
            ',
            'image' => 'courses/drawing.jpg',
            "monthly_fees" => 300,
            "class_id" => 4,
            "start_date" => "2022-01-20",
            "created_at" => date('Y-m-d H:i:s'),
            "updated_at" => date('Y-m-d H:i:s'),
        ];
        $data[] = [
            'title' => 'Abacus',
            'description' => 'Improve your calculation ability, brain development, mental arithmetic and number sense-Become an Abacus Master
            ',
            'image' => 'courses/drawing.jpg',
            "monthly_fees" => 300,
            "class_id" => 5,
            "start_date" => "2022-01-20",
            "created_at" => date('Y-m-d H:i:s'),
            "updated_at" => date('Y-m-d H:i:s'),
        ];
        $data[] = [
            'title' => 'Abacus',
            'description' => 'Improve your calculation ability, brain development, mental arithmetic and number sense-Become an Abacus Master
            ',
            'image' => 'courses/drawing.jpg',
            "monthly_fees" => 300,
            "class_id" => 6,
            "start_date" => "2022-01-20",
            "created_at" => date('Y-m-d H:i:s'),
            "updated_at" => date('Y-m-d H:i:s'),
        ];
        $data[] = [
            'title' => 'Abacus',
            'description' => 'Improve your calculation ability, brain development, mental arithmetic and number sense-Become an Abacus Master
            ',
            'image' => 'courses/drawing.jpg',
            "monthly_fees" => 300,
            "class_id" => 7,
            "start_date" => "2022-01-20",
            "created_at" => date('Y-m-d H:i:s'),
            "updated_at" => date('Y-m-d H:i:s'),
        ];
        $data[] = [
            'title' => 'Abacus',
            'description' => 'Improve your calculation ability, brain development, mental arithmetic and number sense-Become an Abacus Master
            ',
            'image' => 'courses/drawing.jpg',
            "monthly_fees" => 300,
            "class_id" => 8,
            "start_date" => "2022-01-20",
            "created_at" => date('Y-m-d H:i:s'),
            "updated_at" => date('Y-m-d H:i:s'),
        ];
        $data[] = [
            'title' => 'Abacus',
            'description' => 'Improve your calculation ability, brain development, mental arithmetic and number sense-Become an Abacus Master
            ',
            'image' => 'courses/drawing.jpg',
            "monthly_fees" => 300,
            "class_id" => null,
            "start_date" => "2022-01-20",
            "created_at" => date('Y-m-d H:i:s'),
            "updated_at" => date('Y-m-d H:i:s'),
        ];
        //
        $data[] = [
            'title' => 'Drawing (Painting, Art & Craft etc)',
            'description' => 'Drawing is not a talent. It\'s a skill anyone can learn.
            ',
            'image' => 'courses/drawing.jpg',
            "monthly_fees" => 400,
            "class_id" => null,
            "start_date" => "2022-01-20",
            "created_at" => date('Y-m-d H:i:s'),
            "updated_at" => date('Y-m-d H:i:s'),
        ];
        $data[] = [
            'title' => 'Drawing (Painting, Art & Craft etc)',
            'description' => 'Drawing is not a talent. It\'s a skill anyone can learn.
            ',
            'image' => 'courses/drawing.jpg',
            "monthly_fees" => 400,
            "class_id" => 1,
            "start_date" => "2022-01-20",
            "created_at" => date('Y-m-d H:i:s'),
            "updated_at" => date('Y-m-d H:i:s'),
        ];
        $data[] = [
            'title' => 'Drawing (Painting, Art & Craft etc)',
            'description' => 'Drawing is not a talent. It\'s a skill anyone can learn.
            ',
            'image' => 'courses/drawing.jpg',
            "monthly_fees" => 400,
            "class_id" => 2,
            "start_date" => "2022-01-20",
            "created_at" => date('Y-m-d H:i:s'),
            "updated_at" => date('Y-m-d H:i:s'),
        ];
        $data[] = [
            'title' => 'Drawing (Painting, Art & Craft etc)',
            'description' => 'Drawing is not a talent. It\'s a skill anyone can learn.
            ',
            'image' => 'courses/drawing.jpg',
            "monthly_fees" => 400,
            "class_id" => 3,
            "start_date" => "2022-01-20",
            "created_at" => date('Y-m-d H:i:s'),
            "updated_at" => date('Y-m-d H:i:s'),
        ];
        $data[] = [
            'title' => 'Drawing (Painting, Art & Craft etc)',
            'description' => 'Drawing is not a talent. It\'s a skill anyone can learn.
            ',
            'image' => 'courses/drawing.jpg',
            "monthly_fees" => 400,
            "class_id" => 4,
            "start_date" => "2022-01-20",
            "created_at" => date('Y-m-d H:i:s'),
            "updated_at" => date('Y-m-d H:i:s'),
        ];
        $data[] = [
            'title' => 'Drawing (Painting, Art & Craft etc)',
            'description' => 'Drawing is not a talent. It\'s a skill anyone can learn.
            ',
            'image' => 'courses/drawing.jpg',
            "monthly_fees" => 400,
            "class_id" => 5,
            "start_date" => "2022-01-20",
            "created_at" => date('Y-m-d H:i:s'),
            "updated_at" => date('Y-m-d H:i:s'),
        ];
        $data[] = [
            'title' => 'Drawing (Painting, Art & Craft etc)',
            'description' => 'Drawing is not a talent. It\'s a skill anyone can learn.
            ',
            'image' => 'courses/drawing.jpg',
            "monthly_fees" => 400,
            "class_id" => 6,
            "start_date" => "2022-01-20",
            "created_at" => date('Y-m-d H:i:s'),
            "updated_at" => date('Y-m-d H:i:s'),
        ];
        $data[] = [
            'title' => 'Drawing (Painting, Art & Craft etc)',
            'description' => 'Drawing is not a talent. It\'s a skill anyone can learn.
            ',
            'image' => 'courses/drawing.jpg',
            "monthly_fees" => 400,
            "class_id" => 7,
            "start_date" => "2022-01-20",
            "created_at" => date('Y-m-d H:i:s'),
            "updated_at" => date('Y-m-d H:i:s'),
        ];
        $data[] = [
            'title' => 'Drawing (Painting, Art & Craft etc)',
            'description' => 'Drawing is not a talent. It\'s a skill anyone can learn.
            ',
            'image' => 'courses/drawing.jpg',
            "monthly_fees" => 400,
            "class_id" => 8,
            "start_date" => "2022-01-20",
            "created_at" => date('Y-m-d H:i:s'),
            "updated_at" => date('Y-m-d H:i:s'),
        ];
        //
        $data[] = [
            'title' => 'Spoken English Classes',
            'description' => 'English is not a talent. It\'s a skill anyone can learn.
            ',
            'image' => 'courses/drawing.jpg',
            "monthly_fees" => 400,
            "class_id" => null,
            "start_date" => "2022-01-20",
            "created_at" => date('Y-m-d H:i:s'),
            "updated_at" => date('Y-m-d H:i:s'),
        ];
        $data[] = [
            'title' => 'Spoken English Classes',
             'description' => 'English is not a talent. It\'s a skill anyone can learn.
            ',
            'image' => 'courses/drawing.jpg',
            "monthly_fees" => 400,
            "class_id" => 1,
            "start_date" => "2022-01-20",
            "created_at" => date('Y-m-d H:i:s'),
            "updated_at" => date('Y-m-d H:i:s'),
        ];
        $data[] = [
            'title' => 'Spoken English Classes',
             'description' => 'English is not a talent. It\'s a skill anyone can learn.
            ',
            'image' => 'courses/drawing.jpg',
            "monthly_fees" => 400,
            "class_id" => 2,
            "start_date" => "2022-01-20",
            "created_at" => date('Y-m-d H:i:s'),
            "updated_at" => date('Y-m-d H:i:s'),
        ];
        $data[] = [
            'title' => 'Spoken English Classes',
             'description' => 'English is not a talent. It\'s a skill anyone can learn.
            ',
            'image' => 'courses/drawing.jpg',
            "monthly_fees" => 400,
            "class_id" => 3,
            "start_date" => "2022-01-20",
            "created_at" => date('Y-m-d H:i:s'),
            "updated_at" => date('Y-m-d H:i:s'),
        ];
        $data[] = [
            'title' => 'Spoken English Classes',
             'description' => 'English is not a talent. It\'s a skill anyone can learn.
            ',
            'image' => 'courses/drawing.jpg',
            "monthly_fees" => 400,
            "class_id" => 4,
            "start_date" => "2022-01-20",
            "created_at" => date('Y-m-d H:i:s'),
            "updated_at" => date('Y-m-d H:i:s'),
        ];
        $data[] = [
            'title' => 'Spoken English Classes',
             'description' => 'English is not a talent. It\'s a skill anyone can learn.
            ',
            'image' => 'courses/drawing.jpg',
            "monthly_fees" => 400,
            "class_id" => 5,
            "start_date" => "2022-01-20",
            "created_at" => date('Y-m-d H:i:s'),
            "updated_at" => date('Y-m-d H:i:s'),
        ];
        $data[] = [
            'title' => 'Spoken English Classes',
             'description' => 'English is not a talent. It\'s a skill anyone can learn.
            ',
            'image' => 'courses/drawing.jpg',
            "monthly_fees" => 400,
            "class_id" => 6,
            "start_date" => "2022-01-20",
            "created_at" => date('Y-m-d H:i:s'),
            "updated_at" => date('Y-m-d H:i:s'),
        ];
        $data[] = [
            'title' => 'Spoken English Classes',
             'description' => 'English is not a talent. It\'s a skill anyone can learn.
            ',
            'image' => 'courses/drawing.jpg',
            "monthly_fees" => 400,
            "class_id" => 7,
            "start_date" => "2022-01-20",
            "created_at" => date('Y-m-d H:i:s'),
            "updated_at" => date('Y-m-d H:i:s'),
        ];
        $data[] = [
            'title' => 'Spoken English Classes',
             'description' => 'English is not a talent. It\'s a skill anyone can learn.
            ',
            'image' => 'courses/drawing.jpg',
            "monthly_fees" => 400,
            "class_id" => 8,
            "start_date" => "2022-01-20",
            "created_at" => date('Y-m-d H:i:s'),
            "updated_at" => date('Y-m-d H:i:s'),
        ];
        //
        $data[] = [
            'title' => 'Computer Classes',
             'description' => 'Computer is not a talent. It\'s a skill anyone can learn.
            ',
            'image' => 'courses/drawing.jpg',
            "monthly_fees" => 400,
            "class_id" => null,
            "start_date" => "2022-01-20",
            "created_at" => date('Y-m-d H:i:s'),
            "updated_at" => date('Y-m-d H:i:s'),
        ];
        $data[] = [
            'title' => 'Computer Classes',
             'description' => 'Computer is not a talent. It\'s a skill anyone can learn.
            ',
            'image' => 'courses/drawing.jpg',
            "monthly_fees" => 400,
            "class_id" => 1,
            "start_date" => "2022-01-20",
            "created_at" => date('Y-m-d H:i:s'),
            "updated_at" => date('Y-m-d H:i:s'),
        ];
        $data[] = [
            'title' => 'Computer Classes',
             'description' => 'Computer is not a talent. It\'s a skill anyone can learn.
            ',
            'image' => 'courses/drawing.jpg',
            "monthly_fees" => 400,
            "class_id" => 2,
            "start_date" => "2022-01-20",
            "created_at" => date('Y-m-d H:i:s'),
            "updated_at" => date('Y-m-d H:i:s'),
        ];
        $data[] = [
            'title' => 'Computer Classes',
             'description' => 'Computer is not a talent. It\'s a skill anyone can learn.
            ',
            'image' => 'courses/drawing.jpg',
            "monthly_fees" => 400,
            "class_id" => 3,
            "start_date" => "2022-01-20",
            "created_at" => date('Y-m-d H:i:s'),
            "updated_at" => date('Y-m-d H:i:s'),
        ];
        $data[] = [
            'title' => 'Computer Classes',
             'description' => 'Computer is not a talent. It\'s a skill anyone can learn.
            ',
            'image' => 'courses/drawing.jpg',
            "monthly_fees" => 400,
            "class_id" => 4,
            "start_date" => "2022-01-20",
            "created_at" => date('Y-m-d H:i:s'),
            "updated_at" => date('Y-m-d H:i:s'),
        ];
        $data[] = [
            'title' => 'Computer Classes',
             'description' => 'Computer is not a talent. It\'s a skill anyone can learn.
            ',
            'image' => 'courses/drawing.jpg',
            "monthly_fees" => 400,
            "class_id" => 5,
            "start_date" => "2022-01-20",
            "created_at" => date('Y-m-d H:i:s'),
            "updated_at" => date('Y-m-d H:i:s'),
        ];
        $data[] = [
            'title' => 'Computer Classes',
             'description' => 'Computer is not a talent. It\'s a skill anyone can learn.
            ',
            'image' => 'courses/drawing.jpg',
            "monthly_fees" => 400,
            "class_id" => 6,
            "start_date" => "2022-01-20",
            "created_at" => date('Y-m-d H:i:s'),
            "updated_at" => date('Y-m-d H:i:s'),
        ];
        $data[] = [
            'title' => 'Computer Classes',
             'description' => 'Computer is not a talent. It\'s a skill anyone can learn.
            ',
            'image' => 'courses/drawing.jpg',
            "monthly_fees" => 400,
            "class_id" => 7,
            "start_date" => "2022-01-20",
            "created_at" => date('Y-m-d H:i:s'),
            "updated_at" => date('Y-m-d H:i:s'),
        ];
        $data[] = [
            'title' => 'Computer Classes',
             'description' => 'Computer is not a talent. It\'s a skill anyone can learn.
            ',
            'image' => 'courses/drawing.jpg',
            "monthly_fees" => 400,
            "class_id" => 8,
            "start_date" => "2022-01-20",
            "created_at" => date('Y-m-d H:i:s'),
            "updated_at" => date('Y-m-d H:i:s'),
        ];
        //
        $data[] = [
            'title' => 'Career Development Programs',
            'description' => 'Computer is not a talent. It\'s a skill anyone can learn.
            ',
            'image' => 'courses/drawing.jpg',
            "monthly_fees" => 400,
            "class_id" => null,
            "start_date" => "2022-01-20",
            "created_at" => date('Y-m-d H:i:s'),
            "updated_at" => date('Y-m-d H:i:s'),
        ];
        //
        $data[] = [
            'title' => 'Child and Adult interview preparation sessions',
            'description' => 'Computer is not a talent. It\'s a skill anyone can learn.
            ',
            'image' => 'courses/drawing.jpg',
            "monthly_fees" => 500,
            "class_id" => null,
            "start_date" => "2022-01-20",
            "created_at" => date('Y-m-d H:i:s'),
            "updated_at" => date('Y-m-d H:i:s'),
        ];
        //
        $data[] = [
            'title' => 'Handwriting Improvement Courses',
            'description' => 'Computer is not a talent. It\'s a skill anyone can learn.
            ',
            'image' => 'courses/drawing.jpg',
            "monthly_fees" => 200,
            "class_id" => 1,
            "start_date" => "2022-01-20",
            "created_at" => date('Y-m-d H:i:s'),
            "updated_at" => date('Y-m-d H:i:s'),
        ];
        $data[] = [
            'title' => 'Handwriting Improvement Courses',
            'description' => 'Computer is not a talent. It\'s a skill anyone can learn.
            ',
            'image' => 'courses/drawing.jpg',
            "monthly_fees" => 200,
            "class_id" => 2,
            "start_date" => "2022-01-20",
            "created_at" => date('Y-m-d H:i:s'),
            "updated_at" => date('Y-m-d H:i:s'),
        ];
        $data[] = [
            'title' => 'Handwriting Improvement Courses',
            'description' => 'Computer is not a talent. It\'s a skill anyone can learn.
            ',
            'image' => 'courses/drawing.jpg',
            "monthly_fees" => 200,
            "class_id" => 3,
            "start_date" => "2022-01-20",
            "created_at" => date('Y-m-d H:i:s'),
            "updated_at" => date('Y-m-d H:i:s'),
        ];
        $data[] = [
            'title' => 'Handwriting Improvement Courses',
            'description' => 'Computer is not a talent. It\'s a skill anyone can learn.
            ',
            'image' => 'courses/drawing.jpg',
            "monthly_fees" => 200,
            "class_id" => 4,
            "start_date" => "2022-01-20",
            "created_at" => date('Y-m-d H:i:s'),
            "updated_at" => date('Y-m-d H:i:s'),
        ];
        $data[] = [
            'title' => 'Handwriting Improvement Courses',
            'description' => 'Computer is not a talent. It\'s a skill anyone can learn.
            ',
            'image' => 'courses/drawing.jpg',
            "monthly_fees" => 200,
            "class_id" => 5,
            "start_date" => "2022-01-20",
            "created_at" => date('Y-m-d H:i:s'),
            "updated_at" => date('Y-m-d H:i:s'),
        ];
        $data[] = [
            'title' => 'Handwriting Improvement Courses',
            'description' => 'Computer is not a talent. It\'s a skill anyone can learn.
            ',
            'image' => 'courses/drawing.jpg',
            "monthly_fees" => 200,
            "class_id" => 6,
            "start_date" => "2022-01-20",
            "created_at" => date('Y-m-d H:i:s'),
            "updated_at" => date('Y-m-d H:i:s'),
        ];
        $data[] = [
            'title' => 'Handwriting Improvement Courses',
            'description' => 'Computer is not a talent. It\'s a skill anyone can learn.
            ',
            'image' => 'courses/drawing.jpg',
            "monthly_fees" => 200,
            "class_id" => 7,
            "start_date" => "2022-01-20",
            "created_at" => date('Y-m-d H:i:s'),
            "updated_at" => date('Y-m-d H:i:s'),
        ];
        $data[] = [
            'title' => 'Handwriting Improvement Courses',
            'description' => 'Computer is not a talent. It\'s a skill anyone can learn.
            ',
            'image' => 'courses/drawing.jpg',
            "monthly_fees" => 200,
            "class_id" => 8,
            "start_date" => "2022-01-20",
            "created_at" => date('Y-m-d H:i:s'),
            "updated_at" => date('Y-m-d H:i:s'),
        ];
        //
        $data[] = [
            'title' => 'Dance (Western and Classical)',
            'description' => 'Computer is not a talent. It\'s a skill anyone can learn.
            ',
            'image' => 'courses/drawing.jpg',
            "monthly_fees" => 200,
            "class_id" => 1,
            "start_date" => "2022-01-20",
            "created_at" => date('Y-m-d H:i:s'),
            "updated_at" => date('Y-m-d H:i:s'),
        ];
        $data[] = [
            'title' => 'Dance (Western and Classical)',
            'description' => 'Computer is not a talent. It\'s a skill anyone can learn.
            ',
            'image' => 'courses/drawing.jpg',
            "monthly_fees" => 200,
            "class_id" => 2,
            "start_date" => "2022-01-20",
            "created_at" => date('Y-m-d H:i:s'),
            "updated_at" => date('Y-m-d H:i:s'),
        ];
        $data[] = [
            'title' => 'Dance (Western and Classical)',
            'description' => 'Computer is not a talent. It\'s a skill anyone can learn.
            ',
            'image' => 'courses/drawing.jpg',
            "monthly_fees" => 200,
            "class_id" => 3,
            "start_date" => "2022-01-20",
            "created_at" => date('Y-m-d H:i:s'),
            "updated_at" => date('Y-m-d H:i:s'),
        ];
        $data[] = [
            'title' => 'Dance (Western and Classical)',
            'description' => 'Computer is not a talent. It\'s a skill anyone can learn.
            ',
            'image' => 'courses/drawing.jpg',
            "monthly_fees" => 200,
            "class_id" => 4,
            "start_date" => "2022-01-20",
            "created_at" => date('Y-m-d H:i:s'),
            "updated_at" => date('Y-m-d H:i:s'),
        ];
        $data[] = [
            'title' => 'Dance (Western and Classical)',
            'description' => 'Computer is not a talent. It\'s a skill anyone can learn.
            ',
            'image' => 'courses/drawing.jpg',
            "monthly_fees" => 200,
            "class_id" => 5,
            "start_date" => "2022-01-20",
            "created_at" => date('Y-m-d H:i:s'),
            "updated_at" => date('Y-m-d H:i:s'),
        ];
        $data[] = [
            'title' => 'Dance (Western and Classical)',
            'description' => 'Computer is not a talent. It\'s a skill anyone can learn.
            ',
            'image' => 'courses/drawing.jpg',
            "monthly_fees" => 200,
            "class_id" => 6,
            "start_date" => "2022-01-20",
            "created_at" => date('Y-m-d H:i:s'),
            "updated_at" => date('Y-m-d H:i:s'),
        ];
        $data[] = [
            'title' => 'Dance (Western and Classical)',
            'description' => 'Computer is not a talent. It\'s a skill anyone can learn.
            ',
            'image' => 'courses/drawing.jpg',
            "monthly_fees" => 200,
            "class_id" => 7,
            "start_date" => "2022-01-20",
            "created_at" => date('Y-m-d H:i:s'),
            "updated_at" => date('Y-m-d H:i:s'),
        ];
        $data[] = [
            'title' => 'Dance (Western and Classical)',
            'description' => 'Computer is not a talent. It\'s a skill anyone can learn.
            ',
            'image' => 'courses/drawing.jpg',
            "monthly_fees" => 200,
            "class_id" => 8,
            "start_date" => "2022-01-20",
            "created_at" => date('Y-m-d H:i:s'),
            "updated_at" => date('Y-m-d H:i:s'),
        ];
        $data[] = [
            'title' => 'Dance (Western and Classical)',
            'description' => 'Computer is not a talent. It\'s a skill anyone can learn.
            ',
            'image' => 'courses/drawing.jpg',
            "monthly_fees" => 200,
            "class_id" => null,
            "start_date" => "2022-01-20",
            "created_at" => date('Y-m-d H:i:s'),
            "updated_at" => date('Y-m-d H:i:s'),
        ];
        //
        $data[] = [
            'title' => 'Lead Absolute (An Exquisite Overall Development Course)',
            'description' => 'Computer is not a talent. It\'s a skill anyone can learn.
            ',
            'image' => 'courses/drawing.jpg',
            "monthly_fees" => 200,
            "class_id" => null,
            "start_date" => "2022-01-20",
            "created_at" => date('Y-m-d H:i:s'),
            "updated_at" => date('Y-m-d H:i:s'),
        ];
        //
        $data[] = [
            'title' => 'Singing Classes',
            'description' => 'Computer is not a talent. It\'s a skill anyone can learn.
            ',
            'image' => 'courses/drawing.jpg',
            "monthly_fees" => 200,
            "class_id" => null,
            "start_date" => "2022-01-20",
            "created_at" => date('Y-m-d H:i:s'),
            "updated_at" => date('Y-m-d H:i:s'),
        ];
        $data[] = [
            'title' => 'Singing Classes',
            'description' => 'Computer is not a talent. It\'s a skill anyone can learn.
            ',
            'image' => 'courses/drawing.jpg',
            "monthly_fees" => 200,
            "class_id" => 1,
            "start_date" => "2022-01-20",
            "created_at" => date('Y-m-d H:i:s'),
            "updated_at" => date('Y-m-d H:i:s'),
        ];
        $data[] = [
            'title' => 'Singing Classes',
            'description' => 'Computer is not a talent. It\'s a skill anyone can learn.
            ',
            'image' => 'courses/drawing.jpg',
            "monthly_fees" => 200,
            "class_id" => 2,
            "start_date" => "2022-01-20",
            "created_at" => date('Y-m-d H:i:s'),
            "updated_at" => date('Y-m-d H:i:s'),
        ];
        $data[] = [
            'title' => 'Singing Classes',
            'description' => 'Computer is not a talent. It\'s a skill anyone can learn.
            ',
            'image' => 'courses/drawing.jpg',
            "monthly_fees" => 200,
            "class_id" => 3,
            "start_date" => "2022-01-20",
            "created_at" => date('Y-m-d H:i:s'),
            "updated_at" => date('Y-m-d H:i:s'),
        ];
        $data[] = [
            'title' => 'Singing Classes',
            'description' => 'Computer is not a talent. It\'s a skill anyone can learn.
            ',
            'image' => 'courses/drawing.jpg',
            "monthly_fees" => 200,
            "class_id" => 4,
            "start_date" => "2022-01-20",
            "created_at" => date('Y-m-d H:i:s'),
            "updated_at" => date('Y-m-d H:i:s'),
        ];
        $data[] = [
            'title' => 'Singing Classes',
            'description' => 'Computer is not a talent. It\'s a skill anyone can learn.
            ',
            'image' => 'courses/drawing.jpg',
            "monthly_fees" => 200,
            "class_id" => 5,
            "start_date" => "2022-01-20",
            "created_at" => date('Y-m-d H:i:s'),
            "updated_at" => date('Y-m-d H:i:s'),
        ];
        $data[] = [
            'title' => 'Singing Classes',
            'description' => 'Computer is not a talent. It\'s a skill anyone can learn.
            ',
            'image' => 'courses/drawing.jpg',
            "monthly_fees" => 200,
            "class_id" => 6,
            "start_date" => "2022-01-20",
            "created_at" => date('Y-m-d H:i:s'),
            "updated_at" => date('Y-m-d H:i:s'),
        ];
        $data[] = [
            'title' => 'Singing Classes',
            'description' => 'Computer is not a talent. It\'s a skill anyone can learn.
            ',
            'image' => 'courses/drawing.jpg',
            "monthly_fees" => 200,
            "class_id" => 7,
            "start_date" => "2022-01-20",
            "created_at" => date('Y-m-d H:i:s'),
            "updated_at" => date('Y-m-d H:i:s'),
        ];
        $data[] = [
            'title' => 'Singing Classes',
            'description' => 'Computer is not a talent. It\'s a skill anyone can learn.
            ',
            'image' => 'courses/drawing.jpg',
            "monthly_fees" => 200,
            "class_id" => 8,
            "start_date" => "2022-01-20",
            "created_at" => date('Y-m-d H:i:s'),
            "updated_at" => date('Y-m-d H:i:s'),
        ];
        //
        $data[] = [
            'title' => 'Musical Instruments (Guitar, Keyboard etc)',
            'description' => 'Computer is not a talent. It\'s a skill anyone can learn.
            ',
            'image' => 'courses/drawing.jpg',
            "monthly_fees" => 200,
            "class_id" => null,
            "start_date" => "2022-01-20",
            "created_at" => date('Y-m-d H:i:s'),
            "updated_at" => date('Y-m-d H:i:s'),
        ];
        //
        $data[] = [
            'title' => 'Banking and other competitive course preparation',
            'description' => 'Computer is not a talent. It\'s a skill anyone can learn.
            ',
            'image' => 'courses/drawing.jpg',
            "monthly_fees" => 200,
            "class_id" => null,
            "start_date" => "2022-01-20",
            "created_at" => date('Y-m-d H:i:s'),
            "updated_at" => date('Y-m-d H:i:s'),
        ];
        //
        $data[] = [
            'title' => 'Parent and Child Counselling sessions',
            'description' => 'Computer is not a talent. It\'s a skill anyone can learn.
            ',
            'image' => 'courses/drawing.jpg',
            "monthly_fees" => 500,
            "class_id" => null,
            "start_date" => "2022-01-20",
            "created_at" => date('Y-m-d H:i:s'),
            "updated_at" => date('Y-m-d H:i:s'),
        ];
        //
        $data[] = [
            'title' => 'Montessori Teacher Training program',
            'description' => 'Computer is not a talent. It\'s a skill anyone can learn.
            ',
            'image' => 'courses/drawing.jpg',
            "monthly_fees" => 500,
            "class_id" => null,
            "start_date" => "2022-01-20",
            "created_at" => date('Y-m-d H:i:s'),
            "updated_at" => date('Y-m-d H:i:s'),
        ];
        //
        $data[] = [
            'title' => 'Basic and Advance Yoga Classes',
            'description' => 'Computer is not a talent. It\'s a skill anyone can learn.
            ',
            'image' => 'courses/drawing.jpg',
            "monthly_fees" => 500,
            "class_id" => null,
            "start_date" => "2022-01-20",
            "created_at" => date('Y-m-d H:i:s'),
            "updated_at" => date('Y-m-d H:i:s'),
        ];
        //
        $data[] = [
            'title' => 'Online Skit classes for kids',
            'description' => 'Computer is not a talent. It\'s a skill anyone can learn.
            ',
            'image' => 'courses/drawing.jpg',
            "monthly_fees" => 500,
            "class_id" => null,
            "start_date" => "2022-01-20",
            "created_at" => date('Y-m-d H:i:s'),
            "updated_at" => date('Y-m-d H:i:s'),
        ];
        //
        $data[] = [
            'title' => 'Coding Classes',
            'description' => 'Computer is not a talent. It\'s a skill anyone can learn.
            ',
            'image' => 'courses/drawing.jpg',
            "monthly_fees" => 500,
            "class_id" => null,
            "start_date" => "2022-01-20",
            "created_at" => date('Y-m-d H:i:s'),
            "updated_at" => date('Y-m-d H:i:s'),
        ];
        $data[] = [
            'title' => 'Coding Classes',
            'description' => 'Computer is not a talent. It\'s a skill anyone can learn.
            ',
            'image' => 'courses/drawing.jpg',
            "monthly_fees" => 500,
            "class_id" => 1,
            "start_date" => "2022-01-20",
            "created_at" => date('Y-m-d H:i:s'),
            "updated_at" => date('Y-m-d H:i:s'),
        ];
        $data[] = [
            'title' => 'Coding Classes',
            'description' => 'Computer is not a talent. It\'s a skill anyone can learn.
            ',
            'image' => 'courses/drawing.jpg',
            "monthly_fees" => 500,
            "class_id" => 2,
            "start_date" => "2022-01-20",
            "created_at" => date('Y-m-d H:i:s'),
            "updated_at" => date('Y-m-d H:i:s'),
        ];
        $data[] = [
            'title' => 'Coding Classes',
            'description' => 'Computer is not a talent. It\'s a skill anyone can learn.
            ',
            'image' => 'courses/drawing.jpg',
            "monthly_fees" => 500,
            "class_id" => 3,
            "start_date" => "2022-01-20",
            "created_at" => date('Y-m-d H:i:s'),
            "updated_at" => date('Y-m-d H:i:s'),
        ];
        $data[] = [
            'title' => 'Coding Classes',
            'description' => 'Computer is not a talent. It\'s a skill anyone can learn.
            ',
            'image' => 'courses/drawing.jpg',
            "monthly_fees" => 500,
            "class_id" => 4,
            "start_date" => "2022-01-20",
            "created_at" => date('Y-m-d H:i:s'),
            "updated_at" => date('Y-m-d H:i:s'),
        ];
        $data[] = [
            'title' => 'Coding Classes',
            'description' => 'Computer is not a talent. It\'s a skill anyone can learn.
            ',
            'image' => 'courses/drawing.jpg',
            "monthly_fees" => 500,
            "class_id" => 5,
            "start_date" => "2022-01-20",
            "created_at" => date('Y-m-d H:i:s'),
            "updated_at" => date('Y-m-d H:i:s'),
        ];
        $data[] = [
            'title' => 'Coding Classes',
            'description' => 'Computer is not a talent. It\'s a skill anyone can learn.
            ',
            'image' => 'courses/drawing.jpg',
            "monthly_fees" => 500,
            "class_id" => 6,
            "start_date" => "2022-01-20",
            "created_at" => date('Y-m-d H:i:s'),
            "updated_at" => date('Y-m-d H:i:s'),
        ];
        $data[] = [
            'title' => 'Coding Classes',
            'description' => 'Computer is not a talent. It\'s a skill anyone can learn.
            ',
            'image' => 'courses/drawing.jpg',
            "monthly_fees" => 500,
            "class_id" => 7,
            "start_date" => "2022-01-20",
            "created_at" => date('Y-m-d H:i:s'),
            "updated_at" => date('Y-m-d H:i:s'),
        ];
        $data[] = [
            'title' => 'Coding Classes',
            'description' => 'Computer is not a talent. It\'s a skill anyone can learn.
            ',
            'image' => 'courses/drawing.jpg',
            "monthly_fees" => 500,
            "class_id" => 8,
            "start_date" => "2022-01-20",
            "created_at" => date('Y-m-d H:i:s'),
            "updated_at" => date('Y-m-d H:i:s'),
        ];
        //
        $data[] = [
            'title' => 'Cooking Classes',
            'description' => 'Computer is not a talent. It\'s a skill anyone can learn.
            ',
            'image' => 'courses/drawing.jpg',
            "monthly_fees" => 500,
            "class_id" => null,
            "start_date" => "2022-01-20",
            "created_at" => date('Y-m-d H:i:s'),
            "updated_at" => date('Y-m-d H:i:s'),
        ];
        //
        $data[] = [
            'title' => 'Chess classes',
            'description' => 'Computer is not a talent. It\'s a skill anyone can learn.
            ',
            'image' => 'courses/drawing.jpg',
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
