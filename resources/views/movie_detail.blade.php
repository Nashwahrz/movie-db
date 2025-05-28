@extends('layouts.template')

@section('title', 'Detail Movie')

@section('content')

<style>
  body {
    background-color: #e6f2e6;
  }

  .card {
    background-color: #f0f9f0;
    border: 2px solid #4a7c59;
    box-shadow: 0 4px 12px rgba(74, 124, 89, 0.4);
  }

  .card-title {
    color: #2f4f2f;
    font-weight: 700;
    font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
    font-size: 2.5rem; /* lebih besar */
  }

  .card-text {
    color: #3a5f3a;
    font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
    font-size: 1.2rem; /* teks lebih besar */
  }

  .btn-success {
    background-color: #4a7c59;
    border-color: #3a5f3a;
    transition: background-color 0.3s ease;
    font-size: 1.1rem;
    padding: 0.75rem 1.5rem;
  }
  .btn-success:hover {
    background-color: #3a5f3a;
    border-color: #2f4f2f;
  }

  .img-fluid {
    border-radius: 8px;
    border: 3px solid #4a7c59;
    object-fit: cover;
    height: 100%;
    max-height: 500px; /* lebih besar */
    width: 100%;
  }

  .card-body {
    padding: 2rem 2.5rem;
  }
</style>

<div class="row justify-content-center">
  <div class="col-lg-10">

    <div class="card mb-5">

      <div class="row g-0">
        <div class="col-md-5 p-4 d-flex align-items-center">
          <img src="{{ asset($movie->cover_image) }}" class="img-fluid" alt="{{ $movie->title }}">
        </div>
        <div class="col-md-7">
          <div class="card-body">
            <h5 class="card-title">{{ $movie->title }}</h5>
            <p class="card-text">{{ $movie->synopsis }}</p>
            <p class="card-text"><strong>Actors:</strong> {{ $movie->actors }}</p>
            <p class="card-text"><strong>Category:</strong> {{ $movie->category->category_name }}</p>
            <p class="card-text"><small class="text-muted">Year: {{ $movie->year }}</small></p>
            <a href="/" class="btn btn-success mt-4">Back</a>
          </div>
        </div>
      </div>

    </div>

  </div>
</div>

@endsection
