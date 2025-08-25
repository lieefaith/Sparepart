<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Pengiriman extends Model
{
    protected $fillable = [
        'permintaan_id',
        'user_id',
        'tanggal_transaksi',
        'nama_item',
        'deskripsi',
        'jumlah',
        'keterangan'
    ];

    public function permintaan()
    {
        return $this->belongsTo(Permintaan::class);
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function histori()
    {
        return $this->hasMany(HistoriPengiriman::class);
    }
}
