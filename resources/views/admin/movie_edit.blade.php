@extends('layouts.template')

@section('title', 'Edit Movie')

@section('content')
<h1>Edit Data Movie</h1>

<div class="mb-3 row">
  <div>
    <a href="{{ route('dataMovie') }}" class="btn btn-primary">Kembali ke Data Movie</a>
  </div>
</div>

<form action="{{ route('movie.update', $movie->id) }}" method="POST" enctype="multipart/form-data" class="needs-validation" novalidate>
    @csrf
    @method('PUT') {{-- Gunakan method PUT untuk update data --}}

    {{-- Title --}}
    <div class="mb-3 row">
        <label for="title" class="col-sm-2 col-form-label">Title</label>
        <div class="col-sm-10">
            <input type="text" class="form-control @error('title') is-invalid @enderror" id="title" name="title"
                   value="{{ old('title', $movie->title) }}" required>
            <div class="invalid-feedback">Title wajib diisi.</div>
        </div>
    </div>

    {{-- Synopsis --}}
    <div class="mb-3 row">
        <label for="synopsis" class="col-sm-2 col-form-label">Synopsis</label>
        <div class="col-sm-10">
            <textarea class="form-control" id="synopsis" name="synopsis" rows="5" required>{{ old('synopsis', $movie->synopsis) }}</textarea>
        </div>
    </div>

    {{-- Category --}}
    <div class="mb-3 row">
        <label for="category_id" class="col-sm-2 col-form-label">Category</label>
        <div class="col-sm-10">
            <select class="form-select @error('category_id') is-invalid @enderror" id="category_id" name="category_id" required>
                <option value="" disabled>-- Pilih Category --</option>
                @foreach ($categories as $category)
                    <option value="{{ $category->id }}" {{ $movie->category_id == $category->id ? 'selected' : '' }}>
                        {{ $category->category_name }}
                    </option>
                @endforeach
            </select>
            <div class="invalid-feedback">Silakan pilih kategori film.</div>
        </div>
    </div>

    {{-- Year --}}
    <div class="mb-3 row">
        <label for="year" class="col-sm-2 col-form-label">Year</label>
        <div class="col-sm-10">
            <select class="form-select" id="year" name="year" required>
                <option value="" disabled>Pilih Tahun</option>
                @php
                    $currentYear = date('Y');
                    for ($year = $currentYear; $year >= 1990; $year--) {
                        $selected = $movie->year == $year ? 'selected' : '';
                        echo "<option value=\"$year\" $selected>$year</option>";
                    }
                @endphp
            </select>
        </div>
    </div>

    {{-- Actors --}}
    <div class="mb-3 row">
        <label for="actors" class="col-sm-2 col-form-label">Actors</label>
        <div class="col-sm-10">
            <input type="text" class="form-control" id="actors" name="actors" value="{{ old('actors', $movie->actors) }}" required>
        </div>
    </div>

    {{-- Cover Image --}}
    <div class="mb-3 row">
        <label for="cover_image" class="col-sm-2 col-form-label">Cover Image</label>
        <div class="col-sm-10">
            <input type="file" class="form-control @error('cover_image') is-invalid @enderror" id="cover_image" name="cover_image" accept="image/*">
            @error('cover_image')
                <div class="invalid-feedback">{{ $message }}</div>
            @enderror
            <label for="cover_image" class="col-sm-2 col-form-label">Old Image</label>
            @if ($movie->cover_image)
                <div class="mt-2">
                    <img src="{{ asset($movie->cover_image) }}" alt="{{ $movie->title }}" alt="Cover" width="120">
                </div>
            @endif
            <small class="form-text text-muted">Kosongkan jika tidak ingin mengganti gambar.</small>
        </div>
    </div>

    {{-- Submit Button --}}
    <div class="mb-3 row">
        <div class="col-sm-10 offset-sm-2">
            <button type="submit" class="btn btn-success">Update</button>
        </div>
    </div>
</form>
@endsection

<script>
    (() => {
        'use strict'
        const forms = document.querySelectorAll('.needs-validation')
        Array.from(forms).forEach(form => {
            form.addEventListener('submit', event => {
                if (!form.checkValidity()) {
                    event.preventDefault()
                    event.stopPropagation()
                }
                form.classList.add('was-validated')
            }, false)
        })
    })()
</script>
