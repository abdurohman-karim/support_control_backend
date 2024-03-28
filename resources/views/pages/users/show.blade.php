@extends('layouts.master')
@section('css')
    <link href="{{ URL::asset('/assets/libs/select2/select2.min.css') }}" rel="stylesheet" type="text/css" />
@endsection
@section('content')
    <div class="row">
        <div class="col-md-8 col-lg-8 offset-lg-2 offset-md-2 col-sm-12">
            <div class="card">
                <div class="card-body">
                    <h4 class="card-title mb-4">Yangi foydalanuvchi</h4>

                    <form action="{{ route('users.store') }}" method="post" enctype="multipart/form-data">
                        @csrf
                        <div class="row">
                            <div class="col-lg-6 col-md-6 col-sm-12">
                                <div class="mb-3">
                                    <label for="useremail" class="form-label">Email</label>
                                    <input type="email" class="form-control @error('email') is-invalid @enderror"
                                           id="useremail"
                                           value="{{ old('email') }}" name="email" placeholder="Email" autofocus
                                           required>
                                    @error('email')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror
                                </div>
                                <div class="mb-3">
                                    <label for="username" class="form-label">Name</label>
                                    <input type="text" class="form-control @error('name') is-invalid @enderror"
                                           value="{{ old('name') }}" id="username" name="name" autofocus required
                                           placeholder="FIO">
                                    @error('name')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror
                                </div>
                                <div class="mb-4">
                                    <label for="userpassword" class="form-label">Parol</label>
                                    <input type="password" class="form-control @error('password') is-invalid @enderror"
                                           id="userpassword" name="password"
                                           placeholder="Parol" autofocus required>
                                    @error('password')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-lg-6 col-md-6 col-sm-12">
                                <div class="mb-3">
                                    <label for="v" class="form-label">Telefon</label>
                                    <input type="text" class="form-control @error('phone') is-invalid @enderror"
                                           value="{{ old('phone') }}" id="phone" name="phone" autofocus required
                                           placeholder="+998.....">
                                    @error('phone')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                     </span>
                                    @enderror
                                </div>
                                <div class="mb-3">
                                    <label for="userdob">Tug'ilgan sana</label>
                                    <div class="input-group" id="datepicker1">
                                        <input type="date" class="form-control @error('dob') is-invalid @enderror"
                                               placeholder="dd-mm-yyyy"
                                               value="{{ old('dob') }}"
                                               name="dob" autofocus required>
                                        @error('dob')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                        @enderror
                                    </div>
                                </div>

                                <div class="mb-3">
                                    <label class="form-label">Rol tanlash</label>
                                    <select class="select2 form-control select2-multiple" multiple="multiple" name="roles[]"
                                            data-placeholder="Tanlang ...">
                                        @foreach($roles as $role)
                                            <option value="{{ $role->name }}">{{ $role->name }}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="mb-3 col-lg-8 col-sm-12">
                                <label for="avatar">Profil rasmi</label>
                                <div class="input-group">
                                    <input type="file" class="form-control @error('avatar') is-invalid @enderror"
                                           id="inputGroupFile02" name="avatar" autofocus>
                                    <label class="input-group-text" for="inputGroupFile02">Yuklash</label>
                                </div>
                                @error('avatar')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror
                            </div>
                            <div class="mb-3 col-lg-4 col-sm-12 text-center">
                                <label class="form-label">O'qituvchilik maqomi</label>
                                <div class="col-auto">
                                    <input type="checkbox" name="is_teacher" value="1" @if(old('is_teacher')) checked @endif id="switch6" switch="primary">
                                    <label for="switch6" data-on-label="Bor" data-off-label="Yo'q"></label>
                                </div>
                            </div>
                        </div>
                        <div class="row mt-4">
                            <div class="text-lg-end text-sm-center">
                                <div>
                                    <button type="submit" class="btn btn-success w-md waves-effect waves-light"><i
                                            class="fas fa-save"></i> Qo'shish
                                    </button>
                                    <a href="{{ route('users.index') }}" class="btn btn-secondary w-md">Ortga</a>
                                </div>
                            </div>
                        </div>
                    </form>
                </div>
                <!-- end card body -->
            </div>
            <!-- end card -->
        </div>
    </div>
@endsection
@section('script')
    <script src="{{ URL::asset('/assets/libs/select2/select2.min.js') }}"></script>
    <script src="{{ URL::asset('/assets/js/pages/form-advanced.init.js') }}"></script>
@endsection
