<?php

use App\Http\Middleware\RoleAdmin;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\MovieController;
use Illuminate\Container\Attributes\Auth;



Route::get('/', [MovieController::class,'index']);
Route::get('/movie/{id}/edit', [MovieController::class, 'edit'])->name('movie.edit')->middleware('auth',RoleAdmin::class);
Route::delete('/movie/{id}', [MovieController::class, 'destroy'])->name('movie.destroy')->middleware('auth');
Route::put('/movie/{id}', [MovieController::class, 'update'])->name('movie.update')->middleware('auth',RoleAdmin::class);
Route::get('/movie/detail/{id}', [MovieController::class, 'detail'])->name('detail')->middleware('auth');
Route::get('/movie/{id}/{slug}', [MovieController::class,'detail_movie']);
Route::get('/movie/create', [MovieController::class,'create'])->middleware('auth');
Route::post('/movie/store', [MovieController::class,'store']);
Route::get('/genre/{category_name}', [MovieController::class, 'index']);

Route::get('/login', [AuthController::class,'formLogin'])->name('login');

Route::post('/login', [AuthController::class,'login']);

Route::post('/logout', [AuthController::class, 'destroy'])->name('logout');

Route::get('/movie', [MovieController::class,'data_movie'])->name('dataMovie')->middleware('auth');

