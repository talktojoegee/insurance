<!DOCTYPE html>
<html lang="en" class="light">
    <!-- BEGIN: Head -->
    <head>
        <meta charset="utf-8">
        <link href="dist/images/logo.svg" rel="shortcut icon">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="description" content="Bespoke solution for organizations - be it small, medium or large scale organizations.">
        <meta name="keywords" content="Insurance, payroll, human resource, leave management, notice,">
        <meta name="author" content="{{config('app.name')}}">
        <title>{{config('app.name')}} - @yield('title')</title>
        <link rel="stylesheet" href="/dist/css/app.css" />
    </head>
    <body class="login">
        @yield('auth-content')
        <script src="/dist/js/app.js"></script>
    </body>
</html>