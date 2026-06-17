@extends('layouts.app')

@section('title', 'Daftar Pesanan')

@section('content')
<section class="section">
    <div class="section-header">
        <h1>Daftar Pesanan Indibiz</h1>
        <div class="section-header-breadcrumb">
            <div class="breadcrumb-item active"><a href="{{ route('home') }}">Dashboard</a></div>
            <div class="breadcrumb-item">Data Indibiz</div>
            <div class="breadcrumb-item">Daftar Pesanan</div>
        </div>
    </div>

    <div class="section-body">
        <h2 class="section-title">Semua Data Pesanan</h2>
        <p class="section-lead">Halaman ini menampilkan seluruh data pesanan yang telah diinputkan ke sistem.</p>

        <div class="row">
            <div class="col-12">
                @if (session('success'))
                    <div class="alert alert-success alert-dismissible show fade">
                        <div class="alert-body">
                            <button class="close" data-dismiss="alert">
                                <span>&times;</span>
                            </button>
                            {{ session('success') }}
                        </div>
                    </div>
                @endif

                <div class="card">
                    <div class="card-header">
                        <h4>Data Pesanan</h4>
                        <div class="card-header-form">
                            <form action="{{ route('pesanan.index') }}" method="GET" class="d-inline-block">
                                <div class="input-group">
                                    <input type="text" name="search" class="form-control" placeholder="Cari klien..." value="{{ request('search') }}">
                                    <div class="input-group-btn">
                                        <button class="btn btn-primary"><i class="fas fa-search"></i></button>
                                    </div>
                                </div>
                            </form>
                        </div>
                        <div class="card-header-action ml-2">
                            <a href="{{ route('pesanan.export') }}" class="btn btn-success"><i class="fas fa-file-excel"></i> Export CSV</a>
                            <a href="{{ route('pesanan.create') }}" class="btn btn-primary"><i class="fas fa-plus"></i> Tambah Data</a>
                        </div>
                    </div>
                    <div class="card-body">
                        <div class="table-responsive">
                            <table class="table table-striped table-md" id="table-pesanan">
                                <thead>
                                    <tr>
                                        <th>#</th>
                                        <th>Nama Klien</th>
                                        <th>Kontak</th>
                                        <th>Layanan</th>
                                        <th>Status</th>
                                        <th>Tgl Pemasangan</th>
                                        <th>Aksi</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @forelse ($pesanans as $index => $pesanan)
                                        <tr>
                                            <td>{{ $pesanans->firstItem() + $index }}</td>
                                            <td>{{ $pesanan->namaClient }}</td>
                                            <td>
                                                <a href="mailto:{{ $pesanan->emailClient }}">{{ $pesanan->emailClient }}</a><br>
                                                <small class="text-muted">{{ $pesanan->teleponClient }}</small>
                                            </td>
                                            <td>
                                                {{ ucwords(str_replace('_', ' ', $pesanan->namaProduk)) }}<br>
                                                <div class="badge badge-info">{{ ucwords(str_replace('_', ' ', $pesanan->kategori)) }}</div>
                                            </td>
                                            <td>
                                                @if($pesanan->status == 'menunggu')
                                                    <span class="badge badge-warning">Menunggu</span>
                                                @elseif($pesanan->status == 'diproses')
                                                    <span class="badge badge-primary">Diproses</span>
                                                @elseif($pesanan->status == 'selesai')
                                                    <span class="badge badge-success">Selesai</span>
                                                @elseif($pesanan->status == 'dibatalkan')
                                                    <span class="badge badge-danger">Dibatalkan</span>
                                                @else
                                                    <span class="badge badge-secondary">{{ $pesanan->status }}</span>
                                                @endif
                                            </td>
                                            <td>{{ \Carbon\Carbon::parse($pesanan->tanggalPemasangan)->translatedFormat('d M Y') }}</td>
                                            <td>
                                                <form action="{{ route('pesanan.destroy', $pesanan->id) }}" method="POST" onsubmit="return confirm('Apakah Anda yakin ingin menghapus data ini?');">
                                                    <a href="{{ route('pesanan.show', $pesanan->id) }}" class="btn btn-sm btn-info" data-toggle="tooltip" title="Lihat Detail"><i class="fas fa-eye"></i></a>
                                                    <a href="{{ route('pesanan.edit', $pesanan->id) }}" class="btn btn-sm btn-warning" data-toggle="tooltip" title="Edit Data"><i class="fas fa-edit"></i></a>
                                                    @csrf
                                                    @method('DELETE')
                                                    <button type="submit" class="btn btn-sm btn-danger" data-toggle="tooltip" title="Hapus Data"><i class="fas fa-trash"></i></button>
                                                </form>
                                            </td>
                                        </tr>
                                    @empty
                                        <tr>
                                            <td colspan="7" class="text-center">Belum ada data pesanan.</td>
                                        </tr>
                                    @endforelse
                                </tbody>
                            </table>
                        </div>
                    </div>
                    <div class="card-footer text-right">
                        {{ $pesanans->links('pagination::bootstrap-4') }}
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
@endsection
