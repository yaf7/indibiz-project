@extends('layouts.app')

@section('title', 'Dashboard')

@section('content')
<section class="section">
    <div class="section-header">
        <h1>Dashboard Admin</h1>
    </div>

    <!-- 1. WIDGET STATISTIK -->
    <div class="row">
        <div class="col-lg-3 col-md-6 col-sm-6 col-12">
            <div class="card card-statistic-1">
                <div class="card-icon bg-primary">
                    <i class="fas fa-shopping-cart"></i>
                </div>
                <div class="card-wrap">
                    <div class="card-header">
                        <h4>Total Pesanan</h4>
                    </div>
                    <div class="card-body">
                        {{ $totalPesanan }}
                    </div>
                </div>
            </div>
        </div>
        <div class="col-lg-3 col-md-6 col-sm-6 col-12">
            <div class="card card-statistic-1">
                <div class="card-icon bg-success">
                    <i class="fas fa-calendar-check"></i>
                </div>
                <div class="card-wrap">
                    <div class="card-header">
                        <h4>Pesanan Bulan Ini</h4>
                    </div>
                    <div class="card-body">
                        {{ $pesananBulanIni }}
                    </div>
                </div>
            </div>
        </div>
        <div class="col-lg-3 col-md-6 col-sm-6 col-12">
            <div class="card card-statistic-1">
                <div class="card-icon bg-warning">
                    <i class="fas fa-tools"></i>
                </div>
                <div class="card-wrap">
                    <div class="card-header">
                        <h4>Pemasangan Hari Ini</h4>
                    </div>
                    <div class="card-body">
                        {{ $jadwalPemasanganHariIni }}
                    </div>
                </div>
            </div>
        </div>
        <div class="col-lg-3 col-md-6 col-sm-6 col-12">
            <div class="card card-statistic-1">
                <div class="card-icon bg-danger">
                    <i class="far fa-user"></i>
                </div>
                <div class="card-wrap">
                    <div class="card-header">
                        <h4>Total Pengguna</h4>
                    </div>
                    <div class="card-body">
                        {{ $totalPengguna }}
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- 2. SHORTCUT/QUICK ACTIONS -->
    <div class="row mb-4">
        <div class="col-12">
            <a href="{{ route('pesanan.create') }}" class="btn btn-primary mr-2"><i class="fas fa-plus"></i> Tambah Pesanan Baru</a>
            <a href="{{ route('pesanan.index') }}" class="btn btn-outline-primary"><i class="fas fa-list"></i> Lihat Semua Pesanan</a>
        </div>
    </div>

    <div class="row">
        <!-- 3. TABEL PESANAN TERBARU -->
        <div class="col-lg-8 col-md-12 col-12 col-sm-12">
            <div class="card">
                <div class="card-header">
                    <h4>Pesanan Terbaru</h4>
                    <div class="card-header-action">
                        <a href="{{ route('pesanan.index') }}" class="btn btn-primary">Lihat Semua</a>
                    </div>
                </div>
                <div class="card-body p-0">
                    <div class="table-responsive">
                        <table class="table table-striped mb-0">
                            <thead>
                                <tr>
                                    <th>Klien</th>
                                    <th>Produk (Kategori)</th>
                                    <th>Pembayaran</th>
                                    <th>Tgl Pemasangan</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse($recentOrders as $order)
                                <tr>
                                    <td>
                                        {{ $order->namaClient }}<br>
                                        <small class="text-muted">{{ $order->teleponClient }}</small>
                                    </td>
                                    <td>
                                        {{ $order->namaProduk }}<br>
                                        <span class="badge badge-info">{{ $order->kategori }}</span>
                                    </td>
                                    <td>{{ $order->pembayaranMelalui }}</td>
                                    <td>{{ \Carbon\Carbon::parse($order->tanggalPemasangan)->translatedFormat('d F Y') }}</td>
                                </tr>
                                @empty
                                <tr>
                                    <td colspan="4" class="text-center p-3">Belum ada pesanan terbaru.</td>
                                </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>

        <!-- 4. JADWAL PEMASANGAN TERDEKAT -->
        <div class="col-lg-4 col-md-12 col-12 col-sm-12">
            <div class="card">
                <div class="card-header">
                    <h4>Pemasangan Terdekat</h4>
                </div>
                <div class="card-body">
                    <ul class="list-unstyled list-unstyled-border">
                        @forelse($upcomingInstallations as $install)
                        <li class="media">
                            <div class="media-icon bg-primary rounded-circle mr-3">
                                <i class="fas fa-wrench text-white mt-2"></i>
                            </div>
                            <div class="media-body">
                                <div class="float-right text-primary">
                                    {{ \Carbon\Carbon::parse($install->tanggalPemasangan)->diffForHumans() }}
                                </div>
                                <div class="media-title">{{ $install->namaClient }}</div>
                                <span class="text-small text-muted">{{ $install->namaProduk }} ({{ $install->kategori }})<br> Alamat: {{ Str::limit($install->alamatClient, 30) }}</span>
                            </div>
                        </li>
                        @empty
                        <div class="text-center text-muted">
                            <p>Tidak ada jadwal terdekat.</p>
                        </div>
                        @endforelse
                    </ul>
                </div>
            </div>
            
            <!-- 5. GRAFIK KATEGORI PRODUK -->
            <div class="card">
                <div class="card-header">
                    <h4>Proporsi Kategori Produk</h4>
                </div>
                <div class="card-body">
                    <canvas id="kategoriChart"></canvas>
                </div>
            </div>
        </div>
    </div>
</section>
@endsection

@push('scripts')
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<script>
    document.addEventListener("DOMContentLoaded", function() {
        var ctx = document.getElementById("kategoriChart").getContext('2d');
        var myChart = new Chart(ctx, {
            type: 'doughnut',
            data: {
                labels: {!! json_encode($chartLabels) !!},
                datasets: [{
                    data: {!! json_encode($chartData) !!},
                    backgroundColor: [
                        '#6777ef',
                        '#fc544b',
                        '#ffa426',
                        '#47c363',
                        '#3abaf4'
                    ],
                }]
            },
            options: {
                responsive: true,
                legend: {
                    position: 'bottom',
                },
            }
        });
    });
</script>
@endpush
