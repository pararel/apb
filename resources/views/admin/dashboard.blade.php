@extends('layout.admin')

@section('btnMasukan')
text-warning text-secondary fw-bold
@endsection

@section('content')
<div class="p-2">
  <div class="container-fluid">
    <div class="card">
      <div class="card-body">
        <table id="datatablesSimple" class="table table-bordered table-striped">
          <thead>
            <tr>
              <th>Username</th>
              <th>Masukan</th>
            </tr>
          </thead>
          <tbody>
          @foreach ($feedbacks as $feedback)
            <tr>
            <td>{{ $feedback->user->username }}</td>
            <td>{{ $feedback->message }}</td>
            </tr>
            @endforeach
          </tbody>
        </table>
      </div>
    </div>
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
<script src="https://cdn.jsdelivr.net/npm/simple-datatables@7.1.2/dist/umd/simple-datatables.min.js" crossorigin="anonymous"></script>
@endsection