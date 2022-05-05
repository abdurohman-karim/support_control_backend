@extends('layouts.admin')
@section('content')
    <div class="container-fluid">
        <div class="page-title-box d-sm-flex align-items-center justify-content-between">
            <h4 class="mb-sm-0 font-size-18">Users</h4>
        </div>
        <div class="row">
            <div class="col-lg-12 col-md-12 col-sm-12">
                <div class="card card-info card-outline">
                    <div class="card-body table-responsive">
                        <h3 class="card-title">Users</h3>
                        <hr>
                        <table class="table" id="datatable">
                            <thead>
                            <tr>
                                <th style="width: 10px">#</th>
                                <th>Name</th>
                                <th>Email</th>
                                <th class="text-center">Roles</th>
                                <th class="text-center">Action</th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach($users as $user)
                            <tr>
                                <td>{{ $user->id }}</td>
                                <td>{{ $user->name }}</td>
                                <td>{{ $user->email }}</td>
                                <td>
                                    <span class="badge badge-soft-info font-size-11">Admin</span>
                                    <span class="badge badge-soft-info font-size-11">Manager</span>
                                </td>
                                <td class="text-center">
                                    <form action="{{ route('userDestroy',$user->id) }}" method="post">
                                        @csrf
                                        <div class="btn-group">
                                            @can('user.edit')
                                                <a href="{{ route('userEdit',$user->id) }}" class="btn-rounded btn-sm mdi mdi-18px mdi-pencil text-success waves-effect"></a>
                                            @endcan
                                            @can('user.delete')
                                                <input name="_method" type="hidden" value="DELETE">
                                                <button type="button" class="btn-rounded waves-effect btn-sm border-0 bg-white" onclick="if (confirm('Вы уверены?')) { this.form.submit() } ">
                                                    <a class="mdi mdi-trash-can-outline text-danger mdi-18px "></a>
                                                </button>
                                            @endcan
                                        </div>

                                    </form>
                                </td>
                            </tr>
                            @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
@section('scripts')
    <!-- Required datatable js -->
    <script src="{{ asset('assets/libs/datatables/datatables.min.js')}}"></script>
    <script src="{{ asset('assets/libs/jszip/jszip.min.js')}}"></script>
    <script src="{{ asset('assets/libs/pdfmake/pdfmake.min.js')}}"></script>
    <script src="{{ asset('assets/js/pages/datatables.init.js')}}"></script>
@endsection
