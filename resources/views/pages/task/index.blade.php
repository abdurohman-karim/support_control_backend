@extends('layouts.master')
@section('title')

@endsection

@section('content')
    <div class="row mb-3">
        <div class="col-lg-8 col-sm-12">
            <div class="page-title-box d-sm-flex align-items-center justify-content-between">
                <h4 class="mb-sm-0 font-size-18">Задачи</h4>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-body">
                    <div class="row mb-2">
                        <div class="col-sm-12 col-lg-6">
                            Группы чатов
                        </div>
                        <div class="col-sm-12 col-lg-12">
                            <table class="table table-responsive table-responsive-sm align-middle">
                                <thead>
                                <tr>
                                    <th>Чат</th>
                                    <th>Действие</th>
                                </tr>
                                </thead>
                                <tbody>
                                @foreach($tasks as $chatName => $groupTasks)
                                    <tr>
                                        <td>{{ $chatName }}</td>
                                        <td>
                                            <a href="{{ route('tasks.group', $groupTasks->first()->chat_id) }}" class="btn btn-primary position-relative">
                                                Посмотреть задачи
                                                <span class="{{ $lastTasksCounts[$chatName] == 0 ? 'd-none' : '' }} position-absolute top-0 start-100 translate-middle badge rounded-pill bg-danger">
                                                    {{ $lastTasksCounts[$chatName] == 0 ? '' : $lastTasksCounts[$chatName] }}
                                                <span class="visually-hidden">unread messages</span>
                                                </span>
                                            </a>
                                        </td>
                                    </tr>
                                @endforeach
                                </tbody>
                            </table>
                        </div>
                        <div class="col-md-12 col-sm-12 mt-3">
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
