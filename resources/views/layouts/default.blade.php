<!DOCTYPE html>
<html lang="{{ config('app.locale') }}">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="x-ua-compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- CSRF Token-->
    <meta name="_token" content="{{csrf_token()}}">
    <title>@yield('title', 'boxue') - {{env('APP_NAME')}} </title>
    <link rel="stylesheet" href="{{mix('css/app.css')}}">
    <link rel="stylesheet" href="{{asset('css/simplemde.min.css')}}">
    <script src="{{asset('js/inline-attachment.js')}}"></script>
    <script src="{{asset('js/codemirror-4.inline-attachment.js')}}"></script>
    @yield('style')
    <script>
        window.Laravel = {!! json_encode([
            'csrfToken' => csrf_token(),
        ]) !!};
    </script>
    @yield('head')
</head>
<body>
<div id="root"></div>
<script src="{{mix('js/app.js')}}"></script>
<!-- JS Customization -->
@yield('script')
</body>
</html>