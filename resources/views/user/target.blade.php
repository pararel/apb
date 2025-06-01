@extends('layout.user')

@section('btnTarget')
text-warning text-secondary fw-bold
@endsection

@section('content')
<div class="py-2 px-4">
  <form method="post" action="{{route('targetStore')}}">
    @csrf
    <table>
      <tr>
        <td>
          <label for="type" class="">Golongan Rumah Tangga:</label>
        </td>
        <td>
          <select class=" w-100" name="type" id="type" required>
            <option value="a">R-1/ TR daya 900 VA</option>
            <option value="b">R-1/ TR daya 1.300 VA</option>
            <option value="c">R-1/ TR daya 2.200 VA</option>
            <option value="d">
              R-2/ TR daya 3.500-5.500 VA
            </option>
            <option value="e">
              R-3/ TR daya 6.600 VA ke atas
            </option>
            <option value="f">
              B-2/ TR daya 6.600 VA-200 kVA
            </option>
            <option value="g">
              B-3/ Tegangan Menengah (TM) daya di atas 200 kVA
            </option>
            <option value="h">
              I-3/ TM daya di atas 200 kVA
            </option>
            <option value="i">
              I-4/ Tegangan Tinggi (TT) daya 30.000 kVA ke atas
            </option>
            <option value="j">
              P-1/ TR daya 6.600 VA-200 kVA
            </option>
            <option value="k">
              P-2/ TM daya di atas 200 kVA
            </option>
            <option value="l">
              P-3/ TR untuk penerangan jalan umum
            </option>
            <option value="m">L/ TR, TM, TT</option>
          </select>
        </td>
      </tr>
      <tr>
        <td>
          <label for="parameter" class="">Parameter target:</label>
        </td>
        <td>
          <select class="" name="parameter" id="parameter" required>
            <option value="power">
              Daya Listrik (kWh)
            </option>
            <option value="cost">Biaya Listrik (Rp)</option>
          </select>
        </td>
      </tr>
      <tr>
        <td>
          <label for="start" class="">Waktu mulai:</label>
        </td>
        <td>
          <input type="date" class="" name="start" id="start" required />
        </td>
      </tr>
      <tr>
        <td>
          <label for="end" class="">Waktu akhir:</label>
        </td>
        <td>
          <input type="date" class="" name="end" id="end" required />
        </td>
      </tr>
      <tr>
        <td>
          <label for="value" class="">Nilai target:</label>
        </td>
        <td>
          <input type="text" class="" name="value" id="value" inputmode="numeric"
            oninput="this.value = this.value.replace(/[^0-9.]/g, '').replace(/(\..*)\./g, '$1')" required />
        </td>
      </tr>
    </table>
    <button type="submit" class="btn btn-primary mt-3">
      Tambahkan
    </button>
  </form>
  <hr class="text-secondary" />
  @if ($targets->isEmpty())
    <div class="d-flex justify-content-center">
    <p class="text-secondary">Belum ada target yang dibuat</p>
    </div>
  @else
    <div class="overflow-y-auto d-flex justify-content-center" style="height: 90vh">
    <div class="container-fluid">
      <div class="row d-flex justify-content-center text-center">
      @foreach ($targets as $target)
      <div class="p-1 col-md-4">
      <div class="bg-white shadow">
      <h3>Target #{{$target->id}}</h3>
      @if ($target->countDays == 0)
      <span>input pemakaian anda di bawah!</span>
      <div class="d-flex justify-content-center">
      <div class="progress-circle my-2" id="progressCircle" data-value="0" style="--value: ">
      <span class="text-secondary fs-1 fw-bold" id="progressText">0%</span>
      </div>
      </div>
    @elseif ($target->usage / $target->countDays < $target->average)
      <span>Pemakaian hemat, pertahankan!</span>
      <div class="d-flex justify-content-center">
      <div class="progress-circle my-2" id="progressCircle"
      data-value="{{($target->usage / $target->countDays) / $target->average}}"
      style="--value: {{number_format(100 * ($target->usage / $target->countDays) / $target->average, 2)}}%; background: conic-gradient(#28a745 var(--value), #e9ecef 0);">
      <span class="text-success fs-1 fw-bold"
      id="progressText">{{round(100 * ($target->usage / $target->countDays) / $target->average)}}%</span>
      </div>
      </div>
    @else
      <span>Pemakaian boros, berhematlah!</span>
      <div class="d-flex justify-content-center">
      <div class="progress-circle my-2" id="progressCircle"
      data-value="{{($target->usage / $target->countDays) / $target->average}}"
      style="--value: {{number_format(100 * ($target->usage / $target->countDays) / $target->average, 2)}}%; background: conic-gradient(#dc3545 var(--value), #e9ecef 0);">
      <span class="text-danger fs-1 fw-bold"
      id="progressText">{{round(100 * ($target->usage / $target->countDays) / $target->average)}}%</span>
      </div>
      </div>
    @endif
      <div class="text-start mx-2">
        <span>Target total: {{$target->value}} kWh</span><br>
        <span>Target harian: {{$target->average}} kWh/hari</span><br>
        <span>Waktu: {{$target->start}} - {{$target->end}}</span><br>
        <span>Progres: {{$target->countDays}}/{{$target->days}} hari ({{$target->usage}} kWh)</span><br>
        <span>Input harian</span><br>
        @if ($target->countDays < $target->days)
      <form action="{{ route('targetUpdate', $target->id) }}" method="POST">
      @csrf
      @method('PATCH')
      <input type="text" class="" name="usage" id="usage" inputmode="numeric" class="w-100"
      oninput="this.value = this.value.replace(/[^0-9.]/g, '').replace(/(\..*)\./g, '$1')" required />
      <button type="submit" class="btn btn-transparent">
      <i class="fas fa-check-square fs-3 text-primary"></i>
      </button>
      </form>
      <form action="{{ route('targetDestroy', $target->id) }}" method="POST" style="display:inline;">
      @csrf
      @method('DELETE')
      <button type="submit" class="btn btn-danger mb-2"
      onclick="return confirm('Apakah anda yakin ingin menghapus target ini?')">
      <i class="far fa-trash-alt"></i></button>
      </form>
    @else
    <input type="text" inputmode="numeric"
    oninput="this.value = this.value.replace(/[^0-9.]/g, '').replace(/(\..*)\./g, '$1')" disabled />
    <button class="btn btn-transparent border border-white" disabled>
    <i class="fas fa-check-square fs-3 text-primary"></i>
    </button><br>
    <button class="btn btn-danger mb-2" disabled>
    <i class="far fa-trash-alt"></i>
    </button>
  @endif

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