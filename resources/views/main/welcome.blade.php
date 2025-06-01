<!DOCTYPE html>
<html>

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Home</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous" />
    <script src="https://kit.fontawesome.com/177edb1edd.js" crossorigin="anonymous"></script>
    <script src="https://code.jquery.com/jquery-3.7.1.js"></script>
    <style>
        /* Original Styles */
        footer div a,
        footer div a:visited {
            text-decoration: none;
            color: inherit;
        }

        footer {
            font-weight: 500;
            display: flex;
        }

        .nav-link {
            color: rgba(255, 255, 255, .55) !important;
        }

        .nav-link.active {
            color: rgba(255, 255, 255, .9) !important;
        }

        .hero-img {
            z-index: 1;
            height: fit-content;
            filter: brightness(50%);
            width: 100%;
            object-fit: cover;
        }

        hr.bg-warning {
            opacity: 1;
            height: 2px !important;
        }

        .service-icon {
            font-size: 70px;
            color: #212529;
        }

        .service-card {
            padding: 1rem;
            background: white;
            height: 100%;
        }

        .service-card p {
            font-size: 0.9rem;
        }

        .social-icons a {
            margin-right: 1rem;
        }

        .about-img {
            width: 500px;
            z-index: 1;
        }

        @media (max-width: 576px) {
            .about-img {
                width: 100%;
            }
        }

        /* Animation Keyframes */
        @keyframes fadeInUp {
            from {
                opacity: 0;
                transform: translateY(20px);
            }

            to {
                opacity: 1;
                transform: translateY(0);
            }
        }

        @keyframes slideInLeft {
            from {
                opacity: 0;
                transform: translateX(-100px);
            }

            to {
                opacity: 1;
                transform: translateX(0);
            }
        }

        @keyframes slideInRight {
            from {
                opacity: 0;
                transform: translateX(100px);
            }

            to {
                opacity: 1;
                transform: translateX(0);
            }
        }

        @keyframes zoomIn {
            from {
                opacity: 0;
                transform: scale(0.5);
            }

            to {
                opacity: 1;
                transform: scale(1);
            }
        }

        /* Animation Classes */
        .animate-fade-in-up {
            animation: fadeInUp 1s ease forwards;
        }

        .animate-slide-left {
            animation: slideInLeft 1s ease forwards;
        }

        .animate-slide-right {
            animation: slideInRight 1s ease forwards;
        }

        .animate-zoom {
            animation: zoomIn 0.8s ease forwards;
        }

        .service-card {
            transition: transform 0.3s ease, box-shadow 0.3s ease;
        }

        .service-card:hover {
            transform: translateY(-5px);
            box-shadow: 0 5px 15px rgba(0, 0, 0, 0.1);
        }

        .social-icons a {
            transition: transform 0.3s ease;
        }

        .social-icons a:hover {
            transform: translateY(-3px);
        }

        .nav-link {
            transition: color 0.3s ease;
        }

        .nav-link:hover {
            color: rgba(255, 255, 255, 1) !important;
        }
    </style>
</head>

