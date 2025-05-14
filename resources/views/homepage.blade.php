@extends('layouts.template')

@section('title', 'Homepage')

@section('content')

    <h1>Latest Movie</h1>
    <div class="row">
        @foreach($movies as $movie)
        <div class="col-lg-6">

        <div class="card mb-3" style="max-width: 540px;">
     <div class="row g-0">
    <div class="col-md-4">
      <img src="{{$movie->cover_image}}" class="img-fluid rounded-start" alt="...">
    </div>
    <div class="col-md-8">
      <div class="card-body">
        <h5 class="card-title">{{$movie->title}}</h5>
        <p class="card-text">{{Str::words($movie->synopsis, 15)}}</p>
        <p class="card-text"><small class="text-body-secondary">Year: {{$movie->year}}</small></p>
        <a href="/movie/{{ $movie->id }}/{{ $movie->slug }}"class="btn btn-success">Read More </a>
      </div>
    </div>
    </div>
  </div>
</div>
@endforeach
<div>
    {{ $movies->links() }}
</div>
    </div>

@endsection
