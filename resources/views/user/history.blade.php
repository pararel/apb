@extends('layout.user')

@section('btnRiwayat')
text-warning text-secondary fw-bold
@endsection

@section('content')
<div class="fitur riwayat p-2">
  <div id="postContainerKomunitas" class="overflow-y-auto" style="height: 60vh">
    @if ($histories->isEmpty())
      <div class="d-flex justify-content-center">
        <p class="text-secondary">Belum ada riwayat aktivitas apapun</p>
      </div>
    @else
      @foreach ($histories as $history)
      <div class="bg-white p-2 mt-2 me-1 shadow-sm">
        <p>{{$history->message}}</p>
        <div class="w-100 d-flex justify-content-between">
          <span class="text-secondary ">Action: {{$history->info}}</span>
          <span class="text-secondary ">{{$history->created_at}}</span>
        </div>
      </div>
      @endforeach
    @endif
  </div>
</div>
@endsection