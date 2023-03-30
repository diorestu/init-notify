@extends('layouts.app')

@section('content')
    <div class="container">
        @if (session('success'))
            <div class="alert alert-success pb-0" role="alert">
                <h4 class="alert-heading">Berhasil !</h4>
                <p>{{ session('success') }}</p>
            </div>
        @endif
        @if (session('error'))
            <div class="alert alert-danger pb-0" role="alert">
                <h4 class="alert-heading">Gagal !</h4>
                <p>{{ session('error') }}</p>
            </div>
        @endif
        <form class="card" method="post" action="{{ route('message.store') }}">
            @csrf
            @method('POST')
            <div class="card-body p-4">
                <div class="row mb-3">
                    <label for="message" class="col-md-4 col-form-label text-md-start">{{ __('Teks Pesan') }}</label>

                    <div class="col-md-8">
                        <textarea id="message" class="form-control @error('message') is-invalid @enderror" name="message" required autofocus
                            rows="5"></textarea>

                        @error('message')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>
                </div>
                <div class="row mb-3">
                    <label for="url"
                        class="col-md-4 col-form-label text-md-start">{{ __('URL Pesan (Opsional)') }}</label>

                    <div class="col-md-8">
                        <input id="url" type="text" class="form-control @error('url') is-invalid @enderror"
                            name="url" />

                        @error('url')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>
                </div>
            </div>
            <div class="card-footer">
                <button type="submit" class="btn btn-success w-100">Kirim</button>
            </div>
        </form>
    </div>
@endsection
