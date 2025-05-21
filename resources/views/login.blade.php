@extends('layouts.template')
@section('content')

<form action="/login" method="post" >
    {{-- untuk menghindari ada input dari luar --}}
    @csrf
<div class="mb-3">
  <label for="email" class="form-label">Email address</label>
  <input type="email"
         name="email"
         id="email"
         class="form-control @error('email') is-invalid @enderror"
         aria-describedby="emailHelp">
  <div id="emailHelp" class="form-text">We'll never share your email with anyone else.</div>

  @error('email')
    <small class="text-danger">{{ $message }}</small>
  @enderror
</div>

  <div class="mb-3">
    <label for="exampleInputPassword1" class="form-label">Password</label>
    <input type="password" name="password" class="form-control" id="exampleInputPassword1">
  </div>
  <div class="mb-3 form-check">
    <input type="checkbox" class="form-check-input" id="exampleCheck1">
    <label class="form-check-label" for="exampleCheck1">Check me out</label>
  </div>
  <button type="submit" class="btn btn-primary">Submit</button>
</form>


@endsection
