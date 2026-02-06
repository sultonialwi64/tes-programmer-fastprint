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
       Schema::create('kategoris', function (Blueprint $table) {
        $table->id('id_kategori');        // <--- Pastikan ini ada
        $table->string('nama_kategori');  // <--- INI YANG HILANG/ERROR DI TEMPATMU
        $table->timestamps();
    });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('kategoris');
    }
};
