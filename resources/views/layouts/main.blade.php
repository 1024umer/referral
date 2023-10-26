<!doctype html>
<html lang="en">

<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="">
    <link rel="icon" href="{{ url('front/images/favicon.png') }}">
    <title>{{ isset($title) ? $title : '' }} | AOH</title>
    <meta name="csrf-token" content="{{ csrf_token() }}">
    @include('layouts.css')
    @stack('css')
<style>
    body{
        background: #45474B;
    }
</style>
</head>

<body>
    <input type="hidden" id="web_base_url" value="{{ url('/') }}" />
    @include('layouts.header')
    @yield('content')
    @include('layouts.scripts')
    @stack('js')
    @include('layouts.footer')
</body>

</html>
