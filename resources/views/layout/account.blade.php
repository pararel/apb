<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>Energy Monitoring | @yield('title')</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet"
    integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous" />
  <script src="https://kit.fontawesome.com/177edb1edd.js" crossorigin="anonymous"></script>
  <script src="https://code.jquery.com/jquery-3.7.1.js"></script>
  <style>
    .card {
      max-width: 750px;
      max-height: 100vh;
      padding: 20px;
      border-radius: 24px;
    }
  </style>
</head>

<body class="bg-light">
  <header>
    <nav class="navbar navbar-expand-sm bg-dark fixed-top" data-bs-theme="dark">
      <div class="container-fluid">
        <a class="navbar-brand fw-bold animate-fade-in-up" href="#">
          <img src="{{ asset('images/emonic_light.png') }}" style="height: 0.7cm;" />
          EMONIC
        </a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav"
          aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation"> <span
            class="navbar-toggler-icon"></span> </button>
        <div class="collapse navbar-collapse" id="navbarNav">
          <ul class="navbar-nav ms-auto">
            <li class="nav-item">
              <a class="nav-link" href="{{route('welcome')}}"> Home </a>
            </li>
            <li class="nav-item">
              <a class="nav-link @yield('signup')" href="{{route('signup')}}" aria-current="page">
                Sign Up
              </a>
            </li>
            <li class="nav-item">
              <a class="nav-link @yield('login')" href="{{route('login')}}" aria-current="page">
                Login
              </a>
            </li>
          </ul>
        </div>
      </div>
    </nav>
  </header>
  <main>
    <div class="form d-flex justify-content-center align-items-center" style="height: 100vh">

      <div class="card shadow">
        <div class="row">
          <div class="col-md-7">
            <img src="images/electrician.png" alt="logo" class="img-fluid" style="max-height: 500px" />
          </div>
          <div class="col-md-5">
            <div class="card border-0">
              <h4 class="mt-1 mb-5">@yield('judulForm')</h4>
              @if (session('success'))
          <div class="p-2 text-success border border-success rounded-2 m-3" style="background-color: #aaffaa;">
          {{ session('success') }}
          </div>
        @endif
              @if ($errors->any())
          <div class="p-2 text-danger border border-danger rounded-2 m-3" style="background-color: #ffaaaa;">
          <ul>
            @foreach ($errors->all() as $error)
        <li>{{ $error }}</li>
      @endforeach
          </ul>
          </div>
        @endif
              @yield('form')
            </div>
          </div>
        </div>
      </div>
    </div>
  </main>
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"
    integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz"
    crossorigin="anonymous"></script>
</body>

</html>