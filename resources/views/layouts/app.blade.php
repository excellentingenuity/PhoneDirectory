<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name') }}</title>

    <!-- Styles -->
    <link href="/css/app.css" rel="stylesheet">

    <!-- Scripts -->
    <script>
        window.Laravel = <?php echo json_encode([
                                                    'csrfToken' => csrf_token(),
                                                ]); ?>;
        window.Directory = <?php echo json_encode([
                                                  'url' => env('API_URL'),
                                              ]); ?>;
    </script>
</head>
<body>
<div id="app">

    @yield('content')
</div>
<div class="container">
    <footer class="row">
        <div class="col-md-12 copyright">&copy; {{ date("Y") }} <a href="http://www.excellentingenuity.com" class="copyright-link">Excellent InGenuity LLC</a> </div>
    </footer>
</div>
<!-- Scripts -->
<script src="/js/app.js"></script>
</body>
</html>