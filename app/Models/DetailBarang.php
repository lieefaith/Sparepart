<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class DetailBarang extends Model
{
    protected $table = 'detail_barang';

    public $timestamps = false;

    protected $fillable = [
        'tiket_sparepart',
        'jenis_id',
        'tipe_id',
        'nama_barang',
        'serial_number',
        'spk',
        'harga',
        'quantity',
        'keterangan',
        'kode_region',
    ];

    public function listBarang()
    {
        return $this->belongsTo(ListBarang::class, 'tiket_sparepart', 'tiket_sparepart');
    }

    public function region()
    {
        return $this->belongsTo(Region::class, 'kode_region', 'kode_region');
    }

    public function jenisBarang()
    {
        return $this->belongsTo(JenisBarang::class, 'jenis_id');
    }

    public function tipeBarang()
    {
        return $this->belongsTo(TipeBarang::class, 'tipe_id');
    }
}
