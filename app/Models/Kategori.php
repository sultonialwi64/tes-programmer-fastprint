<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;


class Kategori extends Model
{
    protected $primaryKey = 'id_kategori'; // Kasih tau Laravel PK-nya bukan 'id'
    protected $guarded = [];
    public function up()
{
    Schema::create('kategoris', function (Blueprint $table) {
        $table->id('id_kategori'); // Primary Key custom name
        $table->string('nama_kategori');
        $table->timestamps();
    });
}
}
