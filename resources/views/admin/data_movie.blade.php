@extends('layouts.template')

@section('title', 'Data Movie')

@section('content')
    <style>
        .forest-header {
            background-color: #1b5e20; /* dark green */
            color: #fff;
        }

        .forest-row:hover {
            background-color: #e8f5e9; /* light green on hover */
        }

        .btn-edit {
            background-color: #388e3c;
        }

        .btn-delete {
            background-color: #b71c1c;
        }

        .btn-detail {
            background-color: #f8be00;
        }

        .btn-edit, .btn-delete, .btn-detail {
            color: #fff;
            transition: all 0.2s ease-in-out;
        }

        .btn-edit:hover,
        .btn-delete:hover,
        .btn-detail:hover {
            filter: brightness(1.2);
            transform: scale(1.05);
        }

        .table-wrapper {
            border: 2px solid #a5d6a7;
            border-radius: 15px;
            overflow: hidden;
            box-shadow: 0 0 15px rgba(27, 94, 32, 0.2);
        }

        .table td, .table th {
            vertical-align: middle;
        }
    </style>

    <h1 class="mb-4 text-success fw-bold">🌿 Daftar Movie</h1>

    <div class="table-responsive table-wrapper">
        <table class="table table-bordered align-middle">
            <thead class="forest-header">
                <tr>
                    <th>No</th>
                    <th>Cover</th>
                    <th>Title</th>
                    <th>Category</th>
                    <th style="width: 150px;">Actors</th>
                    <th>Year</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody>
                @forelse ($movies as $index => $movie)
                    <tr class="forest-row">
                        <td>{{ $index + 1 }}</td>
                        <td>
                            @if($movie->cover_image)
                                <img src="{{ asset($movie->cover_image) }}" alt="{{ $movie->title }}" style="width: 60px; height: 60px; object-fit: cover; border-radius: 10px;">
                            @else
                                <span>-</span>
                            @endif
                        </td>
                        <td>{{ $movie->title }}</td>
                        <td>{{ $movie->category->category_name ?? '-' }}</td>
                        <td style="max-width: 150px; white-space: nowrap; overflow: hidden; text-overflow: ellipsis;">
                            {{ $movie->actors }}
                        </td>
                        <td>{{ $movie->year }}</td>
                        <td>
                            @if(auth()->user()->role === 'admin')
                                <a href="{{ route('movie.edit', $movie->id) }}" class="btn btn-sm btn-edit">Edit</a>
                            @endif

                            @can('delete-movie')
                                <form action="{{ url('/movie/' . $movie->id) }}" method="POST" class="d-inline"
                                    onsubmit="return confirm('Yakin ingin menghapus data ini?')">
                                    @csrf
                                    @method('DELETE')
                                    <button class="btn btn-sm btn-delete">Delete</button>
                                </form>
                            @endcan

                            <a href="{{ route('detail', $movie->id) }}" class="btn btn-sm btn-detail">Detail</a>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="7" class="text-center text-muted">Tidak ada data movie.</td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>

    <div class="mt-3">
        {{ $movies->links() }}
    </div>
@endsection
