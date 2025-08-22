<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Permintaan extends Model
{
    use HasFactory;

    protected $table = 'permintaan';

    protected $fillable = [
        'user_id',
        'tanggal_permintaan',
        'nama_item',
        'deskripsi',
        'jumlah',
        'keterangan',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
