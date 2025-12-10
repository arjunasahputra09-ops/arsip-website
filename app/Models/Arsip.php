<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Arsip extends Model
{
    use HasFactory;

    /**
     * Atribut yang boleh diisi secara massal.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'kode_arsip',
        'judul',
        'deskripsi',
        'jenis_arsip', // Pastikan ini ada
        'tanggal',
        'file',
    ];

    /**
     * Atribut yang harus di-cast (diubah tipenya) secara otomatis.
     *
     * @var array<string, string>
     */
    protected $casts = [
        // INI ADALAH PERBAIKANNYA:
        'tanggal' => 'date',
    ];
}
