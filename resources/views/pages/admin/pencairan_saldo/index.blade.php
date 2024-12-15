@extends('layouts.app')

@section('title', 'Pengajuan Tarik Saldo')

@push('style')
    <link rel="stylesheet" href="{{ asset('library/selectric/public/selectric.css') }}">
@endpush

@section('main')
    <div class="d-flex align-items-left flex-column flex-md-row pt-2 pb-4">
        <div>
            <h3 class="fw-bold mb-3">Permintaan Penarikan Saldo</h3>
            <h6 class="op-7 mb-2">Kelola permintaan penarikan saldo yang masuk.</h6>
        </div>
    </div>
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table table-hover table-bordered table-head-bg-primary">
                            <thead>
                                <tr>
                                    <th>No</th>
                                    <th>Tanggal Pengajuan</th>
                                    <th>Nama Nasabah</th>
                                    <th>Jumlah Penarikan</th>
                                    <th>Metode Pencairan</th>
                                    <th>No Rekening</th>
                                    <th>Status</th>
                                    <th style="width: 20%">Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse ($pencairanSaldo as $index => $pencairan)
                                    <tr>
                                        <td>{{ $pencairanSaldo->firstItem() + $index }}</td>
                                        <td>{{ \Carbon\Carbon::parse($pencairan->tanggal_pengajuan)->format('d-m-Y') }}</td>
                                        <td>{{ $pencairan->nasabah->nama_lengkap }}</td>
                                        <td>{{ number_format($pencairan->jumlah_pencairan, 0, ',', '.') }}</td>
                                        <td>{{ $pencairan->metode->nama_metode_pencairan }}</td>
                                        <td>{{ $pencairan->metode->no_rek }}</td>
                                        <td>
                                            <span
                                                class="badge bg-{{ match ($pencairan->status) {
                                                    'pending' => 'warning',
                                                    'diproses' => 'secondary',
                                                    'ditolak' => 'danger',
                                                    'selesai' => 'success',
                                                    default => 'secondary',
                                                } }}">
                                                {{ ucfirst($pencairan->status) }}
                                            </span>
                                        </td>
                                        <td>
                                            @if ($pencairan->status === 'pending')
                                                <form action="{{ route('admin.tarik-saldo.terima', $pencairan->id) }}"
                                                    method="POST" style="display: inline-block;">
                                                    @csrf
                                                    <button type="submit" class="btn btn-sm btn-primary mr-2"><i
                                                            class="fas fa-solid fa-check"></i> Terima</button>
                                                </form>
                                                <button type="button" class="btn btn-sm btn-danger" data-bs-toggle="modal"
                                                    data-bs-target="#modalTolak"
                                                    onclick="setRejectData({{ $pencairan->id }})">
                                                    <i class="fas fa-times-circle"></i> Tolak
                                                </button>
                                            @elseif ($pencairan->status === 'diproses')
                                                <form action="{{ route('admin.tarik-saldo.selesai', $pencairan->id) }}"
                                                    method="POST" style="display: inline-block;">
                                                    @csrf
                                                    <button type="submit" class="btn btn-success">Selesai</button>
                                                </form>
                                            @endif
                                        </td>
                                    </tr>
                                @empty
                                    <tr>
                                        <td colspan="8" class="text-center">Tidak ada data pencairan saldo.</td>
                                    </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>
                    <div class="float-right">
                        {{ $pencairanSaldo->withQueryString()->links() }}
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="modal fade" id="modalTolak" tabindex="-1" aria-labelledby="modalTolakLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <form id="formTolak" method="POST">
                    @csrf
                    <div class="modal-header">
                        <h5 class="modal-title" id="modalTolakLabel">Tolak Pengajuan</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <input type="hidden" name="id" id="tolakId">
                        <div class="form-group">
                            <label for="keterangan">Keterangan Penolakan</label>
                            <textarea name="keterangan" id="keterangan" class="form-control" rows="3" required></textarea>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
                        <button type="submit" class="btn btn-danger">Tolak</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection

@push('scripts')
    <script>
        function setRejectData(id) {
            const url = "{{ route('admin.tarik-saldo.tolak', ':id') }}".replace(':id', id);
            document.getElementById('formTolak').action = url;
            document.getElementById('tolakId').value = id;
        }
    </script>
@endpush
