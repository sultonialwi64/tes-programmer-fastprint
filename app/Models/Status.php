<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Status extends Model
{
    protected $primaryKey = 'id_status';
    protected $guarded = [];
    public function up()
{
    Schema::create('statuses', function (Blueprint $table) {
        $table->id('id_status');
        $table->string('nama_status');
        $table->timestamps();
    });
}
}
