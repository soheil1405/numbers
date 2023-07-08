<!DOCTYPE html>
<html dir="rtl" lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>

    @yield('headers')



    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link href="{{ asset('/asset/main/css/style.css') }}" rel="stylesheet">
    <link href="{{ asset('/asset/bootstrap/css/bootstrap.min.css') }}" rel="stylesheet">
    <link href="{{ asset('/asset/bootstrap/js/bootstrap.min.js') }}" rel="stylesheet">
    <link href="{{ asset('/asset/bootstrap/js/bootstrap.bundle.min.js') }}" rel="stylesheet">
    <link href="{{ asset('/asset/main/css/style.css') }}" rel="stylesheet">
    <link href="{{ asset('/asset/main/css/responsive.css') }}" rel="stylesheet">



    <script src="{{ asset('/asset/jquery.js') }}"></script>
</head>

<body class="antialiased">

    @yield('content')








</body>

</html>
