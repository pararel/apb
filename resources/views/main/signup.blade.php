@extends('layout.account')

@section('title')
Sign Up
@endsection

@section('signup')
active
@endsection

@section('judulForm')
Buat Akun
@endsection

@section('form')
<style>
  @keyframes fadeUp {
    0% {
      opacity: 0;
      transform: translateY(30px);
    }
    100% {
      opacity: 1;
      transform: translateY(0);
    }
  }

  .fade-up {
    animation: fadeUp 1s ease-out;
  }
</style>

<form action="{{ route('signup') }}" method="POST" class="fade-up">
  @csrf
  <div>
    <input class="form-control mb-2 rounded-5" type="text" id="name" name="name" value="{{ old('name') }}" placeholder="Nickname" required>
  </div>
  <div>
    <input class="form-control mb-2 rounded-5" type="text" id="username" name="username" value="{{ old('username') }}" placeholder="Username" required>
  </div>
  <div>
    <input class="form-control mb-2 rounded-5" type="email" id="email" name="email" value="{{ old('email') }}" placeholder="Email" required>
  </div>
  <div>
    <input class="form-control mb-3 rounded-5" type="password" id="password" name="password" placeholder="Password" required>
  </div>
  <button type="submit" class="btn btn-warning my-3 w-100 rounded-5">
    Buat Akun Saya
  </button>
  <p class="mb-2 d-flex justify-content-center">
    Sudah punya akun?
    <a href="{{route('login')}}"> Login </a>
  </p>
</form>
@endsection
