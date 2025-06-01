@extends('layout.firebase_app')

@section('dashboard')
active
@endsection

@section('page')
Kelola Aplikasi
@endsection

@section('routeSettings')
{{route('firebaseSettings')}}
@endsection

@section('routeDashboard')
{{route('firebaseDashboard')}}
@endsection

@section('buttons')
<a class="btn-riwayat btn btn-transparent @yield('btnMasukan') text-secondary" href="{{route('firebaseDashboard')}}">
  Akun
</a>
<a class="btn-target btn btn-transparent @yield('btnBerita') text-secondary" href="{{route('firebaseNews')}}">
  Berita
</a>
@endsection

@section('content')
@yield('content')
@endsection

@section('script')
@yield('script')
@endsection

@section('style')
@yield('style')
@endsection