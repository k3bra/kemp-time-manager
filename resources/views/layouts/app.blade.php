<!DOCTYPE html>
<html lang="{{ app()->getLocale() }}">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }}</title>

    @yield('css')
    <link href="//maxcdn.bootstrapcdn.com/font-awesome/4.2.0/css/font-awesome.min.css" rel="stylesheet">
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
    <link href="{{ asset('css/animate.min.css') }}" rel="stylesheet"/>
    <link href="{{ asset('css/style.min.css') }}" rel="stylesheet"/>
    <link href="{{ asset('css/style-responsive.min.css')}}" rel="stylesheet"/>
    <link href="{{ asset('css/blue.css') }}" rel="stylesheet" id="theme"/>
</head>
<body>
<div id="app">


    <div id="page-container" class=" page-sidebar-fixed page-header-fixed">
        @include('layouts.topBar')

        @if(!Auth::guest())
            @include('layouts.sideBar')
        @endif
        <div id="content" class="content">
            <!-- begin breadcrumb -->
            @yield('content')
        </div>
        <!-- end row -->
    </div>
</div>

<!-- Scripts -->
<script src="{{ asset('js/app.js') }}"></script>
@yield('javascript')

</body>
</html>
