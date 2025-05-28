<!doctype html>
<html lang="en">
  <head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <title>Daftar Movie - @yield('title', 'Homepage')</title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.6/dist/css/bootstrap.min.css" rel="stylesheet" />
  </head>
  <body>

    <!-- Navbar -->
    <nav class="navbar navbar-expand-lg bg-success navbar-dark">
      <div class="container">
        <a class="navbar-brand" href="/">MovieApp</a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarContent"
          aria-controls="navbarContent" aria-expanded="false" aria-label="Toggle navigation">
          <span class="navbar-toggler-icon"></span>
        </button>

        <div class="collapse navbar-collapse" id="navbarContent">
          <ul class="navbar-nav me-auto mb-2 mb-lg-0">
            <li class="nav-item">
              <a class="nav-link  {{ request()->is('/') ? 'active' : '' }}" aria-current="page" href="/">Home</a>
            </li>

           @auth
  <li class="nav-item">
    <a class="nav-link {{ request()->is('movie/create') ? 'active' : '' }}" href="/movie/create">Input Movie</a>
  </li>

  <li class="nav-item">
    <a class="nav-link disabled">{{ Auth::user()->name }}</a>
  </li>

  <li class="nav-item">
   <form action="{{ route('logout') }}" method="POST" onsubmit="return confirm('Apakah Anda yakin ingin logout?')">
  @csrf
  <button type="submit" class="nav-link btn btn-link text-white" style="text-decoration: none;">
    Logout
  </button>
</form>

  </li>
@else
  <li class="nav-item">
    <a class="nav-link" href="/login">Login</a>
  </li>
@endauth

           @php
  use App\Models\Movie;

  // Ambil kategori yang sudah terpakai di movies
  $usedCategories = Movie::with('category')
      ->get()
      ->pluck('category')
      ->unique('id')
      ->filter() // hilangkan null kategori kalau ada
      ->values();
@endphp
<li class="nav-item dropdown">
  <a class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">
    Genre
  </a>
  <ul class="dropdown-menu">
    @foreach ($usedCategories as $category)
      <li>
        <a class="dropdown-item" href="{{ url('/?genre=' . urlencode($category->category_name)) }}">
          {{ $category->category_name }}
        </a>
      </li>
    @endforeach
  </ul>
</li>
{{--
            <li class="nav-item">
              <a class="nav-link disabled" aria-disabled="true">Coming Soon</a>
            </li>--}}
          </ul>

          <form class="d-flex" role="search">
            <input class="form-control me-2" type="search" placeholder="Search movies..." aria-label="Search" />
            <button class="btn btn-light" type="submit">Search</button>
          </form>
        </div>
      </div>
    </nav>

    <!-- Main Content -->
    <div class="container my-4">
      @yield('content')
    </div>

    <!-- Footer -->
    <footer class="bg-success text-white text-center py-3">
      &copy; 2025 Developed by Nashwa
    </footer>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.6/dist/js/bootstrap.bundle.min.js"></script>
  </body>
</html>
