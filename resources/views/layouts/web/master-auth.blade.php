<!DOCTYPE html>
<html lang="{{ $locale }}">
  <head>
    
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <title>{{ $title }}</title>
    <meta property="og:title" content="{{ $ogTitle }}">
    <meta property="og:locale" content="{{ $ogLocale }}">
    <meta property="og:description" content="{{ $ogDescription }}">
    <meta property="og:url" content="{{ $ogUrl }}">
    <meta property="og:site_name" content="{{ $ogSiteName }}">

    <meta name="author" content="{{ $autor }}">
    <meta name="description" content="{{ $description }}">
    <link rel="canonical" href="{{ $canonicalUrl }}">
    
    <link rel="shortcut icon" href="{{ asset('images/favicon.ico') }}" type="image/x-icon">
    <link rel="icon" href="{{ asset('images/favicon.ico') }}" type="image/x-icon">

    <meta name="theme-color" content="#3063A0">
    
    <link href="https://fonts.googleapis.com/css?family=Fira+Sans:400,500,600" rel="stylesheet">
    
    <link rel="stylesheet" href="{{ asset('fonts/open-iconic-master/font/css/open-iconic-bootstrap.css') }}">
    <link rel="stylesheet" href="{{ asset('node_modules/@fortawesome/fontawesome-free/css/all.css') }}">
    <link rel="stylesheet" href="{{ asset('node_modules/flatpickr/dist/flatpickr.min.css') }}">
    
    <link rel="stylesheet" href="{{ asset('css/theme.css') }}" data-skin="default">

  </head>
  <body class="{{ $bodyCss }}">

    @yield('content')
  
  </body>
    
    <script src="{{ asset('node_modules/jquery/dist/jquery.js') }}"></script> 
    <script src="{{ asset('node_modules/popper.js/dist/umd/popper.min.js') }}"></script>
    <script src="{{ asset('node_modules/bootstrap/dist/js/bootstrap.js') }}"></script>
      
    <script src="{{ asset('js/theme.min.js') }}"></script>
    
    @yield('scripts')
  
</html>