    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="Survey">
    <meta name="author" content="RSA">
    <title>Design Survey</title>

    <!-- Favicons-->
    <link rel="shortcut icon" href="img/favicon.ico" type="image/x-icon">
    <link rel="apple-touch-icon" type="image/x-icon" href="{{ asset('asset/rocket.png') }}">
    <link rel="apple-touch-icon" type="image/x-icon" sizes="72x72" href="{{ asset('asset/rocket.png') }}">
    <link rel="apple-touch-icon" type="image/x-icon" sizes="114x114" href="{{ asset('asset/rocket.png') }}">
    <link rel="apple-touch-icon" type="image/x-icon" sizes="144x144" href="{{ asset('asset/rocket.png') }}">

    <!-- GOOGLE WEB FONT -->
    <link href="https://fonts.googleapis.com/css2?family=Roboto+Condensed:wght@300;400;700&display=swap" rel="stylesheet">

    <!-- BASE CSS -->
    <link href="{{asset('asset/css/animate.min.css')}}" rel="stylesheet">
    <link href="{{asset('asset/css/bootstrap.min.css')}}" rel="stylesheet">
    <link href="{{asset('asset/css/style.css')}}" rel="stylesheet">
    <link href="{{asset('asset/css/icon_fonts/css/all_icons_min.css')}}" rel="stylesheet">
    <link href="{{asset('asset/css/magnific-popup.min.css')}}" rel="stylesheet">
    <link href="{{asset('asset/css/skins/square/yellow.css')}}" rel="stylesheet">

    <!-- YOUR CUSTOM CSS -->
    <link href="{{ asset('asset/css/custom.css') }}" rel="stylesheet">
@stack('styles')
