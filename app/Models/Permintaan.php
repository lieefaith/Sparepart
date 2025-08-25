<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class Permintaan extends Model
{
    protected $table = 'permintaan';

    protected $fillable = [
        'user_id',
        'tanggal_permintaan',
        'keterangan',
    ];


    public $timestamps = true;

    protected static function boot()
    {
        parent::boot();

        static::creating(function ($permintaan) {

            $lastTiketNumber = DB::table('permintaan')
                ->select(DB::raw('MAX(CAST(SUBSTRING(tiket, 7) AS UNSIGNED)) as max_number'))
                ->value('max_number');

            $nextNumber = $lastTiketNumber ? $lastTiketNumber + 1 : 1;

            $permintaan->tiket = 'Tiket-' . str_pad($nextNumber, 3, '0', STR_PAD_LEFT);
        });
    }

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    public function details()
    {
        return $this->hasMany(PermintaanDetail::class, 'tiket', 'tiket');
    }

    public function histori()
    {
        return $this->hasOne(HistoriPermintaan::class, 'tiket', 'tiket');
    }
}
