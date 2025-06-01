@extends('layout.admin')

@section('btnBerita')
text-warning text-secondary fw-bold
@endsection

@section('content')
<div class="container-fluid py-2 px-4">
  <form action="{{route('adminNews')}}" method="post" enctype="multipart/form-data">
    @csrf
    <div class="mb-3">
      <label for="title" class="form-label">Judul Berita</label>
      <input type="text" class="form-control" id="title" name="title" placeholder="Judul Berita" required>
    </div>
    <div class="row">
      <div class="col-6 mb-3">
        <label for="picture" class="form-label">Unggah Gambar</label>
        <input class="form-control" type="file"  name="picture" id="picture" required>
      </div>
      <div class="col-6">
        <label for="link" class="form-label">Sumber</label>
        <input type="text" class="form-control" name="link" id="link" placeholder="https://example-news.com/" required>
      </div>
    </div>
    <div class="mb-3">
      <label for="description" class="form-label">Deskripsi</label>
      <textarea class="form-control" id="description" name="description" rows="3"></textarea>
    </div>
    <button type="submit" class="btn btn-primary">Tambahkan</button>
  </form>
  <hr class="text-secondary" />
  @if ($news->isEmpty())
    <div class="d-flex justify-content-center">
    <p class="text-secondary">Belum ada berita yang dibuat</p>
    </div>
  @else
  @foreach ($news as $item)
    <div class="container-fluid bg-white p-2 mb-2 shadow-sm d-flex justify-content-between">
    <span class="">{{ $item->title }} ({{ $item->created_at }})</span>
    <span>
      <form action="{{ route('adminNewsDelete', $item->id) }}" method="POST" style="display:inline;">
      @csrf
      @method('DELETE')
      <button type="submit" class="btn btn-danger" onclick="return confirm('Apakah anda yakin ingin menghapus berita ini?')">
        <i class="far fa-trash-alt"></i>
      </button>
    </span>
    </div>
  @endforeach
  @endif
</>
@endsection