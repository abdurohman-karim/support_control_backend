<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8" />
    <title>{{env('TITLE','TITLE')}} - Skote</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <!-- App favicon -->
    <link rel="shortcut icon" href="{{ URL::asset('assets/images/favicon.ico') }}">
    @include('layouts.head-css')
</head>

@section('body')
    <body data-sidebar="dark" id="site-body">
@show

    <!-- Begin page -->
    <div id="layout-wrapper">
        @include('layouts.topbar')
        @include('layouts.sidebar')

        <div class="main-content">
            <div class="page-content">
                <div class="container-fluid">
                    @yield('content')
                </div>
            </div>
            <!-- End Page-content -->

            @include('layouts.footer')
        </div>
    </div>
    <!-- JAVASCRIPT -->
    @include('layouts.vendor-scripts')
</body>
</html>
