@extends('layouts.master')

@section('content')
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-body">
                    <div class="row mb-2">
                        <div class="col-sm-12 col-lg-6">
                            <h4 class="card-title">Разрешение</h4>
                        </div>
                        @can('Просмотр разрешений')
                            <div class="col-sm-12 col-lg-6">
                                <div class="text-sm-end">
                                    <a href="{{ route('permissions.create') }}" type="button"
                                       class="btn btn-success btn-rounded waves-effect waves-light mb-2 me-2">
                                        <i class="bx bx-bookmark-plus align-middle font-size-16"></i> Добавить разрешение</a>
                                </div>
                            </div>
                        @endcan
                    </div>
                    <div class="table-responsive">
                        <table class="table align-middle table-nowrap table-check">
                            <thead class="table-light">
                            <tr>
                                <th class="align-middle">ИД</th>
                                <th class="align-middle">Имя</th>
                                <th class="align-middle">Роли</th>
                                <th class="align-middle">Создано</th>
                                <th class="text-center w-25">Действие</th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach($permissions as $permission)
                                <tr>
                                    <th>#{{ $permission->id }}</th>
                                    <td>{{ $permission->name }}</td>
                                    <td>
                                        @foreach($permission->roles as $role)
                                            <span class="badge badge-soft-success font-size-12">{{ $role->name }}</span>
                                        @endforeach
                                    </td>
                                    <td>{{ $permission->created_at }}</td>
                                    <td class="text-center w-25">
                                        <form action="{{ route('permissions.destroy',$permission->id) }}"
                                              method="post"> @csrf @method('delete')
                                            @can('Изменить разрешение')
                                                <a href="{{ route('permissions.edit',$permission->id) }}"
                                                   class="btn border-0 btn-outline-success mx-2 btn-rounded waves-effect waves-light">
                                                    <i class="fas fa-pencil-alt font-size-14 align-middle"></i>
                                                </a>
                                            @endcan
                                            @can('Удалить разрешение')
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
                    {{ $permissions->withQueryString()->links() }}
                </div>
            </div>
        </div>
    </div>
@endsection
