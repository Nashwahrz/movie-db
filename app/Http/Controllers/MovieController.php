<?php

namespace App\Http\Controllers;

use App\Models\Movie;
use App\Models\Category;
use Illuminate\Support\Str;
use Illuminate\Http\Request;

class MovieController extends Controller
{
  public function index(Request $request)
{
    // Ambil query parameter genre (category_name)
    $genre = $request->query('genre');

    if ($genre) {
        // Cari category berdasarkan category_name
        $category = Category::where('category_name', $genre)->first();

        if ($category) {
            // Ambil movie yang punya category_id sesuai category ini, paginate
            $movies = Movie::where('category_id', $category->id)
                ->orderBy('created_at', 'desc')  // Urutkan terbaru dulu
                ->paginate(6)
                ->appends(['genre' => $genre]); // <-- Ini yang penting

            // Kirim category_name juga supaya bisa ditampilkan di view
            return view('homepage', [
                'movies' => $movies,
                'category_name' => $category->category_name,
            ]);
        } else {
            // Kalau genre gak ditemukan, tampilkan kosong atau semua movie (pilih salah satu)
            $movies = Movie::orderBy('created_at', 'desc')->paginate(6);
            return view('homepage', [
                'movies' => $movies,
                'category_name' => null,
            ]);
        }
    } else {
        // Kalau gak ada filter genre, tampilkan semua movie
        $movies = Movie::orderBy('created_at', 'desc')->paginate(6);
        return view('homepage', [
            'movies' => $movies,
            'category_name' => null,
        ]);
    }
}


  public function detail_movie($id, $slug){
    $movie = Movie::find($id);
    return view('movie_detail', compact('movie'));
  }

  public function create(){
    $categories = Category::all();
    return view('movie_form', compact('categories'));
  }
 public function store(Request $request)
{
    // Validasi input
    $validated = $request->validate([
        'title' => 'required|string|max:255',
        'synopsis' => 'nullable|string',
        'category_id' => 'required|exists:categories,id',
        'year' => 'required|integer',
        'actors' => 'required|string',
        'cover_image' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048', // validasi gambar
    ]);

    // Proses upload cover
    $cover = $request->file('cover_image');
    $namaFileCover = time() . '_' . $cover->getClientOriginalName();
    $cover->move(public_path('covers'), $namaFileCover);

    // Simpan data ke database
    Movie::create([
        'title' => $validated['title'],
        'slug' => Str::slug($validated['title']),
        'synopsis' => $validated['synopsis'],
        'category_id' => $validated['category_id'],
        'year' => $validated['year'],
        'actors' => $validated['actors'],
        'cover_image' => 'covers/' . $namaFileCover,
    ]);

    return redirect('/')->with('success', 'Movie berhasil ditambahkan!');
}

// public function byGenre($category_name)
// {
//     $category = Category::where('category_name', $category_name)->firstOrFail();
//     $movies = Movie::where('category_id', $category->id)->get();

//     return view('movies.byGenre', compact('movies', 'category'));
// }
}

