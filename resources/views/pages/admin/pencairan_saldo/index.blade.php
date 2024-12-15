@extends('layouts.app')

@section('title', 'Pengajuan Tarik Saldo')

@push('style')
    <!-- CSS Libraries -->
    <link rel="stylesheet" href="{{ asset('library/selectric/public/selectric.css') }}">
@endpush

@section('main')
    <div class="d-flex align-items-left align-items-md-center flex-column flex-md-row pt-2 pb-4">
        <div>
            <h3 class="fw-bold mb-3">Permintaan Penarikan Saldo</h3>
            <h6 class="op-7 mb-2">Anda dapat mengelola permintaan penarikan saldo yang masuk.</h6>
        </div>
    </div>
    <div class="row">
        <div class="col-12">
            <div class="card">

                <div class="card-body">

                    <div class="clearfix mb-3"></div>

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
                                    <th>Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($pencairanSaldo as $index => $pencairan)
                                    <tr>
                                        <td>{{ $pencairanSaldo->firstItem() + $index }}</td>
                                        <td>{{ $pencairan->tanggal_pengajuan->format('d-m-Y H:i') }}</td>
                                        <td>{{ $pencairan->nasabah->nama_lengkap }}</td>
                                        <td>{{ number_format($pencairan->jumlah_pencairan, 0, ',', '.') }}</td>
                                        <td>{{ $pencairan->metode->nama_metode }}</td>
                                        <td>{{ $pencairan->no_rek }}</td>
                                        <td>
                                            <form action="{{ route('admin.tarik-saldo.setujui', $pencairan->id) }}"
                                                method="POST" style="display:inline;">
                                                @csrf
                                                <button type="submit" class="btn btn-success"
                                                    onclick="return confirm('Apakah Anda yakin ingin menyetujui pengajuan ini?')">Setujui</button>
                                            </form>

                                            <!-- Tombol untuk memicu modal -->
                                            <button type="button" class="btn btn-danger" data-toggle="modal"
                                                data-target="#modalTolak" onclick="setRejectData({{ $pencairan->id }})">
                                                Tolak
                                            </button>
                                        </td>
                                    </tr>
                                @endforeach
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
    <div class="modal fade" id="modalTolak" tabindex="-1" role="dialog" aria-labelledby="modalTolakLabel"
        aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <form id="formTolak" method="POST">
                    @csrf
                    <div class="modal-header">
                        <h5 class="modal-title" id="modalTolakLabel">Tolak Pengajuan</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <input type="hidden" name="id" id="tolakId">
                        <div class="form-group">
                            <label for="keterangan">Keterangan Penolakan</label>
                            <textarea name="keterangan" id="keterangan" class="form-control" rows="3" required></textarea>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Batal</button>
                        <button type="submit" class="btn btn-danger">Tolak</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

@endsection

@push('scripts')
    <script>
        // Fungsi untuk mengisi ID pengajuan ke dalam modal
        function setRejectData(id) {
            const url = "{{ route('admin.tarik-saldo.tolak', ':id') }}".replace(':id', id);
            document.getElementById('formTolak').action = url;
            document.getElementById('tolakId').value = id;
        }
    </script>
@endpush
