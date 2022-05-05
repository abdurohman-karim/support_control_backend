<?php header('Access-Control-Allow-Origin: *'); ?>
    <!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>@lang('panel.site_title')</title>
    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <!-- Icons Css -->
    <link href="{{ asset('/assets/css/icons.min.css') }}" rel="stylesheet" type="text/css">
    <link href="{{ asset('assets/libs/select2/select2.min.css') }}" rel="stylesheet" type="text/css">
    <!-- App favicon -->
    <link rel="shortcut icon" href="{{ asset('assets/images/favicon.ico') }}">
    <!-- SweetAlert2 -->
    <link rel="stylesheet" href="{{ asset('plugins/sweetalert2-theme-bootstrap-4/bootstrap-4.min.css') }}">
    <!-- App Css-->
    <link href="{{ asset('/assets/css/app.min.css') }}" id="app-style" rel="stylesheet" type="text/css">
    <!-- Bootstrap Css -->
    <link href="{{ asset('/assets/css/bootstrap.min.css') }}" id="bootstrap-style" rel="stylesheet" type="text/css">
    <!-- Select2 -->
    <link rel="stylesheet" href="{{ asset('plugins/select2-bootstrap4-theme/select2-bootstrap4.min.css') }}">
    <link rel="stylesheet" href="{{ asset('plugins/select2/css/select2.min.css') }}">
    <!-- Bootstrap4 Duallistbox -->
    <link rel="stylesheet" href="{{ asset('plugins/bootstrap4-duallistbox/bootstrap-duallistbox.min.css') }}">
    <link rel="icon" href="/consImages/logoU.png ">
</head>
<body data-sidebar="dark">
<div id="layout-wrapper">
    <header id="page-topbar">
        <div class="navbar-header">
            <div class="d-flex">
                <!-- LOGO -->
                <div class="navbar-brand-box">
                    <a href="/" class="logo logo-dark">
                    <span class="logo-sm">
                        <img src="http://crm.loc/assets/images/logo.svg" alt="" height="22">
                    </span>
                        <span class="logo-lg">
                        <img src="http://crm.loc/assets/images/logo-dark.png" alt="" height="17">
                    </span>
                    </a>
                    <a href="/" class="logo logo-light">
                    <span class="logo-sm">
                        <img src="http://crm.loc/assets/images/logo-light.svg" alt="" height="22">
                    </span>
                        <span class="logo-lg">
                        <img src="http://crm.loc/assets/images/logo-light.png" alt="" height="19">
                    </span>
                    </a>
                </div>
                <button type="button" class="btn btn-sm px-3 font-size-16 header-item waves-effect" id="vertical-menu-btn">
                    <i class="fa fa-fw fa-bars"></i>
                </button>
            </div>

            <div class="d-flex">

                <div class="dropdown d-inline-block d-lg-none ms-2">
                    <button type="button" class="btn header-item noti-icon waves-effect" id="page-header-search-dropdown" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                        <i class="mdi mdi-magnify"></i>
                    </button>
                    <div class="dropdown-menu dropdown-menu-lg dropdown-menu-end p-0" aria-labelledby="page-header-search-dropdown">
                        <form class="p-3">
                            <div class="form-group m-0">
                                <div class="input-group">
                                    <input type="text" class="form-control" placeholder="Search..." aria-label="Search input">
                                    <button class="btn btn-primary" type="submit"><i class="mdi mdi-magnify"></i></button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
                <div class="dropdown d-inline-block">
                    <button type="button" class="btn header-item waves-effect" id="page-header-user-dropdown" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                        <span class="d-none d-xl-inline-block ms-1" key="t-henry">{{ auth()->user()->name  }}</span>
                        <i class="mdi mdi-chevron-down d-none d-xl-inline-block"></i>
                    </button>
                    <div class="dropdown-menu dropdown-menu-end">
                        <!-- item-->
                        @if(auth()->user())
                            <a href="/user/{{auth()->user()->id}}" class="dropdown-item" style="cursor: pointer">
                                <i class="fas fa-cogs"></i> @lang('global.settings')
                            </a>
                        @endif
                        <a class="dropdown-item" href="{{ route('logout') }}"
                           onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                            <i class="bx bx-lock-open font-size-16 align-middle me-1"></i>
                            <span key="t-lock-screen">Chiqish</span>
                        </a>
                        <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                            @csrf
                        </form>
                    </div>
                </div>

            </div>
        </div>
    </header>
    <div>
        @include('layouts.sidebar')
        <div class="main-content">
            <div class="page-content">
               @yield('content')
            </div>
            <footer class="footer">
                <div class="container-fluid">
                    <div class="row">
                        <div class="col-sm-6">
                        </div>
                        <div class="col-sm-6">
                            <div class="text-sm-end d-none d-sm-block">
                                Design &amp; Develop by Themesbrand
                            </div>
                        </div>
                    </div>
                </div>
            </footer>
        </div>
    </div>
</div>
<!--JAVASCRIPT-->
<script src="{{ asset('assets/libs/jquery/jquery.min.js')}}"></script>
<script src="{{ asset('assets/libs/bootstrap/bootstrap.min.js')}}"></script>
<script src="{{ asset('assets/libs/metismenu/metismenu.min.js')}}"></script>
<script src="{{ asset('assets/libs/simplebar/simplebar.min.js')}}"></script>
<script src="{{ asset('assets/libs/node-waves/node-waves.min.js')}}"></script>
<!--MyJs-->
<script src="{{asset('plugins/bootstrap_my/myScripts.js')}}" type="text/javascript"></script>
<!--SweetAlert2-->
<script src="{{asset('plugins/sweetalert2-theme-bootstrap-4/sweet-alerts.min.js') }}"></script>
<!--App js-->
<script src="{{ asset('assets/js/app.min.js') }}"></script>

@if(session('_message'))
    <script>
        Swal.fire({
            position: 'top-end',
            icon: "{{ session('_type') }}",
            title: "{{ session('_message') }}",
            showConfirmButton: false,
            timer: {{session('_timer') ?? 5000}}
        });
    </script>
    @php(message_clear())
@endif
@yield('scripts')
</body>
</html>
