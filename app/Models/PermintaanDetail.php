<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class PermintaanDetail extends Model
{
    protected $table = 'permintaan_detail';

    protected $fillable = [
        'tiket',
        'nama_item',
        'deskripsi',
        'jumlah',
        'keterangan',
    ];

    public $timestamps = true;

    public function permintaan()
    {
        return $this->belongsTo(Permintaan::class, 'tiket', 'tiket');
    }
}
