<!DOCTYPE html>
<html lang="en">

<head>
    <title>{{ config('app.name') }} | @yield('title')</title>
    <!-- HTML5 Shim and Respond.js IE10 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 10]>
    <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
    <script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
    <![endif]-->
    <!-- Meta -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=0, minimal-ui">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="description" content="#">
    <meta name="keywords" content="Insurance software">
    <meta name="author" content="Gbudu Joseph">
    <link rel="/assets/images/logo.png" type="image/x-icon">
    <link href="https://fonts.googleapis.com/css?family=Open+Sans:400,600" rel="stylesheet">
    <link rel="stylesheet" type="text/css" href="\bower_components\bootstrap\css\bootstrap.min.css">
    <link rel="stylesheet" type="text/css" href="\assets\icon\themify-icons\themify-icons.css">
    <link rel="stylesheet" type="text/css" href="\assets\icon\icofont\css\icofont.css">
    <link rel="stylesheet" type="text/css" href="\assets\icon\feather\css\feather.css">
    <link rel="stylesheet" type="text/css" href="\assets\css\style.css">
    <link rel="stylesheet" type="text/css" href="\assets\css\jquery.mCustomScrollbar.css">
    <link rel="stylesheet" href="\assets\scss\partials\menu\_pcmenu.htm">
    @yield('extra-styles')
</head>
