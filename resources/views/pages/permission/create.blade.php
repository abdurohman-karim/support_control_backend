@extends('layouts.master')

@section('content')
  <div class="row">
      <div class="col-md-6 col-lg-6 offset-lg-3 offset-md-3 col-sm-12">
          <div class="card">
              <div class="card-body">
                  <h4 class="card-title mb-4">Создать новое разрешение</h4>

                  <form action="{{ route('permissions.store') }}" method="post">
                      @csrf
                      <div class="mb-3">
                          <label for="formrow-firstname-input" class="form-label">Название разрешения</label>
                          <input type="text" name="name" value="{{ old('name') }}" class="form-control @error('name') is-invalid @enderror">
                          @error('name')
                          <div class="invalid-feedback">
                              {{ $message }}
                          </div>
                          @enderror
                      </div>
                      <div class="row">
                          <div class="text-lg-end text-sm-center">
                              <div>
                                  <button type="submit" class="btn btn-success w-md"><i class="fas fa-save"></i> Создать</button>
                                  <a href="{{ route('permissions.index') }}" class="btn btn-secondary w-md">Отмена</a>
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
