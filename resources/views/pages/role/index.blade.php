@extends('layouts.master')

@section('content')
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-body">
                    <div class="row mb-2">
                        <div class="col-sm-12 col-lg-6">
                            Роли
                        </div>
                        @can("Создать новую роль")
                            <div class="col-sm-12 col-lg-6">
                                <div class="text-sm-end">
                                    <a href="{{ route('roles.create') }}" type="button"
                                       class="btn btn-success btn-rounded waves-effect waves-light mb-2 me-2">
                                        <i class="fa fa-plus align-middle font-size-16"></i>
                                        Создать
                                    </a>
                                </div>
                            </div>
                        @endcan
                    </div>

                    <div class="table-responsive">
                        <table class="table align-middle table-check ">
                            <thead class="table-light">
                            <tr>
                                <th class="align-middle">ИД</th>
                                <th class="align-middle">Называние</th>
                                <th class="align-middle">Разрешения</th>
                                <th class="text-center w-25">Действие</th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach($roles as $role)
                                <tr>
                                    <th>#{{ $role->id }}</th>
                                    <td>{{ $role->name }}</td>
                                    <td>
                                        @foreach($role->permissions as $permission)
                                            <span
                                                class="badge badge-soft-primary font-size-12">{{ $permission->name }}</span>
                                        @endforeach
                                    </td>
                                    <td class="text-center w-25">
                                        <form action="{{ route('roles.destroy',$role->id) }}"
                                              method="post"> @csrf @method('delete')
                                            @can('Изменить роль')
                                                <a href="{{ route('roles.edit',$role->id) }}"
                                                   class="btn border-0 btn-outline-success mx-2 btn-rounded waves-effect waves-light">
                                                    <i class="fas fa-pencil-alt font-size-14 align-middle"></i>
                                                </a>
                                            @endcan
                                            @can('Удалить роли')
                                                <button type="button"
                                                        class="submitButtonConfirm btn border-0 btn-outline-danger btn-rounded waves-effect waves-light">
                                                    <i class="far fa-trash-alt font-size-14 align-middle"></i>
                                                </button>
                                            @endcan
                                        </form>
                                    </td>
                                </tr>
                            @endforeach
                            </tbody>
                        </table>
                    </div>
                    {{ $roles->withQueryString()->links() }}
                </div>
            </div>
        </div>
    </div>
@endsection
