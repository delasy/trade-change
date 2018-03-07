<!DOCTYPE html>
<html class="mdc-typography">
<head>
    <meta charset="utf-8" />
    <meta http-equiv="x-ua-compatible" content="ie=edge" />
    <meta name="robots" content="index,follow">
    <title>Trade-Change - @yield('page-title')</title>
    <link href="https://fonts.googleapis.com/css?family=Roboto:100,100i,300,300i,400,400i,500,500i,700,700i,900,900i&subset=cyrillic" rel="stylesheet">
    <link rel="stylesheet" href="{{ url('css/mdc.min.css') }}">
    <link rel="stylesheet" href="{{ url('css/app.css') }}">
</head>
<body>
<div id="content"></div>

<script src="{{ url('js/mdc.min.js') }}"></script>
<script>mdc.autoInit();</script>
<script src="{{ url('js/app-not-old.js') }}"></script>
</body>
</html>
