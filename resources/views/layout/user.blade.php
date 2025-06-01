@extends('layout.app')

@section('routeDashboard')
{{route('dashboard')}}
@endsection

@section('routeSettings')
{{route('settings')}}
@endsection

@section('dashboard')
active
@endsection

@section('nav')
<li class="nav-item">
  <a class="nav-link" href="{{route('faq')}}" aria-current="page">
    Bantuan
  </a>
</li>
@endsection

@section('page')
Beranda
@endsection

@section('buttons')
<a class="btn-utama btn btn-transparent @yield('btnUtama') text-secondary" href="{{route('dashboard')}}">
  Utama
</a>
<a class="btn-riwayat btn btn-transparent @yield('btnRiwayat') text-secondary" href="{{route('history')}}">
  Riwayat
</a>
<a class="btn-target btn btn-transparent @yield('btnTarget') text-secondary" href="{{route('target')}}">
  Target
</a>
<a class="btn-komunitas btn btn-transparent @yield('btnKomunitas') text-secondary" href="{{route('community')}}">
  Komunitas
</a>
<a class="btn-berita btn btn-transparent @yield('btnBerita') text-secondary" href="{{route('news')}}">
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