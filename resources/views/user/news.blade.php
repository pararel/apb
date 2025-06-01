@extends('layout.user')

@section('btnBerita')
text-warning text-secondary fw-bold
@endsection

@section('content')
<div class="fitur berita p-2">
  @if ($news->isEmpty())
    <div class="d-flex justify-content-center">
    <p class="text-secondary">Belum ada berita yang dibuat</p>
    </div>
  @else
    <div class="overflow-y-auto d-flex justify-content-center" style="height: 90vh">
    <div class="container-fluid">
      <div class="row d-flex flex-wrap justify-content-center">
      @foreach ($news as $item)
      <div class="p-2 col-sm-6">
      <div class="bg-white shadow-sm">
      <img src="{{ asset('images/news/' . $item->picture) }}" alt="News Image" class="news-image w-100"
        style="height: 30vh;object-fit: cover;">
      <div class="p-3">
        <h5 class="">{{$item->title}}</h5>
        <p class="">{{$item->description}} </p>
        <a href="{{$item->link}}">Link
        Eksternal</a><br>
        <span class="text-secondary mt-2">{{$item->created_at}}</span>
      </div>
      </div>
      </div>
    @endforeach
      </div>
    </div>
    </div>
  @endif
</div>
@endsection