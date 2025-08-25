<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ListBarang extends Model
{
    protected $table = 'list_barang';

    protected $fillable = [
        'jenis_id',
        'kode_region',
        'jenis',
        'tipe',
        'nama_barang',
        'serial_number',
        'in_out',
        'spk',
        'harga',
        'quantity',
        'unit',
        'tanggal',
        'pic',
        'department',
        'keterangan',
        'status'
    ];

    public function region()
    {
        return $this->belongsTo(Region::class, 'kode_region', 'kode_region');
    }

    public function jenisBarang()
    {
        return $this->belongsTo(JenisBarang::class, 'jenis_id');
    }
}
