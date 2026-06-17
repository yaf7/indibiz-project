@extends('layouts.app')

@section('title', 'Detail Pesanan')

@section('content')
<section class="section">
    <div class="section-header">
        <h1>Detail Pesanan</h1>
        <div class="section-header-breadcrumb">
            <div class="breadcrumb-item active"><a href="{{ route('home') }}">Dashboard</a></div>
            <div class="breadcrumb-item"><a href="{{ route('pesanan.index') }}">Data Indibiz</a></div>
            <div class="breadcrumb-item">Detail Pesanan</div>
        </div>
    </div>

    <div class="section-body">
        <h2 class="section-title">Informasi Lengkap Klien: {{ $pesanan->namaClient }}</h2>
        <p class="section-lead">Detail data pesanan yang telah diinput pada {{ $pesanan->created_at->format('d F Y') }}.</p>

        <div class="row">
            <div class="col-12 col-md-12 col-lg-12">
                <div class="card">
                    <div class="card-header">
                        <h4>Data Klien & Layanan</h4>
                        <div class="card-header-action">
                            <a href="{{ route('pesanan.edit', $pesanan->id) }}" class="btn btn-warning"><i class="fas fa-edit"></i> Edit Data</a>
                        </div>
                    </div>
                    <div class="card-body">
                        <div class="row">
                            <div class="col-md-6">
                                <h6>Informasi Klien</h6>
                                <table class="table table-sm">
                                    <tr>
                                        <th width="30%">Nama</th>
                                        <td>: {{ $pesanan->namaClient }}</td>
                                    </tr>
                                    <tr>
                                        <th>Email</th>
                                        <td>: <a href="mailto:{{ $pesanan->emailClient }}">{{ $pesanan->emailClient }}</a></td>
                                    </tr>
                                    <tr>
                                        <th>Telepon</th>
                                        <td>: 
                                            <a href="tel:{{ $pesanan->teleponClient }}">{{ $pesanan->teleponClient }}</a>
                                            <a href="https://wa.me/{{ preg_replace('/[^0-9]/', '', $pesanan->teleponClient) }}" target="_blank" class="btn btn-sm btn-success ml-2"><i class="fab fa-whatsapp"></i> Hubungi WA</a>
                                        </td>
                                    </tr>
                                    <tr>
                                        <th>Alamat</th>
                                        <td>: {{ $pesanan->alamatClient }}</td>
                                    </tr>
                                </table>
                            </div>
                            <div class="col-md-6">
                                <h6>Layanan Indibiz</h6>
                                <table class="table table-sm">
                                    <tr>
                                        <th width="35%">Status Pesanan</th>
                                        <td>: 
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
                                    </tr>
                                    <tr>
                                        <th>Nama Produk</th>
                                        <td>: {{ ucwords(str_replace('_', ' ', $pesanan->namaProduk)) }}</td>
                                    </tr>
                                    <tr>
                                        <th>Kategori</th>
                                        <td>: <span class="badge badge-info">{{ ucwords(str_replace('_', ' ', $pesanan->kategori)) }}</span></td>
                                    </tr>
                                    <tr>
                                        <th>Metode Pembayaran</th>
                                        <td>: {{ ucwords(str_replace('_', ' ', $pesanan->pembayaranMelalui)) }}</td>
                                    </tr>
                                    <tr>
                                        <th>Tanggal Pemasangan</th>
                                        <td>: <strong class="text-primary">{{ \Carbon\Carbon::parse($pesanan->tanggalPemasangan)->translatedFormat('d F Y') }}</strong></td>
                                    </tr>
                                </table>
                            </div>
                        </div>
                        <div class="row mt-4">
                            <div class="col-12">
                                <h6>Catatan Tambahan:</h6>
                                <div class="p-3 bg-light rounded">
                                    {{ $pesanan->catatan ?? 'Tidak ada catatan khusus dari klien.' }}
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="card-footer bg-whitesmoke">
                        <a href="{{ route('pesanan.index') }}" class="btn btn-secondary">Kembali ke Daftar</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
@endsection
