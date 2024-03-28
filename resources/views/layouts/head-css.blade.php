@yield('css')

<!-- Bootstrap Css -->
@if(!auth()->guest() && auth()->user()->theme == 'dark')
    <link href="{{ URL::asset('/assets/css/bootstrap-dark.min.css') }}" id="bootstrap-style" rel="stylesheet" type="text/css" />
    <link href="{{ URL::asset('/assets/css/app-dark.min.css') }}" id="app-style" rel="stylesheet" type="text/css" />
@else
    <link href="{{ URL::asset('/assets/css/bootstrap.min.css') }}" id="bootstrap-style" rel="stylesheet" type="text/css" />
    <link href="{{ URL::asset('/assets/css/app.min.css') }}" id="app-style" rel="stylesheet" type="text/css" />
@endif
<!-- Icons Css -->
<link href="{{ URL::asset('/assets/css/icons.min.css') }}" rel="stylesheet" type="text/css" />
<link href="{{ URL::asset('/assets/libs/bootstrap-datepicker/bootstrap-datepicker.min.css') }}" rel="stylesheet" type="text/css" />
<!-- App Css-->
<link href="{{ URL::asset('/assets/libs/toastr/toastr.min.css') }}" id="app-style" rel="stylesheet" type="text/css" />
<link href="{{ URL::asset('/assets/my.css') }}" rel="stylesheet" type="text/css" />
<link href="{{ URL::asset('/assets/libs/datatables/datatables.min.css') }}" rel="stylesheet" type="text/css" />
