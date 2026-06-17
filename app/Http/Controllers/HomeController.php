<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Pesanan;
use App\Models\User;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        // 1. Widget Statistik
        $totalPesanan = Pesanan::count();
        $pesananBulanIni = Pesanan::whereMonth('created_at', date('m'))
                                  ->whereYear('created_at', date('Y'))
                                  ->count();
        $jadwalPemasanganHariIni = Pesanan::whereDate('tanggalPemasangan', date('Y-m-d'))
                                          ->count();
        $totalPengguna = User::count();

        // 2. Tabel Pesanan Terbaru (5 terakhir)
        $recentOrders = Pesanan::latest()->take(5)->get();

        // 3. Jadwal Pemasangan Terdekat (5 pemasangan ke depan mulai hari ini)
        $upcomingInstallations = Pesanan::whereDate('tanggalPemasangan', '>=', date('Y-m-d'))
                                        ->orderBy('tanggalPemasangan', 'asc')
                                        ->take(5)
                                        ->get();

        // Chart Data: Kategori Produk
        $kategoriData = Pesanan::selectRaw('kategori, count(*) as total')
                               ->groupBy('kategori')
                               ->pluck('total', 'kategori');

        $chartLabels = $kategoriData->keys()->toArray();
        $chartData = $kategoriData->values()->toArray();

        return view('home', compact(
            'totalPesanan', 
            'pesananBulanIni', 
            'jadwalPemasanganHariIni', 
            'totalPengguna',
            'recentOrders',
            'upcomingInstallations',
            'chartLabels',
            'chartData'
        ));
    }

    public function blank()
    {
        return view('layouts.blank-page');
    }
}
