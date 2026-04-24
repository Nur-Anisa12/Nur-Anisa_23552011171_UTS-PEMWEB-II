<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Mahasiswa extends Model
{
    // Tambahkan baris ini untuk mengunci nama tabel
    protected $table = 'mahasiswa';

    protected $fillable = [
        'nim',
        'nama',
        'id_jurusan'
    ];
}
