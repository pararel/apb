@extends('layout.app')

@section('dashboard')
active
@endsection

@section('page')
Admin
@endsection

@section('routeSettings')
{{route('adminSettings')}}
@endsection

@section('routeDashboard')
{{route('adminDashboard')}}
@endsection

@section('buttons')
<a class="btn-riwayat btn btn-transparent @yield('btnMasukan') text-secondary" href="{{route('adminDashboard')}}">
  Masukan
</a>
<a class="btn-target btn btn-transparent @yield('btnBerita') text-secondary" href="{{route('adminNews')}}">
  Berita
</a>
<a class="btn-komunitas btn btn-transparent @yield('btnKomunitas') text-secondary" href="{{route('adminCommunity')}}">
  Komunitas
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