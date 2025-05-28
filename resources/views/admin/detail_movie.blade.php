@extends('layouts.template')

@section('title', 'Detail Movie')

@section('content')
<style>
    body {
        background: #e6f0e6; /* Hijau muda soft */
        font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
    }
    .card {
        background: #f0faf0; /* putih kehijauan */
        border: 2px solid #4caf50; /* hijau daun */
        border-radius: 15px;
        box-shadow: 0 4px 8px rgba(76, 175, 80, 0.3);
    }
    h1, h2, h5 {
        color: #2e7d32; /* hijau gelap */
        font-weight: 700;
    }
    p {
        color: #336633;
        font-size: 1.05rem;
    }
    hr {
        border-color: #a5d6a7; /* hijau pastel */
        border-width: 2px;
    }
    .btn-secondary {
        background-color: #4caf50;
        border-color: #388e3c;
        font-weight: bold;
    }
    .btn-secondary:hover {
        background-color: #388e3c;
        border-color: #2e7d32;
    }
    .cover-image {
        width: 120px;
        height: auto;
        object-fit: cover;
        border-radius: 12px;
        box-shadow: 0 0 10px #4caf50aa;
        margin-top: 15px;
    }
    .content-wrapper {
        max-width: 600px;
        margin-left: auto;
        margin-right: auto;
        padding: 20px 30px;
        background-image: url('https://www.transparenttextures.com/patterns/leaf.png');
        background-repeat: repeat;
        border-radius: 15px;
        box-shadow: 0 6px 12px rgba(0, 100, 0, 0.1);
    }
</style>

@if ($movie)
    <h1 class="mb-4 text-center">Detail Movie</h1>

    <div class="card content-wrapper">
        <div class="text-center">
            <img src="{{ asset($movie->cover_image) }}" alt="{{ $movie->title }}" class="cover-image">
        </div>
        <div class="card-body">
            <h2 class="card-title text-center">{{ $movie->title }}</h2>
            <p class="text-muted mb-2 text-center">
                <strong>Category:</strong> {{ $movie->category->category_name ?? '-' }}
            </p>
            <p class="mb-2 text-center">
                <strong>Actors:</strong> {{ $movie->actors }}
            </p>
            <p class="mb-2 text-center">
                <strong>Year:</strong> {{ $movie->year }}
            </p>
            <hr>
            <h5>Synopsis</h5>
            <p>{{ $movie->synopsis ?: 'No synopsis available.' }}</p>

            <div class="text-center">
                <a href="{{ route('dataMovie') }}" class="btn btn-secondary mt-3">Kembali</a>
            </div>
        </div>
    </div>
@else
    <div class="alert alert-warning" role="alert">
        Data movie tidak ditemukan.
    </div>
    <a href="{{ route('dataMovie') }}" class="btn btn-danger">Kembali</a>
@endif
@endsection
