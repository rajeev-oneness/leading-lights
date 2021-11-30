@include('hr.layouts.head')
@include('hr.layouts.header')
@include('hr.layouts.sidebar')

<!-- Chat Section -->
@include('chatting.chat')
<!-- Chat Section END -->

@yield('content')
@extends('hr.layouts.footer')
