<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>DeliveBoo</title>

        <!-- Fonts -->
        <link href="https://fonts.googleapis.com/css?family=Nunito:200,600" rel="stylesheet">


    </head>
    <body>
        <a href="{{route('admin.home')}}">Admin</a>
        <div id="root"></div>


        <!-- Script Js -->
        <script src="{{ asset('js/app.js') }}"></script>
    </body>
</html>
