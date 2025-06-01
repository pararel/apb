@extends('layout.app')

@section('page')
Pengaturan
@endsection

@section('settings')
active
@endsection

@section('routeSettings')
{{route('adminSettings')}}
@endsection

@section('routeDashboard')
{{route('adminDashboard')}}
@endsection

@section('content')
@include('layout/settings')
@endsection