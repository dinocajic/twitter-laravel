<!DOCTYPE html>
<html>
<title>{{ $title }}</title>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1">
<link rel="stylesheet" href="{!! url('/css/stylesheet.css') !!}">
<style>
    h1,h2,h3,h4,h5,h6 {
        font-family: "Playfair Display";
        letter-spacing: 5px;
    }
</style>

@yield('additional_headers');
<body>

@include('partials.nav')
@yield('content')
@include('partials.footer')

@yield('additional_scripts')

</body>
</html>