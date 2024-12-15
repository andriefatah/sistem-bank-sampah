@extends('layouts.app')

@section('title', 'Detail Nasabah')

@push('style')
    <!-- CSS Libraries -->
@endpush

@section('main')
    <div class="d-flex align-items-left align-items-md-center flex-column flex-md-row pt-2 pb-4">
        <div>
            <h3 class="fw-bold mb-3">Detail Nasabah</h3>
            <h6 class="op-7 mb-2">Di halaman ini Anda dapat melihat detail nasabah.</h6>
        </div>
        <div class="ms-md-auto mt-3 mt-md-0">
            <a href="{{ route('petugas.pengepul.index') }}" class="btn btn-secondary">
                <i class="fas fa-arrow-left me-1"></i> Kembali
            </a>
        </div>
    </div>

    <!-- Data Nasabah dan Saldo -->
    <div class="row">
        <div class="col-lg-6">
            <div class="card">
                <div class="card-header">
                    <div class="card-title">Data Nasabah</div>
                </div>
                <div class="card-body">
                    <table class="table table-borderless">
                        <tr>
                            <td><strong>Nama Nasabah</strong></td>
                            <td>:</td>
                            <td>{{ $nasabah->nama_lengkap }}</td>
                        </tr>
                        <tr>
                            <td><strong>NIK</strong></td>
                            <td>:</td>
                            <td>{{ $nasabah->nik }}</td>
                        </tr>
                        <tr>
                            <td><strong>No. HP</strong></td>
                            <td>:</td>
                            <td>{{ $nasabah->no_hp }}</td>
                        </tr>
                        <tr>
                            <td><strong>Email</strong></td>
                            <td>:</td>
                            <td>{{ $nasabah->email }}</td>
                        </tr>
                        <tr>
                            <td><strong>Alamat</strong></td>
                            <td>:</td>
                            <td>{{ $nasabah->alamat_lengkap }}</td>
                        </tr>
                    </table>
                </div>
            </div>
        </div>
        <div class="col-lg-6">
            <div class="card">
                <div class="card-header text-center">
                    <div class="card-title fw-bold">Saldo Tersedia</div>
                </div>
                <div class="card-body text-center">
                    <h1 class="display-4 text-success fw-bold">Rp{{ number_format($nasabah->saldo->saldo ?? 0, 2) }}</h1>
                </div>
            </div>
        </div>
    </div>

    <!-- Riwayat Transaksi Setoran -->
    <div class="row mt-4">
        <div class="col-lg-12">
            <div class="card">
                <div class="card-header">
                    <div class="card-title">Riwayat Transaksi Setoran</div>
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table table-hover table-bordered table-head-bg-primary">
                            <thead>
                                <tr>
                                    <th>No</th>
                                    <th>Kode Transaksi</th>
                                    <th>Tanggal</th>
                                    <th>Detail Sampah</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse ($riwayatSetoran as $index => $transaksi)
                                    <tr>
                                        <td>{{ $index + 1 }}</td>
                                        <td>{{ $transaksi->kode_transaksi }}</td>
                                        <td>{{ $transaksi->tanggal_transaksi }}</td>
                                        <td>
                                            <ul>
                                                @foreach ($transaksi->detailTransaksi as $detail)
                                                    <li>{{ $detail->sampah->nama_sampah }} - {{ $detail->berat_kg }} kg
                                                        (Rp{{ number_format($detail->harga_total, 2) }})
                                                    </li>
                                                @endforeach
                                            </ul>
                                        </td>
                                    </tr>
                                @empty
                                    <tr>
                                        <td colspan="4">
                                            <div class="text-center">Belum ada Transaksi.</div>
                                        </td>
                                    </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Riwayat Penarikan Saldo -->
    <div class="row mt-4">
        <div class="col-lg-12">
            <div class="card">
                <div class="card-header">
                    <div class="card-title">Riwayat Penarikan Saldo</div>
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table table-hover table-bordered table-head-bg-primary">
                            <thead>
                                <tr>
                                    <th>No</th>
                                    <th>Tanggal Pengajuan</th>
                                    <th>Jumlah</th>
                                    <th>Status</th>
                                    <th>Keterangan</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse ($riwayatPenarikan as $index => $penarikan)
                                    <tr>
                                        <td>{{ $index + 1 }}</td>
                                        <td>{{ $penarikan->tanggal_pengajuan }}</td>
                                        <td>Rp{{ number_format($penarikan->jumlah_pencairan, 2) }}</td>
                                        <td>{{ ucfirst($penarikan->status) }}</td>
                                        <td>{{ $penarikan->keterangan ?? '-' }}</td>
                                    </tr>
                                @empty
                                    <tr>
                                        <td colspan="5">
                                            <div class="text-center">Belum ada Transaksi Penarikan.</div>
                                        </td>
                                    </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@push('scripts')
    <!-- JS Libraies -->

    <!-- Page Specific JS File -->
@endpush
