<!DOCTYPE html>
<html lang="{{ config('app.locale') }}">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="x-ua-compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- CSRF Token-->
    <meta name="csrf-token" content="{{csrf_token()}}">
    <title>@yield('title', 'boxue') - {{env('APP_NAME')}} </title>
    <link rel="stylesheet" href="{{mix('css/app.css')}}">
    <script>
        window.Laravel = {!! json_encode([
            'csrfToken' => csrf_token(),
        ]) !!};
    </script>
</head>
<body>
@include('layouts._header')
<div id="app">
    <div class="container main-container">
        @include('shared.messages')
        @yield('content')
    </div>
</div>
<script src="{{mix('js/app.js')}}"></script>

<!-- JS Customization -->
@yield('script')
</body>
</html>