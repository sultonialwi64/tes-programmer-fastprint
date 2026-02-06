<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http; // Wajib import ini buat API
use App\Models\Produk;
use App\Models\Kategori;
use App\Models\Status;

class ProdukController extends Controller
{
    // 1. HALAMAN UTAMA (READ)
    public function index()
    {
        // Soal No 5: Tampilkan HANYA status "bisa dijual"
        $produks = Produk::whereHas('status', function ($q) {
            $q->where('nama_status', 'bisa dijual');
        })->get();

        return view('produk.index', compact('produks'));
    }

    // 2. FETCH DATA DARI API (SOAL NO 1 & 3)
    public function fetchApi()
    {
        // Setup Password Dinamis (bisacoding-tgl-bln-thn)
        $date = now();
        $password = "bisacoding-" . $date->format('d-m-y');
        $passwordMd5 = md5($password); // Soal minta MD5

        // Request ke API FastPrint
        // PENTING: Cek Username terbaru di website recruitment sebelum run!
        $response = Http::withoutVerifying()->asForm()->post('https://recruitment.fastprint.co.id/tes/api_tes_programmer', [
            'username' => 'tesprogrammer060226C09', // <--- Pastikan ini update sesuai web!
            'password' => $passwordMd5
        ]);
        $data = $response->json();

        if (isset($data['error']) && $data['error'] == 1) {
            return "Gagal Login API: " . $data['ket'];
        }

        // Looping data
        foreach ($data['data'] as $item) {

            // Simpan Kategori dulu (Hindari duplikat)
            $kategori = Kategori::firstOrCreate(
                ['nama_kategori' => $item['kategori']], // Cari
                ['nama_kategori' => $item['kategori']]  // Buat klo gak ada
            );

            // Simpan Status dulu
            $status = Status::firstOrCreate(
                ['nama_status' => $item['status']],
                ['nama_status' => $item['status']]
            );

            // Simpan Produk (Cek ID biar gak dobel klo direfresh)
            // Pastikan harga berupa angka (hapus 'Rp' atau titik jika ada dari API, tapi API biasanya angka bersih)
            Produk::updateOrCreate(
                ['id_produk' => $item['id_produk']],
                [
                    'nama_produk' => $item['nama_produk'],
                    'harga' => $item['harga'],
                    'kategori_id' => $kategori->id_kategori,
                    'status_id' => $status->id_status,
                ]
            );
        }

        return redirect('/')->with('success', 'Data berhasil ditarik dari API!');
    }

    // 3. FORM TAMBAH
    public function create()
    {
        $kategoris = Kategori::all();
        $statuses = Status::all();
        return view('produk.create', compact('kategoris', 'statuses'));
    }

    // 4. PROSES SIMPAN (CREATE)
    public function store(Request $request)
    {
        // Soal No 7: Validasi (Nama harus diisi, Harga harus angka)
        $request->validate([
            'nama_produk' => 'required',
            'harga' => 'required|numeric',
            'kategori_id' => 'required',
            'status_id' => 'required',
        ]);

        // Karena ID Produk di database API mungkin ribuan, kita biarkan ID auto increment atau random
        // Tapi krn kita set primary key manual tadi, kita perlu hati2. 
        // Solusi aman: Biarkan kosong jika autoincrement, atau generate manual.
        // Untuk tes ini, kita pakai standard create laravel:

        Produk::create($request->all());

        return redirect('/')->with('success', 'Produk berhasil ditambahkan');
    }

    // 5. FORM EDIT
    public function edit($id)
    {
        $produk = Produk::find($id);
        $kategoris = Kategori::all();
        $statuses = Status::all();
        return view('produk.edit', compact('produk', 'kategoris', 'statuses'));
    }

    // 6. PROSES UPDATE
    public function update(Request $request, $id)
    {
        $request->validate([
            'nama_produk' => 'required',
            'harga' => 'required|numeric',
        ]);

        Produk::find($id)->update($request->all());
        return redirect('/')->with('success', 'Produk berhasil diupdate');
    }

    // 7. HAPUS (DELETE)
    public function destroy($id)
    {
        Produk::find($id)->delete();
        return redirect('/')->with('success', 'Produk berhasil dihapus');
    }
}