<body class="bg-light">
    <header>
        <nav class="navbar navbar-expand-sm bg-dark fixed-top" data-bs-theme="dark">
            <div class="container-fluid">
                <a class="navbar-brand fw-bold animate-fade-in-up" href="#">
                    <img src="{{ asset('images/emonic_light.png') }}" style="height: 0.7cm;"/>
                    EMONIC
                </a>
                <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav">
                    <span class="navbar-toggler-icon"></span>
                </button>
                <div class="collapse navbar-collapse" id="navbarNav">
                    <ul class="navbar-nav ms-auto">
                        <li class="nav-item">
                            <a class="nav-link active animate-fade-in-up" style="animation-delay: 0.5s"
                                href="{{route('welcome')}}" aria-current="page">Home</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link animate-fade-in-up" style="animation-delay: 0.6s"
                                href="{{route('signup')}}">Sign Up</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link animate-fade-in-up" style="animation-delay: 0.7s"
                                href="{{route('login')}}">Login</a>
                        </li>
                    </ul>
                </div>
            </div>
        </nav>
    </header>

    <main class="mx-5">
        <div class="d-flex align-items-end" style="height: 400px">
            <img src="{{ asset('images/electricity-bg.jpg')}}" class="hero-img animate-zoom"
                style="animation-delay: 0.3s;" />
            <div class="position-absolute bottom-20 ms-3" style="z-index: 2">
                <h1>
                    <span class="text-warning fw-bold mt-6 animate-slide-left" style="animation-delay: 0.4s">Switch
                        Off,</span>
                    <br />
                    <span class="text-white fw-bold animate-slide-right" style="animation-delay: 0.6s">Save On!</span>
                </h1>
                <p class="text-white animate-fade-in-up" style="animation-delay: 0.8s">
                    Kelola penggunaan energi anda
                    <br />
                    sekarang juga!
                </p>
            </div>
        </div>

        <div class="d-flex mt-5">
            <div class="row">
                <div class="col-sm-6 d-flex justify-content-end">
                    <img src="{{ asset('images/hoki.jpg') }}" class="img-fluid about-img animate-slide-left"
                        style="animation-delay: 0.5s" />
                </div>
                <div class="col-sm-6 pt-2">
                    <h1 class="animate-slide-right" style="animation-delay: 0.5s">Tentang Kami</h1>
                    <hr class="bg-warning animate-slide-right" style="animation-delay: 0.6s" />
                    <div class="mt-5">
                        <p class="animate-fade-in-up" style="animation-delay: 0.7s">
                            kami adalah kumpulan mahasiswa universitas telkom yang gabut
                            kepikiran buat website mengenai monitoring energi. ini relate
                            kami ya ges karena kadang kami juga kesusahan dalam mengelola
                            pemakaian energi
                        </p>
                    </div>
                </div>
            </div>
        </div>

        <div class="container-fluid mt-5 bg-dark">
            <h1 class="text-white text-center py-5 animate-fade-in-up" style="animation-delay: 0.9s">Layanan Kami</h1>
            <div class="row justify-content-evenly text-center pb-5 px-2">
                <div class="col-sm-3">
                    <div class="service-card mb-2 animate-fade-in-up" style="animation-delay: 1s">
                        <i class="far fa-thumbs-up mt-2 service-icon"></i>
                        <h3 class="mt-2">Forum Diskusi</h3>
                        <p class="mt-2 text-start">
                            Kami menyediakan fasilitas ini agar para pengguna bisa saling sharing
                        </p>
                    </div>
                </div>
                <div class="col-sm-3">
                    <div class="service-card mb-2 animate-fade-in-up" style="animation-delay: 1.2s">
                        <i class="far fa-clock mt-2 service-icon"></i>
                        <h3 class="mt-2">Kelola Pemakaian</h3>
                        <p class="mt-2 text-start">
                            Pengguna dapat membatasi pemakaian menurut daya suatu alat elektronik yang digunakan
                        </p>
                    </div>
                </div>
                <div class="col-sm-3">
                    <div class="service-card mb-2 animate-fade-in-up" style="animation-delay: 1.4s">
                        <i class="far fa-newspaper mt-2 service-icon"></i>
                        <h3 class="mt-2">Berita</h3>
                        <p class="mt-2 text-start">
                            Berita memungkinkan penambahan wawasan atau pengetahuan yang relevan kepada pengguna
                        </p>
                    </div>
                </div>
            </div>
        </div>
    </main>

    <footer class="mt-5 container-fluid bg-dark">
        <div class="row d-flex justify-content-between mx-5 text-white py-5">
            <div class="col-sm-3 animate-fade-in-up" style="animation-delay: 1.6s">
                <h5 class="fw-bold">Energy Monitoring</h5>
            </div>
            <div class="col-sm-3 animate-fade-in-up" style="animation-delay: 1.7s">
                <h5 class="fw-bold mb-4">Alamat</h5>
                <p>
                    Jl. Telekomunikasi. 1, Terusan Buahbatu - Bojongsoang, Telkom
                    University, Sukapura, Kec. Dayeuhkolot, Kabupaten Bandung, Jawa
                    Barat 40257
                </p>
            </div>
            <div class="col-sm-3 animate-fade-in-up" style="animation-delay: 1.8s">
                <h5 class="fw-bold mb-4">Media Sosial</h5>
                <div class="social-icons">
                    <a href="https://instagram.com">
                        <i class="fab fa-instagram fs-2"></i>
                    </a>
                    <a href="https://facebook.com">
                        <i class="fab fa-facebook-f fs-2"></i>
                    </a>
                    <a href="https://tiktok.com">
                        <i class="fab fa-tiktok fs-2"></i>
                    </a>
                    <a href="https://linkedin.com">
                        <i class="fab fa-linkedin fs-2"></i>
                    </a>
                </div>
            </div>
        </div>
    </footer>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz"
        crossorigin="anonymous"></script>
</body>

</html>