@extends('layouts.master')
@section('title')
    Задачи
@endsection

@section('content')
    <div class="row mb-3">
        <div class="col-lg-8 col-sm-12">
            <div class="page-title-box d-sm-flex align-items-center justify-content-between">
                <h4 class="mb-sm-0 font-size-18">Задачи c <span class="text-primary">{{ $tasks->first()->chat_name ?? '' }}</span></h4>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-body">
                    <div class="row mb-2">
                        <div class="col-sm-12 col-lg-6">
                            Групповые задачи
                        </div>
                        <div class="col-sm-12 col-lg-12">
                            <table class="table table-responsive table-responsive-sm align-middle">
                                <thead>
                                <tr>
                                    <th>Задача</th>
                                    <th>Статус</th>
                                    <th>Действие</th>
                                </tr>
                                </thead>
                                <tbody>
                                @php
                                    $currentDate = null;
                                @endphp
                                @foreach($tasks as $task)
                                    @php
                                        $taskDate = $task->created_at->format('Y-m-d');
                                    @endphp
                                    @if($taskDate !== $currentDate)
                                        @php
                                            $currentDate = $taskDate;
                                        @endphp
                                        <tr>
                                            <td colspan="3" class="bg-light">
                                                @if($currentDate == \Carbon\Carbon::today()->format('Y-m-d'))
                                                    Сегодня
                                                @else
                                                    {{ \Carbon\Carbon::parse($currentDate)->translatedFormat('d F Y') }}
                                                @endif
                                            </td>
                                        </tr>
                                    @endif
                                    <tr id="task-{{ $task->id }}">
                                        <td>
                                            <div class="p-2 bg-soft bg-primary rounded">
                                                <span>
                                                    {{ $task->text }}
                                                </span>
                                                <p class="text-muted mb-0 mt-3">
                                                    {{ $task->created_at->format('H:i') }}
                                                </p>
                                            </div>
                                        </td>
                                        <td>
                                            <span class="badge bg-soft fs-6 {{ $task->is_done ? 'bg-success text-success' : 'bg-danger text-danger' }}">
                                                {{ $task->is_done ? 'Выполнено' : 'Не выполнено' }}
                                            </span>
                                        </td>
                                        <td>
                                            <div class="btn-group">
                                                <button class="btn btn-success btn-sm done" data-id="{{ $task->id }}">
                                                    <i class="fa fa-check"></i>
                                                </button>
                                                <button class="btn btn-warning btn-sm archive" data-id="{{ $task->id }}">
                                                    <i class="fa fa-arrow-up"></i>
                                                </button>
                                                <button class="btn btn-danger btn-sm">
                                                    <i class="fa fa-trash"></i>
                                                </button>
                                            </div>
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

@section('script')
    <script>
        $(document).ready(function() {
            $('.done').click(function(e) {
                e.preventDefault();

                var taskId = $(this).data('id');
                var token = '{{ csrf_token() }}'; // Get CSRF token

                $.ajax({
                    url: '{{ url('tasks/to-done') }}/' + taskId,
                    type: 'GET',
                    data: {
                        _token: token
                    },
                    success: function(data) {
                        if (data.success) {
                            var taskRow = $('#task-' + taskId);
                            var statusBadge = taskRow.find('.badge');
                            statusBadge.removeClass('bg-danger text-danger')
                                .addClass('bg-success text-success')
                                .text('Выполнено');
                        }
                    },
                    error: function(xhr, status, error) {
                        console.error('Error:', error);
                    }
                });
            });
            $('.archive').click(function(e) {
                e.preventDefault();

                var taskId = $(this).data('id');
                var token = '{{ csrf_token() }}'; // Get CSRF token

                $.ajax({
                    url: '{{ url('tasks/to-archived') }}/' + taskId,
                    type: 'GET',
                    data: {
                        _token: token
                    },
                    success: function(data) {
                        if (data.success) {
                            var taskRow = $('#task-' + taskId);
                            var statusBadge = taskRow.find('.badge');
                            statusBadge.removeClass('bg-danger text-danger')
                                .addClass('bg-warning text-warning')
                                .text('Архивировано');
                        }
                    },
                    error: function(xhr, status, error) {
                        console.error('Error:', error);
                    }
                });
            })
        });
    </script>
@endsection
