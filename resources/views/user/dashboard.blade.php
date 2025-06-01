@extends('layout.user')

@section('btnUtama')
text-warning text-secondary fw-bold
@endsection

@section('content')
<div class="p-2">
  <div class="d-flex flex-wrap justify-content-center">
    <div class="bg-white m-2 rounded-5 d-flex flex-column justify-content-between text-center shadow"
      style="flex-basis: 45vh; flex-grow:1;">
      <div class="px-3 pt-3">
        <h3 class="">Target</h3>
        <span
          class="">{{ $latestTarget ? 'Target #' . $latestTarget->id . ' (Progres ' . $latestTarget->countDays . '/' . $latestTarget->days . ' hari)' : 'Belum ada target yang aktif.' }}</span>
        @if ($latestTarget)
      @if ($latestTarget->countDays == 0)
      <div class="d-flex justify-content-center mt-3">
      <div class="progress-circle my-2" id="progressCircle" data-value="0" style="--value: ">
      <span class="text-secondary fs-1 fw-bold" id="progressText">0%</span>
      </div>
      </div>
    @elseif ($latestTarget->usage / $latestTarget->countDays < $latestTarget->average)
      <div class="d-flex justify-content-center mt-3">
      <div class="progress-circle my-2" id="progressCircle"
      data-value="{{($latestTarget->usage / $latestTarget->countDays) / $latestTarget->average}}"
      style="--value: {{number_format(100 * ($latestTarget->usage / $latestTarget->countDays) / $latestTarget->average, 2)}}%; background: conic-gradient(#28a745 var(--value), #e9ecef 0);">
      <span class="text-success fs-1 fw-bold"
        id="progressText">{{round(100 * ($latestTarget->usage / $latestTarget->countDays) / $latestTarget->average)}}%</span>
      </div>
      </div>
    @else
      <div class="d-flex justify-content-center mt-3">
      <div class="progress-circle my-2" id="progressCircle"
      data-value="{{($latestTarget->usage / $latestTarget->countDays) / $latestTarget->average}}"
      style="--value: {{number_format(100 * ($latestTarget->usage / $latestTarget->countDays) / $latestTarget->average, 2)}}%; background: conic-gradient(#dc3545 var(--value), #e9ecef 0);">
      <span class="text-danger fs-1 fw-bold"
        id="progressText">{{round(100 * ($latestTarget->usage / $latestTarget->countDays) / $latestTarget->average)}}%</span>
      </div>
      </div>
    @endif
    @else
    <div class="d-flex justify-content-center mt-3">
      <div class="progress-circle my-2" id="progressCircle" data-value="0" style="--value: ">
      <span class="text-secondary fs-1 fw-bold" id="">?</span>
      </div>
    </div>
  @endif
      </div>
      <a class="btn btn-warning m-3 rounded-5 shadow-sm" href="{{route('target')}}">
        {{ $latestTarget ? 'Lanjutkan Progres' : 'Buat Target Baru' }}
      </a>
    </div>
    <div class="bg-white m-2 rounded-5 d-flex flex-column justify-content-between text-center shadow"
      style="flex-basis: 45vh; flex-grow:1;">
      <div class="px-3 pt-3">
        <h3 class="">Komunitas</h3>
        <span
          class="">{{ $latestPost ? 'Ada unggahan terbaru dari @' . $latestPost->account->username : 'Belum ada unggahan dari yang lain.' }}
        </span><br>
        <img
          src="{{ $latestPost ? asset('images/profiles/' . $latestPost->account->picture) : asset('images/profiles/' . Auth::user()->picture) }}"
          alt="Account Image" class=" mt-4" style="border-radius: 100%; object-fit: cover; max-height: 175px; width: 175px;">
      </div>
      <a class="btn btn-warning m-3 rounded-5 shadow-sm" href="{{route('community')}}">
        {{ $latestPost ? 'Lihat Unggahan' : 'Buat Unggahan' }}
      </a>
    </div>
    <div class="bg-white m-2 rounded-5 d-flex flex-column justify-content-between text-center shadow"
      style="flex-basis: 45vh; flex-grow:1;">
      <div class="px-3 pt-3">
        <h3 class="">Berita</h3>
        <span class="">{{ $latestNews ? $latestNews->title : 'Belum ada berita saat ini.' }}</span>
        @if ($latestNews)
      <img src="{{ asset('images/news/' . $latestNews->picture) }}" alt="News Image" class="news-image w-100 mt-2" style="height:30vh;object-fit: cover;">
    @endif
      </div>
      <a class="btn btn-warning m-3 rounded-5 shadow-sm" href="{{route('news')}}">
        {{ $latestNews ? 'Lihat Lebih Lanjut' : 'Pantau Terus' }}
      </a>
    </div>
  </div>
</div>
@endsection

@section('style')
<style>
  .progress-circle {
    position: relative;
    width: 50%;
    padding-bottom: 50%;
    border-radius: 50%;
    background: conic-gradient(#007bff var(--value), #e9ecef 0);
  }

  .progress-circle::before {
    content: '';
    position: absolute;
    top: 10%;
    left: 10%;
    width: 80%;
    height: 80%;
    border-radius: 50%;
    background: white;
  }

  .progress-circle span {
    position: absolute;
    top: 50%;
    left: 50%;
    transform: translate(-50%, -50%);
    font-size: 1.5em;
    font-weight: bold;
  }
</style>
@endsection

@section('script')
<script>
  document.addEventListener('DOMContentLoaded', function () {
    let progressCircle = document.getElementById('progressCircle');
    let progressText = document.getElementById('progressText');
    let progressValue = progressCircle.getAttribute('data-value');

    let progressPercentage = (parseFloat(progressValue) * 100).toFixed(0);

    progressCircle.style.setProperty('--value', `${progressPercentage}%`);
    progressText.textContent = `${progressPercentage}%`;
  });
</script>
@endsection