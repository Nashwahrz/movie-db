<?php

namespace App\Http\Controllers;

use App\Models\Movie;
use App\Models\Category;
use Illuminate\Support\Str;
use Illuminate\Http\Request;

class MovieController extends Controller
{
  public function index(){
    // $movies = Movie::latest() memanggil semua
     $movies = Movie::latest()->paginate(6); // Ambil 6 film terbaru
    return view('homepage', compact('movies'));
   // return view('homepage, ['movie'-> $movies]);
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
    // Proses upload cover
    $cover = $request->file('cover_image');
    $namaFileCover = time() . '_' . $cover->getClientOriginalName();
    $cover->move(public_path('covers'), $namaFileCover);

    Movie::create([
        'title' => $request->title,
        'slug' => Str::slug($request->title),
        'synopsis' => $request->synopsis,
        'category_id' => $request->category_id,
        'year' => $request->year,
        'actors' => $request->actors,
        'cover_image' => 'covers/' . $namaFileCover, // simpan folder + nama file
    ]);

    return redirect('/')->with('success', 'Movie berhasil ditambahkan!');
}


}

