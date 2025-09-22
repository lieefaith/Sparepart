<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;
use App\Models\DetailBarang;

class KepalaGudangController extends Controller
{
        public function dashboard(Request $request)
    {
        $date = $request->input('date', Carbon::today()->toDateString());

        $groups = DB::table('detail_barang')
            ->select('jenis_id', 'tipe_id', DB::raw('SUM(quantity) as total_qty'), DB::raw('MAX(id) as latest_id'))
            ->whereDate('tanggal', $date)
            ->groupBy('jenis_id', 'tipe_id')
            ->get();

        if ($groups->isEmpty()) {
            $detail = collect();
            $totalPerDay = 0;
            return view('kepalagudang.dashboard', compact('detail', 'date', 'totalPerDay'));
        }

        $latestIds = $groups->pluck('latest_id')->filter()->all();

        $latestRecords = DetailBarang::with(['jenis', 'tipe'])
            ->whereIn('id', $latestIds)
            ->get()
            ->keyBy('id');

        $rows = $groups->map(function ($g) use ($latestRecords, $date) {
            $r = $latestRecords->get($g->latest_id);


            $jenis_nama = $r && $r->jenis ? $r->jenis->nama : null;
            $tipe_nama  = $r && $r->tipe  ? $r->tipe->nama  : null;

            return (object)[
                'id'             => $g->latest_id,
                'tiket_sparepart' => $r ? $r->tiket_sparepart : null,
                'nama_barang'    => $r ? $r->nama_barang : null,
                'qty_record'     => $r ? $r->quantity : 0,
                'jenis'          => $r ? $r->jenis : (object)['id' => $g->jenis_id, 'nama' => $jenis_nama],
                'tipe'           => $r ? $r->tipe  : (object)['id' => $g->tipe_id, 'nama' => $tipe_nama],
                'jenis_nama'     => $jenis_nama,
                'tipe_nama'      => $tipe_nama,
                'total_qty'      => (int) $g->total_qty,
                'tanggal'        => $r ? $r->tanggal : $date,
            ];
        })->sortByDesc('tiket_sparepart')->values();

        $detail = $rows;
        $totalPerDay = $groups->sum('total_qty');
        $totalMasuk = DetailBarang::whereDate('tanggal', $date)->sum('quantity');


        return view('kepalagudang.dashboard', compact('detail', 'date', 'totalPerDay', 'totalMasuk'));
    }

    public function requestIndex()
    {
        return view('kepalagudang.request');
    }

    public function sparepartIndex()
    {
        return view('kepalagudang.sparepart');
    }

    public function sparepartStore(Request $request)
    {
        // Fungsi ini akan gagal jika tidak ada model RequestBarang
        // dan tabel di database. Anda bisa hapus fungsi ini jika tidak digunakan.
    }

    public function historyIndex()
    {
        return view('kepalagudang.history');
    }

    public function historyDetail($id)
    {
        // Fungsi ini juga akan gagal jika tidak ada model HistoriPermintaan
        // dan tabel di database. Anda bisa hapus fungsi ini jika tidak digunakan.
    }
}