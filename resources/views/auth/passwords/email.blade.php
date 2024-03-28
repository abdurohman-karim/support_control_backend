@extends('layouts.master-without-nav')

@section('title')
    @lang('translation.Recover_Password')
@endsection

@section('body')

    <body>
    @endsection

    @section('content')
        <div class="account-pages my-5 pt-sm-5">
            <div class="container">
                <div class="row justify-content-center">
                    <div class="col-md-8 col-lg-6 col-xl-5">
                        <div class="card overflow-hidden">
                            <div class="bg-primary bg-soft">
                                <div class="row">
                                    <div class="col-7">
                                        <div class="text-primary p-4">
                                            <h5 class="text-primary"> Administrator bilan bog'laning</h5>
                                            <p>+998 97 366 777 33</p>
                                        </div>
                                    </div>
                                    <div class="col-5 align-self-end">
                                        <img src="{{ URL::asset('/assets/images/profile-img.png') }}" alt=""
                                            class="img-fluid">
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="mt-5 text-center">
                            <p>© <script>
                                    document.write(new Date().getFullYear())

                                </script> OctaneLMS. Crafted with <i class="mdi mdi-heart text-danger"></i> by Gafurov Shakhzodbek</p>
                        </div>

                    </div>
                </div>
            </div>
        </div>

    @endsection
