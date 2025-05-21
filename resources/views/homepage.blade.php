@extends('layouts.template')

@section('title', 'Homepage')

@section('content')

    <h1 class="mb-4">Latest Movie</h1>

    <div class="row g-4">
        @foreach($movies as $movie)
            <div class="col-lg-6 d-flex align-items-stretch">
                <div class="card w-100">
                    <div class="row g-0 h-100">
                        <div class="col-md-4">
                            <div style="height: 100%; overflow: hidden;">
                                <img src="{{ asset($movie->cover_image) }}"
                                     class="img-fluid rounded-start h-100"
                                     alt="{{ $movie->title }}"
                                     style="object-fit: cover; width: 100%;">
                            </div>
                        </div>
                        <div class="col-md-8 d-flex flex-column">
                            <div class="card-body d-flex flex-column flex-grow-1">
                                <h5 class="card-title">{{ $movie->title }}</h5>
                                <p class="card-text">{{ Str::words($movie->synopsis, 15) }}</p>
                                <p class="card-text mt-auto">
                                    <small class="text-body-secondary">Year: {{ $movie->year }}</small>
                                </p>
                                <a href="/movie/{{ $movie->id }}/{{ $movie->slug }}" class="btn btn-success mt-3">Read More</a>
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
