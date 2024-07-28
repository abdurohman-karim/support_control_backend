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
                            <ul class="simplebar-content list-unstyled chat-list p-0">
                                @foreach($tasks as $chatName => $groupTasks)
                                    <li class="p-2 border-bottom">
                                        <a href="{{ route('tasks.group', $groupTasks->first()->chat_id) }}">
                                            <div class="d-flex">
                                                <div class="flex-shrink-0 align-self-center me-3">
                                                    <i class="mdi mdi-circle font-size-10"></i>
                                                </div>
                                                <div class="flex-shrink-0 me-3">
                                                    <div class="avatar-xs">
                                                        <span class="avatar-title rounded-circle bg-primary bg-soft text-primary"> {{ $chatName[0] }} </span>
                                                    </div>
                                                </div>

                                                <div class="flex-grow-1 overflow-hidden">
                                                    <h5 class="text-truncate font-size-14 mb-1">{{ $chatName }}</h5>
                                                    <p class="mb-0 text-muted opacity-75"> {{ Str::limit($groupTasks->last()->text, 60) }} </p>
                                                </div>
                                                <div class="font-size-11">
                                                    <span class="badge bg-primary fs-6 rounded-pill {{ $lastTasksCounts[$chatName] == 0 ? 'd-none' : '' }}">
                                                        {{ $lastTasksCounts[$chatName] == 0 ? '' : $lastTasksCounts[$chatName] }}
                                                    </span>
                                                </div>
                                            </div>
                                        </a>
                                    </li>
                                @endforeach

                            </ul>
                        </div>
                        <div class="col-md-12 col-sm-12 mt-3">
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
