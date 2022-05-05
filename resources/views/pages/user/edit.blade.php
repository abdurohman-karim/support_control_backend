@extends('layouts.admin')
@section('content')
    <div class="container-fluid">
        <div class="row">
            <div class="col-12">
                <div class="d-sm-flex align-items-center justify-content-between">
                    <h4 class="mb-sm-0 font-size-18">Udate /  <span class="badge badge-soft-success">{{ $user->name }}</span></h4>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-lg-8 offset-lg-2 col-sm-12">
                <div class="card">
                    <div class="card-body">
                        <h3 class="card-title mb-3">Edit</h3>
                        <form action="{{ route('userUpdate',$user->id) }}" method="post">
                            @csrf
                            <div class="mb-3">
                                <label class="form-label">Name</label>
                                <input type="text" name="name" class="form-control {{ $errors->has('name') ? "is-invalid":"" }}" value="{{ old('name',$user->name) }}" required>
                                @if($errors->has('name'))
                                    <span class="error invalid-feedback">{{ $errors->first('name') }}</span>
                                @endif
                            </div>
                            <div class="mb-3">
                                <label class="form-label">Email</label>
                                <input type="email" name="email" class="form-control {{ $errors->has('email') ? "is-invalid":"" }}" value="{{ old('email',$user->email) }}" required>
                                @if($errors->has('email'))
                                    <span class="error invalid-feedback">{{ $errors->first('email') }}</span>
                                @endif
                            </div>
                            @canany(['roles.edit','user.edit'])
                            <div class="mb-3">
                                <label class="form-label">Roles</label>
                                <select class="select2 form-control select2-multiple select2-hidden-accessible" multiple="multiple" name="roles[]" data-placeholder="Select" style="width: 100%;">
                                    @foreach($roles as $role)
                                        <option value="{{ $role->name }}" {{ ($user->hasRole($role->name) ? "selected":'') }}>{{ $role->name }}</option>
                                    @endforeach
                                </select>
                            </div>
                            @endcan
                            <div class="mb-3">
                                <label class="form-label">Password</label>
                                <input type="password" name="password" id="password-field" class="form-control {{ $errors->has('password') ? "is-invalid":"" }}">
                                <span toggle="#password-field" class="mx-2 fa fa-fw fa-eye toggle-password field-icon"></span>
                                @if($errors->has('password'))
                                    <span class="error invalid-feedback">{{ $errors->first('password') }}</span>
                                @endif
                            </div>
                            <div class="mb-3">
                                <label class="form-label">Confirm password</label>
                                <input id="password-confirm" type="password" class="form-control" name="password_confirmation" autocomplete="new-password">
                                <span toggle="#password-confirm" class="mx-2 fa fa-fw fa-eye toggle-password field-icon"></span>
                                @if($errors->has('password_confirmation'))
                                    <span class="error invalid-feedback">{{ $errors->first('password_confirmation') }}</span>
                                @endif
                            </div>
                            <div class="mb-3">
                                <button type="submit" class="btn btn-success float-right">Save</button>
                                <a href="{{ route('userIndex') }}" class="btn btn-default float-left">Cancel</a>
                            </div>
                        </form>

                    </div>
                </div>
            </div>
        </div>
    </div>

@endsection
@section('scripts')
    <!-- Select2 -->
    <script src="{{ asset('plugins/select2/js/select2.full.min.js') }}"></script>
    <!-- Bootstrap4 Duallistbox -->
    <script src="{{ asset('plugins/bootstrap4-duallistbox/jquery.bootstrap-duallistbox.min.js') }}"></script><script src="{{ asset('assets/libs/select2/select2.min.js') }}"></script>
    <script>
        //Initialize Select2 Elements
        //Initialize Select2 Elements
        $('.select2').select2({
            theme: 'bootstrap4'
        });

        //Initialize Select2 Elements
        $('.select2bs4').select2({
            theme: 'bootstrap4'
        });


    </script>
@endsection
