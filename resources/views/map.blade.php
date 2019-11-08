<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="author" content="">

    <title>Map</title>

    <link href="{{mix('/css/app.css')}}" rel="stylesheet">
    <script src="{{mix('js/app.js')}}"></script>

</head>


<body>
    <div id="app">
        <router-view name="mapComponent"></router-view>
        <router-view></router-view>
    </div>
</body>

</html>