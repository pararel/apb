@extends('layout.app')

@section('page')
Bantuan
@endsection

@section('routeDashboard')
{{route('dashboard')}}
@endsection

@section('routeSettings')
{{route('settings')}}
@endsection

@section('nav')
<li class="nav-item">
  <a class="nav-link active" href="{{route('faq')}}" aria-current="page">
    Bantuan
  </a>
</li>
@endsection

@section('content')
<section class="bantuan px-4">
  <div class="">
    <form action="{{route('faq')}}" method="post">
      @csrf
      <div class="mt-3">
        <label for="message"> Masukan atau pertanyaan </label>
        <br />
        <textarea id="message" name="message" class="bg-light" rows="3" cols="50"
          required>{{ old('message')}}</textarea><br />
        <button type="submit" class="btn btn-warning">Kirim</button>
      </div>
    </form>
    <h3 class="mt-4">Pertanyaan Umum</h3>
    <div class="">
      <a class="toggle-button" data-toggle="collapse" href="#description1" role="button" aria-expanded="false"
        aria-controls="description1"> <i class="fas fa-chevron-right" id="icon1"></i> Mengapa banyak bug ditemukan
        disini? </a>
      <div class="collapse mt-3" id="description1">
        <div class="card card-body"> Karena ini peluncuran pertama dari aplikasi ini. Jadi banyak bug yang muncul dari
          berbagai aspek. Laporkan segera di halaman bantuan jika menemukan bug atau lainnya. </div>
      </div> <br><a class="toggle-button mt-3" data-toggle="collapse" href="#description2" role="button"
        aria-expanded="false" aria-controls="description2"> <i class="fas fa-chevron-right" id="icon2"></i> Bagaimana
        cara mengubah ke tema gelap? </a>
      <div class="collapse mt-3" id="description2">
        <div class="card card-body">
          <ul>
            <li>Cari ekstensi "Dark Reader" di mesin telusur atau langsung ke tautan berikut:
              <a href="https://darkreader.org/">https://darkreader.org/</a>
            </li>
            <li>
              Pilih tombol "Dark Reader for" menyesuaikan dengan mesin telusur anda.
            </li>
            <li>
              Tambahkan ekstensi ke mesin telusur anda.
            </li>
            <li>
              Di tempat ekstensi (biasanya di sebelah kanan bar search), klik ikon Dark Reader dan klik tombol "ON".
            </li>
          </ul>
        </div>
      </div>
    </div>
    <h6 class="mt-5 mb-4">Untuk informasi lebih lanjut, hubungi kami:</h6>
    <div class="d-flex">
      <i class="fas fa-map-marker-alt fs-5"></i>
      <p class="ms-2">Jl. Telekomunikasi. 1, Terusan Buahbatu - Bojongsoang, Telkom
        University, Sukapura, Kec. Dayeuhkolot, Kabupaten Bandung, Jawa
        Barat 40257</p>
    </div>
    <div class="d-flex">
      <a href="https://instagram.com/farell.hnc">
        <i class="fab fa-instagram fs-5"></i>
      </a>
      <p class="ms-2">Farell Rizky Swandi</p>
    </div>
    <div class="d-flex">
      <a href="https://instagram.com/agungpande">
        <i class="fab fa-instagram fs-5"></i>
      </a>
      <p class="ms-2">Pande Made Agung Dananjaya</p>
    </div>
    <div class="d-flex">
      <a href="https://instagram.com/ben_caessar">
        <i class="fab fa-instagram fs-5"></i>
      </a>
      <p class="ms-2">Benjamin Caessar Hasudungan</p>
    </div>
    <div class="d-flex">
      <a href="https://instagram.com/shafa.sp">
        <i class="fab fa-instagram fs-5"></i>
      </a>
      <p class="ms-2">Shafa Salma Permana</p>
    </div>
    <div class="d-flex">
      <a href="https://instagram.com/ameliaftnv">
        <i class="fab fa-instagram fs-5"></i>
      </a>
      <p class="ms-2">Amelia Fitri Novianti</p>
    </div>
  </div>
</section>
@endsection

@section('style')
<style>
  i,
  i:visited,
  .toggle-button {
    text-decoration: none;
    color: black;
  }
</style>
@endsection

@section('script')
<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.3/dist/umd/popper.min.js"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
<script>
  $('.toggle-button').click(function () { var icon = $(this).find('i'); var isExpanded = $(this).attr('aria-expanded') === 'true'; icon.toggleClass('fa-chevron-right', isExpanded); icon.toggleClass('fa-chevron-down', !isExpanded); });
</script>
@endsection