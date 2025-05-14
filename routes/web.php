<?php

use App\Http\Controllers\MovieController;
use Illuminate\Support\Facades\Route;



Route::get('/', [MovieController::class,'index']);
Route::get('/movie/{id}/{slug}', [MovieController::class,'detail_movie']);


