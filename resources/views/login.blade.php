@extends('layouts.template')
@section('content')

<style>
    body {
        background: linear-gradient(to bottom, #a8e6a3, #e8f5e9); /* gradasi hijau daun ke hijau muda */
        font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
    }

    .card-form {
        max-width: 450px;
        margin: 60px auto;
        padding: 30px;
        border-radius: 15px;
        background-color: #ffffff;
        box-shadow: 0 10px 25px rgba(34, 139, 34, 0.2);
        border: 1px solid #c8e6c9;
    }

    .form-label {
        font-weight: 600;
        color: #2e7d32; /* hijau daun tua */
    }

    .form-control {
        border: 2px solid #c5e1a5;
        transition: 0.3s;
    }

    .form-control:focus {
        border-color: #66bb6a;
        box-shadow: 0 0 0 0.2rem rgba(102, 187, 106, 0.25);
    }

    .btn-primary {
        background-color: #388e3c; /* hijau utama */
        border: none;
    }

    .btn-primary:hover {
        background-color: #2e7d32;
    }

    .text-danger {
        font-size: 0.875em;
    }

    .form-text {
        color: #6c757d;
    }
</style>

<div class="card-form">
    <h3 class="text-center mb-4" style="color: #2e7d32;">Login ke Akunmu</h3>
    <form action="/login" method="post">
        @csrf

        <div class="mb-3">
            <label for="email" class="form-label">Email address</label>
            <input type="email"
                   name="email"
                   id="email"
                   class="form-control @error('email') is-invalid @enderror"
                   aria-describedby="emailHelp">
            <div id="emailHelp" class="form-text">Email kamu aman bersama kami 🍃</div>
            @error('email')
                <small class="text-danger">{{ $message }}</small>
            @enderror
        </div>

        <div class="mb-3">
            <label for="exampleInputPassword1" class="form-label">Password</label>
            <input type="password"
                   name="password"
                   class="form-control"
                   id="exampleInputPassword1">
        </div>

        <div class="mb-3 form-check">
            <input type="checkbox"
                   class="form-check-input"
                   id="exampleCheck1">
            <label class="form-check-label" for="exampleCheck1">check me out 🌿</label>
        </div>

        <button type="submit" class="btn btn-primary w-100">Masuk</button>
    </form>
</div>

@endsection
