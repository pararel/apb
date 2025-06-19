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
      <div class="col-6 mb-3">
      <label for="category" class="form-label">Category</label>
      <input type="text" class="form-control" name="category" id="category" required>
      </div>
    </div>
    <div class="mb-3">
      <label for="content" class="form-label">Description</label>
      <textarea class="form-control" id="content" name="content" rows="3"></textarea>
    </div>
    <div class="row">
      <div class="col-6">
      <button type="submit" class="btn btn-primary mt-4">Tambahkan</button>
      </div>
    </div>
    </form>
    <hr class="text-secondary" />
    <div class="card">
    <div class="card-body">
      <table id="datatablesSimple" class="table table-bordered table-striped">
      <thead>
        <tr>
        <th>Judul</th>
        <th>Aksi</th>
        </tr>
      </thead>
      <tbody>
        @foreach ($newsList as $news)
      <tr>
      <td>
        {{ $news['title'] }}
      </td>
      <td>
        <form action="{{ route('adminNewsDelete', $news['uid']) }}" method="POST"
        onsubmit="return confirm('Are you sure you want to delete this news?');">
        @csrf
        @method('DELETE')
        <button type="submit" class="btn btn-sm btn-danger">Delete</button>
        </form>
      </td>

      </tr>
      @endforeach
      </tbody>
      </table>
    </div>
    </div>
  @endsection

  @section('script')
    <script>
    window.addEventListener('load', event => {
      // Simple-DataTables
      // https://github.com/fiduswriter/Simple-DataTables/wiki

      const datatablesSimple = document.getElementById('datatablesSimple');
      if (datatablesSimple) {
      new simpleDatatables.DataTable(datatablesSimple);
      }
    });
    </script>
    <script src="https://cdn.jsdelivr.net/npm/simple-datatables@7.1.2/dist/umd/simple-datatables.min.js"
    crossorigin="anonymous"></script>
  @endsection