@extends('layouts.template')

@section('title','Form input movie')

@section('content')

{{-- form movie --}}
<h1>Form Data Movie</h1>
<form action="/movie/store" method="POST" enctype="multipart/form-data">
    @csrf {{-- Jangan lupa token CSRF untuk keamanan --}}

    {{-- Title --}}
    <div class="mb-3 row">
        <label for="title" class="col-sm-2 col-form-label">Title</label>
        <div class="col-sm-10">
            <input type="text" class="form-control" id="title" name="title" required>
        </div>
    </div>

    {{-- Synopsis --}}
    <div class="mb-3 row">
        <label for="synopsis" class="col-sm-2 col-form-label">Synopsis</label>
        <div class="col-sm-10">
            <textarea class="form-control" id="synopsis" name="synopsis" rows="5" required></textarea>
        </div>
    </div>

    {{-- Category --}}
<div class="mb-3 row">
    <label for="category_id" class="col-sm-2 col-form-label">Category</label>
    <div class="col-sm-10">
        <select class="form-select" id="category_id" name="category_id" required>
            <option value="" selected disabled>-- Pilih Category --</option>
            @foreach ($categories as $category)
                <option value="{{ $category->id }}">{{ $category->category_name }}</option>
            @endforeach
        </select>
    </div>
</div>



    {{-- Year --}}
    <div class="mb-3 row">
        <label for="year" class="col-sm-2 col-form-label">Year</label>
        <div class="col-sm-10">
            <input type="number" class="form-control" id="year" name="year" required min="1900" max="{{ date('Y') }}">
        </div>
    </div>

    {{-- Actors --}}
    <div class="mb-3 row">
        <label for="actors" class="col-sm-2 col-form-label">Actors</label>
        <div class="col-sm-10">
            <input type="text" class="form-control" id="actors" name="actors" placeholder="Contoh: Tom Holland, Zendaya" required>
        </div>
    </div>

    {{-- Cover Image --}}
    <div class="mb-3 row">
        <label for="cover_image" class="col-sm-2 col-form-label">Cover Image</label>
        <div class="col-sm-10">
            <input type="file" class="form-control" id="cover_image" name="cover_image" accept="image/*" required>
        </div>
    </div>

    {{-- Submit Button --}}
    <div class="mb-3 row">
        <div class="col-sm-10 offset-sm-2">
            <button type="submit" class="btn btn-primary">Submit</button>
        </div>
    </div>

</form>

@endsection
