<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>HomePage</title>
    <link rel="stylesheet" href={{ asset('css/home/homestyle.css')}}>
    <link rel="stylesheet" href={{ asset('css/home/footerstyle.css')}}>
    <link rel="stylesheet" href={{ asset('css/home/mainstyle.css')}}>
</head>
<body>
    @include('home.header')

    <div class="main"></div>

    @include('home.footer')
</body>
</html>
