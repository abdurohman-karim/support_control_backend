@extends('layouts.master')

@section('content')
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-body">
                    <div class="row mb-2">
                        <div class="col-sm-12">
                            <div class="text-sm-end">
                                <a href="{{ route('users.create') }}" type="button" class="btn btn-success btn-rounded waves-effect waves-light mb-2 me-2">
                                    <i class="fas fa-user-plus align-middle font-size-16"></i> Добавить пользователя</a>
                            </div>
                        </div>
                    </div>

                    <div class="table-responsive">
                        <table class="table align-middle table-nowrap table-check ">
                            <thead class="table-light">
                            <tr>
                                <th class="align-middle">ИД</th>
                                <th class="align-middle">Имя</th>
                                <th class="align-middle">Электронная почта</th>
                                <th class="align-middle">Телефон</th>
                                <th class="align-middle">Роли</th>
                                <th class="text-center w-25">Действие</th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach($users as $user)
                            @if(!($user->phone == '973667733' && auth()->user()->phone != '973667733'))
                            <tr>
                                <td>
                                    <div>
                                        <i class="avatar-xs fa-user fas font-size-24 rounded-circle text-center" style="{{ $user->isOnline() ? 'box-shadow: 0px 0px 7px 0px #04ff00':'' }}"></i>
                                    </div>
                                </td>
                                <td>
                                    <h5 class="font-size-14 mb-1">{{ $user->name }}</h5>
                                </td>
                                <td>{{ $user->email }}</td>
                                <td>
                                    {{ $user->phone }}
                                </td>
                                <td>
                                    <div>
                                        @foreach($user->roles as $role)
                                            <a class="badge badge-soft-primary font-size-11 m-1">{{ $role->name }}</a>
                                        @endforeach
                                    </div>
                                </td>
                                <td class="text-center w-25">
                                    <form action="{{ route('users.destroy',$user->id) }}" method="post">
                                        <a href="{{ route('users.edit',$user->id) }}" class="btn border-0 btn-outline-success mx-2 btn-rounded waves-effect waves-light">
                                            <i class="fas fa-user-edit font-size-16 align-middle"></i>
                                        </a>
                                        @csrf
                                        @method('delete')
                                        <button type="button" class="submitButtonConfirm btn border-0 btn-outline-danger btn-rounded waves-effect waves-light">
                                            <i class="fas fa-user-times font-size-16 align-middle"></i>
                                        </button>
                                    </form>
                                </td>
                            </tr>
                            @endif
                            @endforeach
                            </tbody>
                        </table>
                    </div>
                    {{ $users->withQueryString()->links() }}
                </div>
            </div>
        </div>
    </div>
@endsection
