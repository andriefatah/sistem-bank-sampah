<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
    <meta name="description" content="" />
    <meta name="author" content="" />
    <title>Sistem Informasi Manajemen Bank Sampah Desa Rendole Pati</title>
    <link rel="icon" type="image/x-icon" href="assets/favicon.ico" />
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.5.0/font/bootstrap-icons.css" rel="stylesheet" />
    <link rel="preconnect" href="https://fonts.gstatic.com" />
    <link href="https://fonts.googleapis.com/css2?family=Newsreader:ital,wght@0,600;1,600&amp;display=swap"
        rel="stylesheet" />
    <link
        href="https://fonts.googleapis.com/css2?family=Mulish:ital,wght@0,300;0,500;0,600;0,700;1,300;1,500;1,600;1,700&amp;display=swap"
        rel="stylesheet" />
    <link href="https://fonts.googleapis.com/css2?family=Kanit:ital,wght@0,400;1,400&amp;display=swap"
        rel="stylesheet" />
    <link href="{{ asset('assets/web/css/styles.css') }}" rel="stylesheet" />
</head>

<body id="page-top">
    <nav class="navbar navbar-expand-lg bg-success navbar-dark fixed-top shadow-sm" id="mainNav">
        <div class="container px-5">
            <a class="navbar-brand fw-bold" href="#page-top">BANK SAMPAH RENDOLE</a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarResponsive"
                aria-controls="navbarResponsive" aria-expanded="false" aria-label="Toggle navigation">
                Menu
                <i class="bi-list"></i>
            </button>
            <div class="collapse navbar-collapse" id="navbarResponsive">
                <ul class="navbar-nav text-white ms-auto me-4 my-3 my-lg-0">
                    <li class="nav-item"><a class="nav-link me-lg-3" href="/">Beranda</a></li>
                    <li class="nav-item"><a class="nav-link me-lg-3" href="#tentangKami">Tentang Kami</a></li>
                    <li class="nav-item"><a class="nav-link me-lg-3" href="#lokasiKami">Lokasi Kami</a></li>
                    <li class="nav-item"><a class="nav-link me-lg-3" href="{{ route('login') }}">Masuk Petugas</a></li>
                </ul>
            </div>
        </div>
    </nav>
    <!-- Mashead header-->
    <header class="masthead">
        <div class="container px-5">
            <div class="row gx-5 align-items-center">
                <div class="col-lg-6">
                    <!-- Mashead text and app badges-->
                    <div class="mb-5 mb-lg-0 text-center text-lg-start">
                        <h1 class="display-1 lh-1 mb-3">Bank Sampah Rendole Pati.</h1>
                        <p class="lead fw-normal text-muted mb-5">Sampah Bukan Akhir, Tapi Awal Perubahan: Mari Kelola
                            Bersama untuk Masa Depan yang Lebih Baik!</p>
                        <div class="d-flex flex-column flex-lg-row align-items-center">
                            <a class="" href="#!"><img
                                    src="{{ asset('assets/web/img/download_button.png') }}" class="img-fluid"
                                    width="150" alt="..." /></a>
                        </div>
                    </div>
                </div>
                <div class="col-sm-8 col-md-6">
                    <div class="px-5 px-sm-0">
                        <img class="img-fluid" style="max-width: 100%; height: auto;"
                            src="{{ asset('assets/web/img/hero_logo.png') }}" alt="..." />
                    </div>
                </div>
            </div>
        </div>
    </header>

    <!-- Quote/testimonial aside-->
    <aside class="text-center bg-success">
        <div class="container px-5">
            <div class="row gx-5 justify-content-center">
                <div class="col-xl-8">
                    <div class="h2 fs-1 text-white mb-4">"Bersama kita dapat mengubah sampah menjadi manfaat. Jadilah
                        bagian dari solusi!"</div>
                </div>
            </div>
        </div>
    </aside>
    <!-- Basic features section-->
    <section class="bg-light">
        <div class="container px-5">
            <div class="row gx-5 align-items-center justify-content-center justify-content-lg-between">
                <div class="col-12 col-lg-5">
                    <h2 class="display-4 lh-1 mb-4" id="#tentangKami">Siapa Kami?</h2>
                    <p class="small text-muted  mb-5 mb-lg-0">Bank Sampah Rendole Pati adalah lembaga yang berkomitmen
                        untuk meningkatkan kesadaran masyarakat tentang pentingnya pengelolaan sampah yang baik dan
                        berkelanjutan. Kami berfokus pada program pengumpulan, pengolahan, dan pemanfaatan sampah,
                        dengan tujuan mengurangi dampak lingkungan sekaligus memberikan manfaat ekonomi bagi masyarakat.
                    </p>
                    <br>
                    <p class="small text-muted  mb-5 mb-lg-0">
                        Kami percaya bahwa setiap individu dapat berkontribusi dalam menjaga kebersihan lingkungan.
                        Melalui kolaborasi dengan masyarakat, kami berusaha menciptakan lingkungan yang lebih bersih dan
                        sehat untuk generasi mendatang. Bergabunglah dengan kami dalam gerakan ini dan bersama-sama kita
                        wujudkan Pati yang lebih hijau!

                    </p>
                </div>
                <div class="col-sm-8 col-md-6">
                    <div class="px-5 px-sm-0">
                        <img class="img-fluid" style="max-width: 100%; height: auto;"
                            src="{{ asset('assets/web/img/bank_logo.png') }}" alt="..." />
                    </div>
                </div>
            </div>
        </div>
    </section>

    <section class="bg-white">
        <div class="container px-5">
            <div class="row gx-5 align-items-center justify-content-center justify-content-lg-between">
                <div class="col-12 col-lg-5">
                    <img class="img-fluid" style="max-width: 100%; height: auto;"
                        src="{{ asset('assets/web/img/location_logo.png') }}" alt="..." />
                </div>
                <div class="col-sm-8 col-md-6">
                    <div class="px-5 px-sm-0">
                        <h2 class="display-4 lh-1 mb-4" id="#lokasiKami">Lokasi Kami</h2>
                        <p class="small text-muted  mb-5 mb-lg-0">Bank Sampah Rendole Pati berlokasi di Desa [Nama
                            Desa], Pati, Jawa Tengah. Alamat lengkap kami adalah:
                        </p>
                        <br>
                        <p class="small text-muted  mb-5 mb-lg-0">
                            Jalan [Nama Jalan], No. [Nomor], Desa [Nama Desa], Pati, Jawa Tengah
                        </p>
                        <br>
                        <p class="small text-muted  mb-5 mb-lg-0">
                            Kami mengundang seluruh warga desa untuk berkunjung dan berpartisipasi dalam program-program
                            kami. Bersama-sama, kita dapat membuat perbedaan dalam pengelolaan sampah dan menciptakan
                            lingkungan yang lebih bersih dan sehat.
                        </p>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <footer class="bg-black text-center py-5">
        <div class="container px-5">
            <div class="text-white-50 small">
                <div class="mb-2">&copy; Sistem Informasi Manajemen Bank Sampah Desa Rendole Pati 2024. All Rights
                    Reserved.</div>
            </div>
        </div>
    </footer>
    <!-- Bootstrap core JS-->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js"></script>
    <!-- Core theme JS-->
    <script src="js/scripts.js"></script>
    <script src="https://cdn.startbootstrap.com/sb-forms-latest.js"></script>
</body>

</html>
