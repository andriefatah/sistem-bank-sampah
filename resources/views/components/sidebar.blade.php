<!-- Sidebar -->
<div class="sidebar sidebar-style-2">
    <div class="sidebar-logo">
        <!-- Logo Header -->
        <div class="logo-header">
            @if (auth()->user()->role == 'admin')
                <a href="{{ route('admin.dashboard') }}" class="logo">
                    <img src="{{ asset('assets/img/kaiadmin/logo_dark.svg') }}" alt="navbar brand" class="navbar-brand"
                        height="25">
                </a>
            @endif
            @if (auth()->user()->role == 'petugas')
                <a href="{{ route('petugas.dashboard') }}" class="logo">
                    <img src="{{ asset('assets/img/kaiadmin/logo_dark.svg') }}" alt="navbar brand" class="navbar-brand"
                        height="25">
                </a>
            @endif
            <div class="nav-toggle">
                <button class="btn btn-toggle toggle-sidebar">
                    <i class="gg-menu-right"></i>
                </button>
                <button class="btn btn-toggle sidenav-toggler">
                    <i class="gg-menu-left"></i>
                </button>
            </div>
            <button class="topbar-toggler more">
                <i class="gg-more-vertical-alt"></i>
            </button>
        </div>
        <!-- End Logo Header -->
    </div>
    <div class="sidebar-wrapper scrollbar scrollbar-inner">
        <div class="sidebar-content">
            <ul class="nav nav-primary">
                @if (auth()->user()->role == 'admin')
                    <!-- Dashboard -->
                    <li class="nav-item">
                        <a href="{{ route('admin.dashboard') }}">
                            <i class="fas fa-home"></i>
                            <p>Dashboard</p>
                        </a>
                    </li>

                    <!-- Data Master -->
                    <li class="nav-item">
                        <a data-bs-toggle="collapse" href="#data-master" class="collapsed" aria-expanded="false">
                            <i class="fas fa-database"></i>
                            <p>Data Master</p>
                            <span class="caret"></span>
                        </a>
                        <div class="collapse" id="data-master">
                            <ul class="nav nav-collapse">
                                <li>
                                    <a href="{{ route('admin.nasabah.index') }}">
                                        <span class="sub-item">Data Nasabah</span>
                                    </a>
                                </li>
                                <li>
                                    <a href="{{ route('admin.petugas.index') }}">
                                        <span class="sub-item">Data Petugas</span>
                                    </a>
                                </li>
                                <li>
                                    <a href="{{ route('admin.sampah.index') }}">
                                        <span class="sub-item">Data Sampah</span>
                                    </a>
                                </li>
                                <li>
                                    <a href="{{ route('admin.pengepul.index') }}">
                                        <span class="sub-item">Data Pengepul</span>
                                    </a>
                                </li>
                            </ul>
                        </div>
                    </li>

                    <!-- Manajemen Konten -->
                    <li class="nav-item">
                        <a data-bs-toggle="collapse" href="#manajemen-konten" class="collapsed" aria-expanded="false">
                            <i class="fas fa-file-alt"></i>
                            <p>Manajemen Konten</p>
                            <span class="caret"></span>
                        </a>
                        <div class="collapse" id="manajemen-konten">
                            <ul class="nav nav-collapse">
                                <li>
                                    <a href="{{ route('admin.banner.index') }}">
                                        <span class="sub-item">Data Banner</span>
                                    </a>
                                </li>
                                <li>
                                    <a href="{{ route('admin.artikel.index') }}">
                                        <span class="sub-item">Data Artikel</span>
                                    </a>
                                </li>
                            </ul>
                        </div>
                    </li>

                    <!-- Transaksi -->
                    <li class="nav-item">
                        <a data-bs-toggle="collapse" href="#transaksi" class="collapsed" aria-expanded="false">
                            <i class="fas fa-money-bill-wave"></i>
                            <p>Transaksi</p>
                            <span class="caret"></span>
                        </a>
                        <div class="collapse" id="transaksi">
                            <ul class="nav nav-collapse">
                                <li>
                                    <a href="{{ route('admin.transaksi.index') }}">
                                        <span class="sub-item">Transaksi Setoran</span>
                                    </a>
                                </li>
                                <li>
                                    <a href="{{ route('admin.tarik-saldo.index') }}">
                                        <span class="sub-item">Tarik Saldo</span>
                                    </a>
                                </li>
                                <li>
                                    <a href="{{ route('admin.pengiriman.index') }}">
                                        <span class="sub-item">Pengiriman Sampah</span>
                                    </a>
                                </li>
                            </ul>
                        </div>
                    </li>

                    <!-- Dashboard -->
                    <li class="nav-item">
                        <a href="{{ route('admin.laporan.index') }}">
                            <i class="fas fa-print"></i>
                            <p>Cetak Laporan</p>
                        </a>
                    </li>

                    <!-- Pengaturan -->
                    <li class="nav-item">
                        <a data-bs-toggle="collapse" href="#pengaturan" class="collapsed" aria-expanded="false">
                            <i class="fas fa-cogs"></i>
                            <p>Pengaturan</p>
                            <span class="caret"></span>
                        </a>
                        <div class="collapse" id="pengaturan">
                            <ul class="nav nav-collapse">
                                <li>
                                    <a href="{{ route('admin.token-whatsapp.index') }}">
                                        <span class="sub-item">Token WhatsApp</span>
                                    </a>
                                </li>
                                <li>
                                    <a href="{{ route('admin.aplikasi.index') }}">
                                        <span class="sub-item">Update APK</span>
                                    </a>
                                </li>
                                <li>
                                    <a href="{{ route('admin.tentang_kami.index') }}">
                                        <span class="sub-item">Tentang Kami</span>
                                    </a>
                                </li>
                            </ul>
                        </div>
                    </li>

                    <!-- Feedback -->
                    <li class="nav-item">
                        <a href="{{ route('admin.feedback.index') }}">
                            <i class="fas fa-comments"></i>
                            <p>Feedback</p>
                        </a>
                    </li>
                @endif
                @if (auth()->user()->role == 'petugas')
                    <!-- Dashboard -->
                    <li class="nav-item">
                        <a href="{{ route('petugas.dashboard') }}">
                            <i class="fas fa-home"></i>
                            <p>Dashboard</p>
                        </a>
                    </li>

                    <!-- Data Master -->
                    <li class="nav-item">
                        <a data-bs-toggle="collapse" href="#data-master" class="collapsed" aria-expanded="false">
                            <i class="fas fa-database"></i>
                            <p>Data Master</p>
                            <span class="caret"></span>
                        </a>
                        <div class="collapse" id="data-master">
                            <ul class="nav nav-collapse">
                                <li>
                                    <a href="{{ route('petugas.nasabah.index') }}">
                                        <span class="sub-item">Data Nasabah</span>
                                    </a>
                                </li>
                            </ul>
                        </div>
                    </li>

                    <!-- Transaksi -->
                    <li class="nav-item">
                        <a data-bs-toggle="collapse" href="#transaksi" class="collapsed" aria-expanded="false">
                            <i class="fas fa-money-bill-wave"></i>
                            <p>Transaksi</p>
                            <span class="caret"></span>
                        </a>
                        <div class="collapse" id="transaksi">
                            <ul class="nav nav-collapse">
                                <li>
                                    <a href="{{ route('petugas.transaksi.index') }}">
                                        <span class="sub-item">Transaksi Setoran</span>
                                    </a>
                                </li>
                            </ul>
                        </div>
                    </li>
                @endif

                <!-- Logout -->
                <li class="nav-item">
                    <a href="#"
                        onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                        <i class="fas fa-sign-out-alt"></i>
                        <p>Keluar</p>
                    </a>
                </li>
                <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                    @csrf
                </form>
            </ul>
        </div>
    </div>
</div>
<!-- End Sidebar -->
