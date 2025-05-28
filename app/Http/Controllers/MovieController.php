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


    public function detail_movie($id, $slug)
    {
        $movie = Movie::find($id);
        return view('movie_detail', compact('movie'));
    }

    public function create()
    {
        $categories = Category::all();
        return view('admin.movie_form', compact('categories'));
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
    public function data_movie()
{
    $movies =Movie::orderBy('created_at', 'desc')->paginate(10);
    return view('admin.data_movie', compact('movies'));
}
    public function edit($id)
    {
        $movie = Movie::findOrFail($id);
        $categories = Category::all(); // untuk dropdown kategori
        return view('admin.movie_edit', compact('movie', 'categories'));
    }

    public function destroy($id)
    {
        $movie = Movie::findOrFail($id);

        // Hapus cover image jika ada
        if ($movie->cover_image && file_exists(public_path('storage/' . $movie->cover_image))) {
            unlink(public_path('storage/' . $movie->cover_image));
        }

        $movie->delete();

        return redirect()->route('dataMovie')->with('success', 'Data movie berhasil dihapus.');
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'synopsis' => 'required|string',
            'category_id' => 'required|exists:categories,id',
            'year' => 'required|integer|min:1990|max:' . date('Y'),
            'actors' => 'required|string',
            'cover_image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);

        $movie = Movie::findOrFail($id);

        // Update fields
        $movie->title = $request->title;
        $movie->synopsis = $request->synopsis;
        $movie->category_id = $request->category_id;
        $movie->year = $request->year;
        $movie->actors = $request->actors;

        //image

        if ($request->hasFile('cover_image')) {
            $file = $request->file('cover_image');
            $filename = time() . '_' . $file->getClientOriginalName();

            // Pindahkan file ke folder 'covers' supaya sama dengan method store
            $file->move(public_path('covers'), $filename);

            // Hapus gambar lama jika ada
            if ($movie->cover_image && file_exists(public_path($movie->cover_image))) {
                unlink(public_path($movie->cover_image));
            }

            // Simpan path relatif lengkap
            $movie->cover_image = 'covers/' . $filename;
        }

        $movie->save();

        return redirect()->route('dataMovie')->with('success', 'Movie berhasil diupdate.');
    }
    public function detail($id)
    {
        $movie = Movie::find($id);
        return view('admin.detail_movie', compact('movie'));
    }



    // public function byGenre($category_name)
    // {
    //     $category = Category::where('category_name', $category_name)->firstOrFail();
    //     $movies = Movie::where('category_id', $category->id)->get();

    //     return view('movies.byGenre', compact('movies', 'category'));
    // }
}
