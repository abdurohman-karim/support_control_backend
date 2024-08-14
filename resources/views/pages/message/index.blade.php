@extends('layouts.master')

@section('title')
    Сообщения к чатам
@endsection

@section('content')
    <div class="row mb-3">
        <div class="col-lg-8 col-sm-12">
            <div class="page-title-box d-sm-flex align-items-center justify-content-between">
                <h4 class="mb-sm-0 font-size-18">Сообщения к чатам</h4>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-md-8 offset-2">
            <div class="card">
                <div class="card-body">
                    <div class="row mb-2">
                        <div class="col-md-12 col-sm-12 mt-3">
                            <form action="{{ route('chats.message') }}" method="post" >
                                @csrf
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="mb-3">
                                            <div class="form-group">
                                                <label for="message">Сообщение</label>
                                                <textarea class="form-control" name="message" id="message" cols="30" rows="10"></textarea>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="mb-3">
                                            <div class="form-group">
                                                <label for="chat_id">Выберите чат</label>
                                                <select class="form-control select2 select2-multiple" multiple name="chat_ids[]">
                                                    @foreach($chats as $chat)
                                                        <option value="{{ $chat->chat_id }}">{{ $chat->name }}</option>
                                                    @endforeach
                                                </select>
                                            </div>
                                        </div>
                                        <div class="mb-3">
                                            <div class="form-group">
                                                <label for="task_id">Выбрать все</label>
                                                <input type="checkbox" name="check_all" class="form-check-input">
                                            </div>
                                        </div>
                                    </div>

                                    <div class="col-md-12">
                                        <button type="submit" class="btn btn-primary">Отправить</button>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('script')
    <script src="{{ URL::asset('assets/js/pages/form-advanced.init.js') }}"></script>
@endsection
