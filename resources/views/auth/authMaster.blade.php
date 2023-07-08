<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">

  <link href="{{ asset('/asset/main/css/style.css') }}" rel="stylesheet">
    <link href="{{ asset('/asset/bootstrap/css/bootstrap.min.css') }}" rel="stylesheet">
    <link href="{{ asset('/asset/bootstrap/js/bootstrap.min.js') }}" rel="stylesheet">
    <link href="{{ asset('/asset/bootstrap/js/bootstrap.bundle.min.js') }}" rel="stylesheet">
    <link href="{{ asset('/asset/main/css/style.css') }}" rel="stylesheet">
    <link href="{{ asset('/asset/main/css/responsive.css') }}" rel="stylesheet">


    <meta name="csrf-token" content="{{csrf_token()}}">

        <script src="{{ asset('/asset/jquery.js') }}"></script>


    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title> @yield('title')  </title>

    @include('auth.scripts')

    
    @yield('headers')
</head>
<body dir="rtl">
    @yield('content')
</body>
</html>