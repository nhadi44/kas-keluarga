<?php

namespace App\Service;

use App\Helpers\ApiResponse;
use App\Models\Pemasukan;
use App\Models\Pengeluaran;
use App\Models\Saldo;
use Carbon\Carbon;
use Illuminate\Http\JsonResponse;

class DashboardService
{
    public function getDataDiagramPemasukan(): JsonResponse
    {
        $pemasukan = Pemasukan::where('user_id', auth()->user()->id)
            ->whereYear('created_at', Carbon::now()->year)
            ->get();

        // get data pemasukan per bulan dan group by bulan
        $pemasukan = $pemasukan->groupBy(function ($item) {
            return Carbon::parse($item->tanggal_pemasukan)->format('m');
        });

        // get total pemasukan per bulan dan bulannya
        $pemasukan = $pemasukan->map(function ($item) {
            return $item->sum('nominal_pemasukan');
        });

        // get nama bulan
        $pemasukan = $pemasukan->map(function ($item, $key) {
            // convert string to integer
            $key = (int) $key;

            // get nama bulan
            $namaBulan = Carbon::create()->month($key)->locale('id')->monthName;

            return [
                'nama_bulan' => $namaBulan,
                'total_pemasukan' => $item,
            ];
        });

        // short data by key from 1 to 12
        $pemasukan = $pemasukan->sortBy(function ($item, $key) {
            return $key;
        });

        // get value from collection
        $pemasukan = $pemasukan->values();

        return ApiResponse::success(200, 'success', $pemasukan);
    }

    public function getDataPiePengeluaran(): JsonResponse
    {
        $pengeluaran = Pengeluaran::where('user_id', auth()->user()->id)
            ->whereYear('created_at', Carbon::now()->year)
            ->get();

        // get data pengeluaran per kategori dan group by kategori
        $pengeluaran = $pengeluaran->groupBy(function ($item) {
            return $item->kategori_pengeluaran;
        });

        // get total pengeluaran per kategori dan kategorinya
        $pengeluaran = $pengeluaran->map(function ($item) {
            return $item->sum('jumlah_pengeluaran');
        });

        // get nama kategori
        $pengeluaran = $pengeluaran->map(function ($item, $key) {
            return [
                'labels' => $key,
                'total_pengeluaran' => $item,
            ];
        });

        $pengeluaran = $pengeluaran->values();

        // count percentage of each data
        $totalPengeluaran = $pengeluaran->sum('total_pengeluaran');
        $pengeluaran = $pengeluaran->map(function ($item) use ($totalPengeluaran) {
            $item['series'] = round(($item['total_pengeluaran'] / $totalPengeluaran) * 100, 2);
            return $item;
        });

        // create random hexa color
        $pengeluaran = $pengeluaran->map(function ($item) {
            $item['colors'] = '#' . str_pad(dechex(mt_rand(0, 0xFFFFFF)), 6, '0', STR_PAD_LEFT);
            return $item;
        });


        return ApiResponse::success(200, 'success', $pengeluaran);
    }

    public function getTotalPemasukan()
    {
        $pemasukan = Pemasukan::where('user_id', auth()->user()->id)
            ->whereYear('created_at', Carbon::now()->year)
            ->get();

        $total_pemasukan = $pemasukan->sum('nominal_pemasukan');

        return $total_pemasukan;
    }

    public function getTotalPengeluaran()
    {
        $pengeluaran = Pengeluaran::where('user_id', auth()->user()->id)
            ->whereYear('created_at', Carbon::now()->year)
            ->get();

        $total_pengeluaran = $pengeluaran->sum('jumlah_pengeluaran');

        return $total_pengeluaran;
    }

    public function getTotalSaldo()
    {
        $saldo = Saldo::where('user_id', auth()->user()->id)->orderBy('created_at', 'desc')->first();
        $saldo = $saldo->sisa_saldo;

        return $saldo;
    }
}
