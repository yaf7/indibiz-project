@extends('layouts.app')

@section('title', 'Tambah Pesanan')

@section('content')
<section class="section">
    <div class="section-header">
        <h1>Tambah Pesanan Baru</h1>
        <div class="section-header-breadcrumb">
            <div class="breadcrumb-item active"><a href="{{ route('home') }}">Dashboard</a></div>
            <div class="breadcrumb-item"><a href="{{ route('pesanan.index') }}">Data Indibiz</a></div>
            <div class="breadcrumb-item">Tambah Pesanan</div>
        </div>
    </div>

    <div class="section-body">
        <h2 class="section-title">Form Input Pemesanan</h2>
        <p class="section-lead">Isi form di bawah ini untuk menambahkan data pesanan klien baru ke dalam sistem.</p>

        <div class="row">
            <div class="col-12 col-md-12 col-lg-12">
                <div class="card">
                    <form action="{{ route('pesanan.store') }}" method="POST">
                        @csrf
                        <div class="card-body">
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="namaClient">Nama Client <span class="text-danger">*</span></label>
                                        <input type="text" class="form-control @error('namaClient') is-invalid @enderror" id="namaClient" name="namaClient" value="{{ old('namaClient') }}" required>
                                        @error('namaClient') <div class="invalid-feedback">{{ $message }}</div> @enderror
                                    </div>
                                    <div class="form-group">
                                        <label for="emailClient">Email Client <span class="text-danger">*</span></label>
                                        <input type="email" class="form-control @error('emailClient') is-invalid @enderror" id="emailClient" name="emailClient" value="{{ old('emailClient') }}" required>
                                        @error('emailClient') <div class="invalid-feedback">{{ $message }}</div> @enderror
                                    </div>
                                    <div class="form-group">
                                        <label for="teleponClient">Telepon Client <span class="text-danger">*</span></label>
                                        <input type="tel" class="form-control @error('teleponClient') is-invalid @enderror" id="teleponClient" name="teleponClient" value="{{ old('teleponClient') }}" required>
                                        @error('teleponClient') <div class="invalid-feedback">{{ $message }}</div> @enderror
                                    </div>
                                    <div class="form-group">
                                        <label for="alamatClient">Alamat Client <span class="text-danger">*</span></label>
                                        <textarea class="form-control @error('alamatClient') is-invalid @enderror" id="alamatClient" name="alamatClient" rows="3" required style="height:100px">{{ old('alamatClient') }}</textarea>
                                        @error('alamatClient') <div class="invalid-feedback">{{ $message }}</div> @enderror
                                    </div>
                                    <div class="form-group">
                                        <label for="namaProduk">Nama Produk <span class="text-danger">*</span></label>
                                        <select class="form-control @error('namaProduk') is-invalid @enderror" id="namaProduk" name="namaProduk" required>
                                            <option value="" disabled selected>-- Pilih Produk --</option>
                                            <option value="bisnis_non_fup" {{ old('namaProduk') == 'bisnis_non_fup' ? 'selected' : '' }}>Bisnis Non FUP</option>
                                            <option value="bisnis_basic_fup" {{ old('namaProduk') == 'bisnis_basic_fup' ? 'selected' : '' }}>Bisnis Basic FUP</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="kategori">Kategori Layanan <span class="text-danger">*</span></label>
                                        <select class="form-control @error('kategori') is-invalid @enderror" id="kategori" name="kategori" required>
                                            <option value="" disabled selected>-- Pilih Kategori --</option>
                                            <option value="paket_50mb" {{ old('kategori') == 'paket_50mb' ? 'selected' : '' }}>Paket 50 MB</option>
                                            <option value="paket_100mb" {{ old('kategori') == 'paket_100mb' ? 'selected' : '' }}>Paket 100 MB</option>
                                        </select>
                                    </div>
                                    <div class="form-group">
                                        <label for="pembayaranMelalui">Pembayaran Melalui <span class="text-danger">*</span></label>
                                        <select class="form-control @error('pembayaranMelalui') is-invalid @enderror" id="pembayaranMelalui" name="pembayaranMelalui" required>
                                            <option value="" disabled selected>-- Pilih Metode Pembayaran --</option>
                                            <option value="bank_transfer" {{ old('pembayaranMelalui') == 'bank_transfer' ? 'selected' : '' }}>Bank Transfer</option>
                                            <option value="gopay" {{ old('pembayaranMelalui') == 'gopay' ? 'selected' : '' }}>GoPay</option>
                                            <option value="ovo" {{ old('pembayaranMelalui') == 'ovo' ? 'selected' : '' }}>OVO</option>
                                            <option value="dana" {{ old('pembayaranMelalui') == 'dana' ? 'selected' : '' }}>DANA</option>
                                            <option value="credit_card" {{ old('pembayaranMelalui') == 'credit_card' ? 'selected' : '' }}>Kartu Kredit</option>
                                        </select>
                                    </div>
                                    <div class="form-group">
                                        <label for="tanggalPemasangan">Tanggal Pemasangan <span class="text-danger">*</span></label>
                                        <input type="date" class="form-control @error('tanggalPemasangan') is-invalid @enderror" id="tanggalPemasangan" name="tanggalPemasangan" value="{{ old('tanggalPemasangan') }}" required>
                                    </div>
                                    <div class="form-group">
                                        <label for="catatan">Catatan Tambahan</label>
                                        <textarea class="form-control @error('catatan') is-invalid @enderror" id="catatan" name="catatan" rows="3" style="height:100px" placeholder="Masukkan catatan khusus jika ada...">{{ old('catatan') }}</textarea>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="card-footer text-right">
                            <a href="{{ route('pesanan.index') }}" class="btn btn-secondary mr-2">Kembali</a>
                            <button type="reset" class="btn btn-warning mr-2">Reset</button>
                            <button type="submit" class="btn btn-primary">Simpan Pesanan</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</section>
@endsection
