<?php

namespace App\Http\Controllers;

use App\Models\Pesanan;
use Illuminate\Http\Request;

class PesananController extends Controller
{
    // Menampilkan data pesanan (dengan Search & Pagination)
    public function index(Request $request)
    {
        $query = Pesanan::query();

        if ($request->has('search')) {
            $search = $request->get('search');
            $query->where('namaClient', 'LIKE', "%{$search}%")
                  ->orWhere('teleponClient', 'LIKE', "%{$search}%")
                  ->orWhere('emailClient', 'LIKE', "%{$search}%");
        }

        $pesanans = $query->orderBy('created_at', 'desc')->paginate(10); 
        return view('pesanan.index', compact('pesanans'));
    }

    // Menampilkan form pemesanan
    public function create()
    {
        return view('pesanan.create');
    }

    // Menyimpan data pesanan
    public function store(Request $request)
    {
        $validated = $request->validate([
            'namaClient' => 'required|string|max:255',
            'emailClient' => 'required|email',
            'teleponClient' => 'required|string|max:15',
            'alamatClient' => 'required|string',
            'namaProduk' => 'required|string',
            'kategori' => 'required|string',
            'pembayaranMelalui' => 'required|string',
            'tanggalPemasangan' => 'required|date',
            'catatan' => 'nullable|string',
        ]);

        $validated['status'] = 'menunggu';

        // Menyimpan data pesanan ke database
        Pesanan::create($validated);

        // Redirect kembali ke form dengan pesan sukses
        return redirect()->route('pesanan.index')->with('success', 'Pesanan berhasil dibuat!');
    }

    // Menampilkan detail pesanan
    public function show($id)
    {
        $pesanan = Pesanan::findOrFail($id);
        return view('pesanan.show', compact('pesanan'));
    }

    // Menampilkan form edit pesanan
    public function edit($id)
    {
        $pesanan = Pesanan::findOrFail($id);
        return view('pesanan.edit', compact('pesanan'));
    }

    // Menyimpan perubahan data pesanan
    public function update(Request $request, $id)
    {
        $validated = $request->validate([
            'namaClient' => 'required|string|max:255',
            'emailClient' => 'required|email',
            'teleponClient' => 'required|string|max:15',
            'alamatClient' => 'required|string',
            'namaProduk' => 'required|string',
            'kategori' => 'required|string',
            'pembayaranMelalui' => 'required|string',
            'tanggalPemasangan' => 'required|date',
            'status' => 'required|string',
            'catatan' => 'nullable|string',
        ]);

        $pesanan = Pesanan::findOrFail($id);
        $pesanan->update($validated);

        return redirect()->route('pesanan.index')->with('success', 'Data pesanan berhasil diperbarui!');
    }

    // Menghapus data pesanan
    public function destroy($id)
    {
        $pesanan = Pesanan::findOrFail($id);
        $pesanan->delete();

        return redirect()->route('pesanan.index')->with('success', 'Data pesanan berhasil dihapus!');
    }

    // Ekspor ke CSV
    public function exportCsv()
    {
        $pesanans = Pesanan::orderBy('created_at', 'desc')->get();
        $filename = "laporan_pesanan_indibiz_" . date('Y-m-d_H-i-s') . ".csv";

        $headers = [
            "Content-type"        => "text/csv",
            "Content-Disposition" => "attachment; filename=$filename",
            "Pragma"              => "no-cache",
            "Cache-Control"       => "must-revalidate, post-check=0, pre-check=0",
            "Expires"             => "0"
        ];

        $columns = ['ID', 'Nama Klien', 'Email', 'Telepon', 'Alamat', 'Produk', 'Kategori', 'Pembayaran', 'Tgl Pemasangan', 'Status', 'Catatan', 'Tgl Dibuat'];

        $callback = function() use($pesanans, $columns) {
            $file = fopen('php://output', 'w');
            fputcsv($file, $columns);

            foreach ($pesanans as $row) {
                fputcsv($file, [
                    $row->id,
                    $row->namaClient,
                    $row->emailClient,
                    $row->teleponClient,
                    $row->alamatClient,
                    $row->namaProduk,
                    $row->kategori,
                    $row->pembayaranMelalui,
                    $row->tanggalPemasangan,
                    $row->status,
                    $row->catatan,
                    $row->created_at
                ]);
            }

            fclose($file);
        };

        return response()->stream($callback, 200, $headers);
    }
}

