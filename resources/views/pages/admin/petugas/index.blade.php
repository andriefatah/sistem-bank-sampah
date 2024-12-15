@extends('layouts.app')

@section('title', 'Petugas')

@push('style')
    <!-- CSS Libraries -->
@endpush

@section('main')
    <div class="d-flex align-items-left align-items-md-center flex-column flex-md-row pt-2 pb-4">
        <div>
            <h3 class="fw-bold mb-3">Manajem Aplikasi</h3>
            <h6 class="op-7 mb-2">
                Di sini, Anda dapat mengelola versi aplikasi Android untuk bank sampah.
            </h6>
        </div>
        <div class="ms-md-auto py-2 py-md-0">
            <div class="section-header-button">
                <a href="{{ route('admin.petugas.create') }}" class="btn btn-primary btn-round">Tambah Petugas</a>
            </div>
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
                                    <th>#</th>
                                    <th>Nama</th>
                                    <th>Email</th>
                                    <th>Username</th>
                                    <th>Role</th>
                                    <th>Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse ($petugas as $index => $pet)
                                    <tr>
                                        <td>{{ $petugas->firstItem() + $index }}</td>
                                        <td>{{ $pet->nama }}</td>
                                        <td>{{ $pet->email }}</td>
                                        <td>{{ $pet->username }}</td>
                                        <td>{{ ucfirst($pet->role) }}</td>
                                        <td>
                                            <form onsubmit="return confirm('Apakah Anda yakin?');"
                                                action="{{ route('admin.petugas.destroy', $pet->id) }}" method="POST">
                                                <a href="{{ route('admin.petugas.edit', $pet->id) }}"
                                                    class="btn btn-sm btn-primary">
                                                    <i class="fas fa-pencil-alt"></i> Edit
                                                </a>
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="btn btn-sm btn-danger">
                                                    <i class="fas fa-trash"></i> Hapus
                                                </button>
                                            </form>
                                        </td>
                                    </tr>
                                @empty
                                    <tr>
                                        <td colspan="6">
                                            <div class="text-center">
                                                Belum ada petugas.
                                            </div>
                                        </td>
                                    </tr>
                                @endforelse
                            </tbody>
                        </table>

                        <div class="float-right">
                            {{ $petugas->withQueryString()->links() }}
                        </div>
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
