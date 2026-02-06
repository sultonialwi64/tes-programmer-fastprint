<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Produk extends Model
{
    use HasFactory;

    protected $primaryKey = 'id_produk';
    protected $guarded = [];

    // Relasi ke Status
    public function status()
    {
        // Parameter 2: nama kolom di tabel produks (status_id)
        // Parameter 3: nama kolom primary key di tabel statuses (id_status)
        return $this->belongsTo(Status::class, 'status_id', 'id_status');
    }

    // Relasi ke Kategori
    public function kategori()
    {
        return $this->belongsTo(Kategori::class, 'kategori_id', 'id_kategori');
    }
}