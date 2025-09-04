<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class ListBarang extends Model
{
    protected $table = 'list_barang';

    public $timestamps = false;

    protected $fillable = [
        'tiket_sparepart',
        'jenis_id',
        'tipe_id',
        'kode_region',
        'tanggal',
        'pic',
<<<<<<< HEAD
        'department',
=======
        'department'
>>>>>>> acf6717e1b5c802543747fa6191fd20489504409
    ];

    protected $casts = [
        'tanggal' => 'date',
    ];

<<<<<<< HEAD
    const STATUS_TERSEDIA = 'tersedia';
    const STATUS_HABIS = 'habis';
    const STATUS_DIPESAN = 'dipesan';
=======
>>>>>>> acf6717e1b5c802543747fa6191fd20489504409

    protected static function boot()
    {
        parent::boot();

        static::creating(function ($listBarang) {
            $lastTiketNumber = DB::table('list_barang')
                ->select(DB::raw('MAX(CAST(SUBSTRING(tiket_sparepart, 4) AS UNSIGNED)) as max_number'))
                ->value('max_number');

            $nextNumber = $lastTiketNumber ? $lastTiketNumber + 1 : 1;
            $listBarang->tiket_sparepart = 'SP-' . str_pad($nextNumber, 3, '0', STR_PAD_LEFT);
        });
    }

<<<<<<< HEAD
    // 🔗 Relasi
=======
>>>>>>> acf6717e1b5c802543747fa6191fd20489504409
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

    public function details()
    {
        return $this->hasMany(DetailBarang::class, 'tiket_sparepart', 'tiket_sparepart');
    }

<<<<<<< HEAD
    // 🧮 Quantity otomatis
=======
>>>>>>> acf6717e1b5c802543747fa6191fd20489504409
    public function getQuantityAttribute()
    {
        return $this->details()->sum('quantity');
    }
<<<<<<< HEAD

    // 🚦 Status otomatis
    public function getStatusAttribute()
    {
        $qty = $this->quantity;
        if ($qty <= 0) return self::STATUS_HABIS;
        if ($qty < 5) return self::STATUS_DIPESAN; // threshold bisa diatur
        return self::STATUS_TERSEDIA;
    }
=======
>>>>>>> acf6717e1b5c802543747fa6191fd20489504409
}
