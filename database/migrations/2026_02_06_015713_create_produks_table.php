<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up()
{
    Schema::create('produks', function (Blueprint $table) {
        $table->id('id_produk'); // Primary Key
        $table->string('nama_produk');
        $table->integer('harga'); // Atau decimal
        
        // Perhatikan ini: Membuat kolom unsignedBigInteger manual
        $table->unsignedBigInteger('kategori_id'); 
        $table->unsignedBigInteger('status_id');
        
        $table->timestamps();

        // (Opsional) Tambahkan Foreign Key Constraint biar aman
        // $table->foreign('kategori_id')->references('id_kategori')->on('kategoris');
        // $table->foreign('status_id')->references('id_status')->on('statuses');
    });
}

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('produks');
    }
};
