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
    
    <!-- GOOGLE FONT -->
    <link href="https://fonts.googleapis.com/css?family=Fira+Sans:400,500,600" rel="stylesheet">
    <!-- End GOOGLE FONT -->

    <!-- BEGIN PLUGINS STYLES -->
    <link rel="stylesheet" href="{{ asset('fonts/open-iconic-master/font/css/open-iconic-bootstrap.css') }}">
    <link rel="stylesheet" href="{{ asset('node_modules/@fortawesome/fontawesome-free/css/all.css') }}">
    <link rel="stylesheet" href="{{ asset('node_modules/flatpickr/dist/flatpickr.min.css') }}">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/paymentfont/1.2.5/css/paymentfont.min.css">
    <!-- END PLUGINS STYLES -->

    <!-- TinyMCE -->
    <script src="https://cdn.tiny.cloud/1/uq9wx6noqeve8lt3ticft2isl2adayti6g7fxkfozjsdpm3z/tinymce/5/tinymce.min.js" referrerpolicy="origin"></script>

    <!-- BEGIN THEME STYLES -->
    <style type="text/css">
      :root {
        --principal-dark-color: {{(session('themePrincipalColor')) ? session('themePrincipalColor') : '#C0C0C0' }};
      }
    </style>
    <link rel="stylesheet" href="{{ asset('css/theme.css') }}" data-skin="default">
    <!--link rel="stylesheet" href="{{ asset('css/theme-dark.min.css') }}" data-skin="dark"-->
    <!-- END THEME STYLES -->

    <link rel="stylesheet" href="https://unpkg.com/leaflet@1.5.1/dist/leaflet.css" integrity="sha512-xwE/Az9zrjBIphAcBb3F6JVqxf46+CDLwfLMHloNu6KEQCAWi6HcDUbeOfBIptF7tcCzusKFjFw2yuvEpDL9wQ==" crossorigin=""/>

    <link rel="stylesheet" href="{{ asset('css/custom.css') }}" >
    
    @stack('styles')

  </head>
  <body class="{{ $bodyCss }}">

    @yield('content')
    
    <!-- BASE JS -->
    <script src="{{ asset('node_modules/jquery/dist/jquery.js') }}"></script> 
    <script src="{{ asset('node_modules/popper.js/dist/umd/popper.min.js') }}"></script>
    <script src="{{ asset('node_modules/bootstrap/dist/js/bootstrap.js') }}"></script>
    <!-- END BASE JS -->
    
    <!-- BEGIN PLUGINS JS -->
    <script src="{{ asset('js/pace.min.js') }}"></script>
    <script src="{{ asset('node_modules/stacked-menu/dist/js/stacked-menu.js') }}"></script>
    <script src="{{ asset('node_modules/perfect-scrollbar/dist/perfect-scrollbar.js') }}"></script>
    <script src="{{ asset('node_modules/flatpickr/dist/flatpickr.min.js') }}"></script>
    <script src="{{ asset('js/jquery.easypiechart.min.js') }}"></script>
    <script src="{{ asset('node_modules/chart.js/dist/Chart.min.js') }}"></script>
    <!-- END PLUGINS JS -->
    
    <!-- BEGIN THEME JS -->
    <script src="{{ asset('js/theme.min.js') }}"></script>
    <!-- END THEME JS -->
    
    <script src="https://unpkg.com/leaflet@1.5.1/dist/leaflet.js" integrity="sha512-GffPMF3RvMeYyc1LWMHtK8EbPv0iNZ8/oTtHPx9/cc2ILxQ+u905qIwdpULaqDkyBKgOaB57QTMg7ztg8Jm2Og==" crossorigin=""></script>

    <script src="{{ asset('services/leaflet.js') }}"></script>
    <script src="{{ asset('services/photon.js') }}"></script>

    <script src="{{ asset('node_modules/jquery-validation/dist/jquery.validate.min.js') }}"></script>
    <script src="{{ asset('node_modules/cleave.js/dist/cleave.min.js') }}"></script>
    
    <script src="{{ asset('js/custom.js') }}"></script>
    <script src="{{ asset('js/lists.js') }}"></script>

    @stack('scripts')
    
    
    
  </body>
</html>