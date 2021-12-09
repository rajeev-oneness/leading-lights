@include('student.layouts.head')
@include('student.layouts.header')
@include('student.layouts.sidebar')

<!-- Chat Section -->
@include('chatting.chat')
<!-- Chat Section END -->

@yield('content')
@extends('student.layouts.footer')
