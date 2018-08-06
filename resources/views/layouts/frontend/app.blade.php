<!DOCTYPE html>
<html lang="es">
<head>
<title>Blog | Jehova Reina</title>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">

<link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Raleway">
<style>
    body,h1,h2,h3,h4,h5 {font-family: "Raleway", sans-serif}
</style>
    <!-- Bootstrap Core Css -->
    <link href="{{ asset('assets/backend/plugins/bootstrap/css/bootstrap.css') }}" rel="stylesheet">

    {{-- TOAST--}}
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.css">


    <link rel="stylesheet" href="{{ asset('assets/frontend/css/w3.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/frontend/css/main.css') }}">

</head>
<body  class="">

@include('layouts.frontend.partials.header')

@yield('content')

@include('layouts.frontend.partials.footer')

<!-- SCIPTS -->

<!-- Jquery Core Js -->
<script src="{{ asset('assets/backend/plugins/jquery/jquery.min.js') }}"></script>

<!-- Bootstrap Core Js -->
<script src="{{ asset('assets/backend/plugins/bootstrap/js/bootstrap.js') }}"></script>



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
