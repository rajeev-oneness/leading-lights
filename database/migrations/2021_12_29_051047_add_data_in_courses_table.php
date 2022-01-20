<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddDataInCoursesTable extends Migration
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
            'course_content' => '<ul>
            <li>
            <p>You will learn over 1000 vital English words, expressions and idioms, and how to use them in real life.</p>
            </li>
            <li>
            <p>You will learn to think in English and to speak English fluently. (in Intermediate level)</p>
            </li>
            <li>
            <p>You will learn to understand movies and TV shows in English.</p>
            </li>
            <li>
            <p>After the course, you can start preparing for English language tests.</p>
            </li>
            </ul>',
            'image' => 'courses/drawing.jpg',
            'start_date' => '2022-01-28',
            'sessions' => 20,
            "fees" => 300,
            "created_at" => date('Y-m-d H:i:s'),
            "updated_at" => date('Y-m-d H:i:s'),
        ];
        $data[] = [
            'title' => 'Spoken English',
            'description' => 'Improve your calculation ability, brain development, mental arithmetic and number sense-Become an Abacus Master
            ',
            'course_content' => '<ul>
            <li>
            <p>You will learn over 1000 vital English words, expressions and idioms, and how to use them in real life.</p>
            </li>
            <li>
            <p>You will learn to think in English and to speak English fluently. (in Intermediate level)</p>
            </li>
            <li>
            <p>You will learn to understand movies and TV shows in English.</p>
            </li>
            <li>
            <p>After the course, you can start preparing for English language tests.</p>
            </li>
            </ul>',
            'image' => 'courses/english.jfif',
            'start_date' => '2022-01-30',
            'sessions' => 30,
            "fees" => 400,
            "created_at" => date('Y-m-d H:i:s'),
            "updated_at" => date('Y-m-d H:i:s'),
        ];
        $data[] = [
            'title' => 'The Secrets behinds Drawing',
            'description' => 'A comprehensive online course designed for people wanting to learn the core concepts of drawing.',
            'course_content' => '<p>By the end of this course, the student will have a strong understanding of the core concepts of drawing including materials, processes, and devices.</p>',
            'image' => 'courses/drawing.jpg',
            'start_date' => '2022-02-30',
            'sessions' => 30,
            "fees" => 500,
            "created_at" => date('Y-m-d H:i:s'),
            "updated_at" => date('Y-m-d H:i:s'),
        ];
        $data[] = [
            'title' => 'The Professional Guitar Class',
            'description' => 'Learn The Tools Used By Professional Guitar Players.',
            'course_content' => '<p>By the end of this course, the student will have a strong understanding of the core concepts of drawing including materials, processes, and devices.</p>',
            'image' => 'courses/guiter.png',
            'start_date' => '2022-02-30',
            'sessions' => 30,
            "fees" => 500,
            "created_at" => date('Y-m-d H:i:s'),
            "updated_at" => date('Y-m-d H:i:s'),
        ];

        DB::table('courses')->insert($data);
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('courses', function (Blueprint $table) {
            //
        });
    }
}
