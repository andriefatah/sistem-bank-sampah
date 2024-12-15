@extends('layouts.app')

@section('title', 'Dashboard Petugas')

@push('style')
    <!-- CSS Libraries -->
@endpush

@section('main')
    <div class="d-flex align-items-left align-items-md-center flex-column flex-md-row pt-2 pb-4">
        <div>
            <h3 class="fw-bold mb-3">Dashboard Petugas</h3>
            <h6 class="op-7 mb-2">Ringkasan Data dan Tugas Harian</h6>
        </div>
    </div>
    <div class="row">
        <div class="col-sm-6 col-md-3">
            <div class="card card-stats card-round">
                <div class="card-body">
                    <div class="row align-items-center">
                        <div class="col-icon">
                            <div class="icon-big text-center icon-info bubble-shadow-small">
                                <i class="fas fa-recycle"></i>
                            </div>
                        </div>
                        <div class="col col-stats ms-3 ms-sm-0">
                            <div class="numbers">
                                <p class="card-category">Total Nasabah</p>
                                <h4 class="card-title">{{ $totalNasabah }}</h4>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-sm-6 col-md-3">
            <div class="card card-stats card-round">
                <div class="card-body">
                    <div class="row align-items-center">
                        <div class="col-icon">
                            <div class="icon-big text-center icon-warning bubble-shadow-small">
                                <i class="fas fa-file-invoice"></i>
                            </div>
                        </div>
                        <div class="col col-stats ms-3 ms-sm-0">
                            <div class="numbers">
                                <p class="card-category">Total Setoran Hari Ini</p>
                                <h4 class="card-title">{{ $totalTransaksiHariIni }}</h4>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-sm-6 col-md-3">
            <div class="card card-stats card-round">
                <div class="card-body">
                    <div class="row align-items-center">
                        <div class="col-icon">
                            <div class="icon-big text-center icon-primary bubble-shadow-small">
                                <i class="fas fa-box"></i>
                            </div>
                        </div>
                        <div class="col col-stats ms-3 ms-sm-0">
                            <div class="numbers">
                                <p class="card-category">Jumlah Sampah Hari Ini</p>
                                <h4 class="card-title">{{ $totalSampahHariIni }} Kg</h4>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-sm-6 col-md-3">
            <div class="card card-stats card-round">
                <div class="card-body">
                    <div class="row align-items-center">
                        <div class="col-icon">
                            <div class="icon-big text-center icon-success bubble-shadow-small">
                                <i class="fas fa-wallet"></i>
                            </div>
                        </div>
                        <div class="col col-stats ms-3 ms-sm-0">
                            <div class="numbers">
                                <p class="card-category">Saldo Tabungan Nasabah</p>
                                <h4 class="card-title">Rp {{ number_format($totalOmzetHariIni, 0, ',', '.') }}</h4>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="row">
        <div class="col-lg-6">
            <div class="card">
                <div class="card-header">
                    <h4>Daftar 10 Nasabah Terbaik Bulanan</h4>
                </div>
                <div class="card-body">
                    @if ($nasabahTerbaik->isEmpty())
                        <p>Belum ada nasabah yang masuk</p>
                    @else
                        <table class="table table-hover table-bordered table-head-bg-primary">
                            <thead>
                                <tr>
                                    <th>Nama Nasabah</th>
                                    <th>Total Sampah</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($nasabahTerbaik as $index => $nasabah)
                                    @if ($nasabah->transaksi->sum('total_sampah') > 0)
                                        <!-- Mengecek jika total sampah > 0 -->
                                        <tr>
                                            <td>{{ $nasabah->nama_lengkap }}</td>
                                            <td>{{ $nasabah->transaksi->sum('total_sampah') }}</td>
                                        </tr>
                                    @endif
                                @endforeach
                            </tbody>
                        </table>
                    @endif
                </div>
            </div>
        </div>
    </div>

@endsection

@push('scripts')
    <!-- JS Libraries -->

    <!-- Page Specific JS File -->
@endpush
