@extends('layout.admin')

@section('btnBerita')
text-warning text-secondary fw-bold
@endsection

@section('content')
<div class="container-fluid py-2 px-4">
  <form action="{{route('adminNews')}}" method="post" enctype="multipart/form-data">
    @csrf
    <div class="mb-3">
      <label for="title" class="form-label">Title</label>
      <input type="text" class="form-control" id="title" name="title" placeholder="Judul Berita" required>
    </div>
    <div class="row">
      <div class="col-6 mb-3">
        <label for="imageUrl" class="form-label">Image</label>
        <input type="text" class="form-control" name="imageUrl" id="imageUrl" placeholder="Use URL for image" required>
      </div>
      <div class="col-6">
        <label for="sourceUrl" class="form-label">Source</label>
        <input type="text" class="form-control" name="sourceUrl" id="sourceUrl" placeholder="https://example-news.com/" required>
      </div>
    </div>
    <div class="mb-3">
      <label for="content" class="form-label">Description</label>
      <textarea class="form-control" id="content" name="content" rows="3"></textarea>
    </div>
    <div class="row">
      <div class="col-6 mb-3">
        <label for="subtitle" class="form-label">Subtitle</label>
        <input type="text" class="form-control" name="subtitle" id="subtitle" required>
      </div>
      <div class="col-6 mb-3">
        <label for="subtitleContent" class="form-label">Subtitle Content</label>
        <input type="text" class="form-control" name="subtitleContent" id="subtitleContent" required>
      </div>
    </div>
    <div class="row">
      <div class="col-6 mb-3">
        <label for="category" class="form-label">Category</label>
        <input type="text" class="form-control" name="category" id="category" required>
      </div>
      <div class="col-6">
        <button type="submit" class="btn btn-primary mt-4">Tambahkan</button>
      </div>
    </div>
  </form>
  <hr class="text-secondary" />
@endsection