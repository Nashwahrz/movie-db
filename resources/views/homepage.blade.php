@extends('layouts.template')

@section('title', 'Homepage')

@section('content')

<style>
    body {
        background-color: #e8f5e9;
    }

    h1 {
        color: #2e7d32;
        font-weight: bold;
    }

    .card {
        border: none;
        border-radius: 15px;
        box-shadow: 0 6px 18px rgba(76, 175, 80, 0.2);
        background-color: #ffffff;
    }

    .card-title {
        color: #33691e;
        font-weight: 600;
    }

    .card-text {
        color: #4e342e;
    }

    .btn-success {
        background-color: #388e3c;
        border-color: #2e7d32;
        font-weight: 500;
        border-radius: 8px;
    }

    .btn-success:hover {
        background-color: #2e7d32;
        transform: scale(1.03);
    }

    .text-body-secondary {
        color: #689f38 !important;
    }

    .pagination .page-link {
        color: #2e7d32;
    }

    .pagination .page-item.active .page-link {
        background-color: #66bb6a;
        border-color: #388e3c;
        color: white;
    }

    .pagination .page-link:hover {
        background-color: #c8e6c9;
    }
</style>

<h1 class="mb-4">
    @if(isset($category_name))
        Genre: {{ $category_name }}
    @else
        🌿 Latest Movie
    @endif
</h1>

<div class="row g-4">
    @foreach($movies as $movie)
        <div class="col-lg-6 d-flex align-items-stretch">
            <div class="card w-100">
                <div class="row g-0 h-100">
                    <div class="col-md-4">
                        <div style="height: 100%; overflow: hidden; border-top-left-radius: 15px; border-bottom-left-radius: 15px;">
                            <img src="{{ asset($movie->cover_image) }}"
                                 class="img-fluid h-100"
                                 alt="{{ $movie->title }}"
                                 style="object-fit: cover; width: 100%; border-top-left-radius: 15px; border-bottom-left-radius: 15px;">
                        </div>
                    </div>
                    <div class="col-md-8 d-flex flex-column">
                        <div class="card-body d-flex flex-column flex-grow-1">
                            <h5 class="card-title">{{ $movie->title }}</h5>
                            <p class="card-text">{{ \Illuminate\Support\Str::words($movie->synopsis, 15) }}</p>
                            <p class="card-text mt-auto">
                                <small class="text-body-secondary">Year: {{ $movie->year }}</small>
                            </p>
                            <a href="/movie/{{ $movie->id }}/{{ $movie->slug }}" class="btn btn-success mt-3">🍃 Read More</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    @endforeach
</div>

<div class="mt-4">
    {{ $movies->links() }}
</div>

@endsection
