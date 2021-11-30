@include('teacher.layouts.head')
@include('teacher.layouts.header')
@include('teacher.layouts.sidebar')

<!-- Chat Section -->
@include('chatting.chat')
<!-- Chat Section END -->

@yield('content')
@include('teacher.layouts.footer')
