<!doctype html>
<html lang="en">
<meta http-equiv="content-type" content="text/html;charset=UTF-8" />

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta http-equiv="Content-Language" content="en">
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <meta name="csrf_token" content="{{ csrf_token() }}">
    <title>Leading Lights - Teacher Profile </title>
    <meta name="viewport"
        content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no, shrink-to-fit=no" />
    <meta name="description" content="This is an example dashboard created using build-in elements and components.">

    <!-- Disable tap highlight on IE -->
    <meta name="msapplication-tap-highlight" content="no">

    <link href="{{ asset('frontend/main.d810cf0ae7f39f28f336.css') }}" rel="stylesheet">
</head>
<link rel="stylesheet" type="text/css"
    href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.9.0/css/bootstrap-datepicker.css">
<link rel="stylesheet" type="text/css" href="{{ asset('frontend/css/bootstrap-clockpicker.min.css') }}">
{{-- <script src="http://ajax.googleapis.com/ajax/libs/jquery/1.7.1/jquery.min.js" type="text/javascript"></script> --}}
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js" type="text/javascript"></script>

<script type="text/javascript"
src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.9.0/js/bootstrap-datepicker.js"></script>
<script type="text/javascript" src="{{ asset('frontend/js/bootstrap-clockpicker.min.js') }}"></script>

<!--Data table-->
<link rel="stylesheet" type="text/css" href="{{ asset('frontend/css/jquery.dataTables.css') }}">

<script type="text/javascript" charset="utf8" src="{{ asset('frontend/js/jquery.dataTables.js') }}"></script>
<style>
    table.dataTable thead .sorting:after,
    table.dataTable thead .sorting_asc:after,
    table.dataTable thead .sorting_desc:after,
    table.dataTable thead .sorting:before,
    table.dataTable thead .sorting_asc:before,
    table.dataTable thead .sorting_desc:before {
        display: none;
        content: "" !important;
        background-image: none !important;
    }

    table.dataTable thead .sorting {
        background-image: none !important;
    }
    .table thead th {
        font-size: 14px !important;
    }

</style>

<body>
    <div class="app-container app-theme-white body-tabs-shadow fixed-header fixed-sidebar">
