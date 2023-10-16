<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="UTF-8">
        <meta http-equiv="X-UA-Compatible" content="ie=edge">
        <meta name="robots" content="all">
        <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=5.0, minimum-scale=1.0">
        <meta name="csrf-token" content="{{ csrf_token() }}">

        <title>@yield('title', '-') | {{ config('app.name') }}</title>

        <meta name="keywords" content="{{ config('app.name') }}">
        <meta name="description" content="@yield('description', '-') | {{ config('app.name') }}">

        <meta name="twitter:card" content="summary">
        <meta name="twitter:title" content="@yield('title', '-') | {{ config('app.name') }}">
        <meta name="twitter:description" content="@yield('description', '-') | {{ config('app.name') }}">

        <meta property="og:url" content="{{ request()->url() }}">
        <meta property="og:type" content="website">
        <meta property="og:locale" content="{{ str_replace('_', '-', app()->getLocale()) }}">
        <meta property="og:site_name" content="{{ config('app.name') }}">
        <meta property="og:title" content="@yield('title', '-') | {{ config('app.name') }}">
        <meta property="og:description" content="@yield('description', '-') | {{ config('app.name') }}">

        <link rel="preconnect" href="https://fonts.bunny.net">
        <link rel="stylesheet" href="https://fonts.bunny.net/css?family=mulish:200,300,400,500,600,700,800,900&display=swap">

        @vite(['resources/css/app.css', 'resources/js/app.js'])
    </head>
    <body>
        @yield('content')
    </body>
</html>
