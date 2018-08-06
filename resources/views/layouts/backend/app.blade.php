<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">


    <title>@yield('title') - {{ config('app.name', 'Laravel') }}</title>

    <!-- Favicon-->
    <link rel="icon" href="favicon.ico" type="image/x-icon">

    <!-- Google Fonts -->
    <link href="https://fonts.googleapis.com/css?family=Roboto:400,700&subset=latin,cyrillic-ext" rel="stylesheet" type="text/css">
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet" type="text/css">

    <!-- Bootstrap Core Css -->
    <link href="{{ asset('assets/backend/plugins/bootstrap/css/bootstrap.css') }}" rel="stylesheet">

    <!-- Waves Effect Css -->
    <link href="{{ asset('assets/backend/plugins/node-waves/waves.css') }}" rel="stylesheet" />

    <!-- Animation Css -->
    <link href="{{ asset('assets/backend/plugins/animate-css/animate.css') }}" rel="stylesheet" />

    <!-- Custom Css -->
    <link href="{{ asset('assets/backend/css/style.css') }}" rel="stylesheet">

    <!-- AdminBSB Themes. You can choose a theme from css/themes instead of get all themes -->
    <link href="{{ asset('assets/backend/css/themes/all-themes.css') }}" rel="stylesheet" />

    {{-- TOAST--}}
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.css">

    @stack('css')

</head>
<body class="theme-cyan">
    <!-- Page Loader -->
    @include('layouts.backend.partials.loader')
    <!-- #END# Page Loader -->

    <!-- Overlay For Sidebars -->
    <div class="overlay"></div>
    <!-- #END# Overlay For Sidebars -->

    <!-- Search Bar -->
    @include('layouts.backend.partials.searchBar')
    <!-- #END# Search Bar -->

    <!-- Top Bar -->
    @include('layouts.backend.partials.topBar')
    <!-- #Top Bar -->

    <section>
        <!-- Left Sidebar -->
        @include('layouts.backend.partials.sidebar')
        <!-- #END# Left Sidebar -->
    </section>

    <section class="content">
        @yield('content')
    </section>

    <!-- Jquery Core Js -->
    <script src="{{ asset('assets/backend/plugins/jquery/jquery.min.js') }}"></script>

    <!-- Bootstrap Core Js -->
    <script src="{{ asset('assets/backend/plugins/bootstrap/js/bootstrap.js') }}"></script>

    <!-- Select Plugin Js -->
    <script src="{{ asset('assets/backend/plugins/bootstrap-select/js/bootstrap-select.js') }}"></script>

    <!-- Slimscroll Plugin Js -->
    <script src="{{ asset('assets/backend/plugins/jquery-slimscroll/jquery.slimscroll.js') }}"></script>

    <!-- Waves Effect Plugin Js -->
    <script src="{{ asset('assets/backend/plugins/node-waves/waves.js') }}"></script>

    <!-- Custom Js -->
    <script src="{{ asset('assets/backend/js/admin.js') }}"></script>

    <!-- Demo Js -->
    <script src="{{ asset('assets/backend/js/demo.js') }}"></script>


    {{-- JS TOAST --}}
    <script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.js"></script>
    {!! Toastr::message() !!}

    <script>
        @if ($errors->any())
            @foreach ($errors->all() as $error)
                toastr.error('{{$error}}', 'Error', {
                    closeButton: true,
                    progressBar: true
                })
            @endforeach
        @endif
    </script>

    @stack('js')
</body>
</html>
