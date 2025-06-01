@extends('layout.app')

@section('page')
Pengaturan
@endsection

@section('settings')
active
@endsection

@section('routeSettings')
{{route('settings')}}
@endsection

@section('routeDashboard')
{{route('dashboard')}}
@endsection

@section('nav')
<li class="nav-item">
  <a class="nav-link" href="{{route('faq')}}" aria-current="page">
    Bantuan
  </a>
</li>
@endsection

@section('content')
@include('layout/settings')
@endsection