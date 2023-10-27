<?php

namespace App\Service;

use App\Helpers\ApiResponse;
use App\Models\Pengeluaran;
use App\Models\Saldo;
use Illuminate\Support\Facades\DB;
use Yajra\DataTables\Facades\DataTables;

class PengeluaranService
{
    public function getAll()
    {
        $query = "
        SELECT id, tanggal_pengeluaran, kategori_pengeluaran, deskripsi_pengeluaran, jumlah_pengeluaran, jumlah_pengeluaran, user_id, metode_pengeluaran,  created_at, updated_at FROM pengeluarans
        WHERE user_id = " . auth()->user()->id . "
        ";

        $data = DB::select($query);
        return DataTables::of($data)->toJson();
    }

    public function getSaldoByUserId($data)
    {
        $saldo = Saldo::where('user_id', $data['id'])->orderBy('created_at', 'desc')->first();
        return ApiResponse::success(200, 'Data Saldo', $saldo);
    }

    public function store($data)
    {
        try {
            $saldo = Saldo::where('user_id', auth()->user()->id)
                ->orderBy(
                    'created_at',
                    'desc'
                )->first();

            if ($saldo == null) {
                $saldo = Saldo::create([
                    'sisa_saldo' => "-" . $data['jumlah_pengeluaran'],
                    'user_id' => auth()->user()->id
                ]);
            }

            $saldoaBaru = $saldo->sisa_saldo - $data['jumlah_pengeluaran'];

            $saldo = Saldo::create([
                'sisa_saldo' => $saldoaBaru,
                'user_id' => auth()->user()->id
            ]);

            $pengeluaran = Pengeluaran::create([
                'tanggal_pengeluaran' => $data['tanggal_pengeluaran'],
                'kategori_pengeluaran' => $data['kategori_pengeluaran'],
                'deskripsi_pengeluaran' => $data['deskripsi_pengeluaran'],
                'jumlah_pengeluaran' => $data['jumlah_pengeluaran'],
                'metode_pengeluaran' => $data['metode_pengeluaran'],
                'user_id' => auth()->user()->id,
            ]);

            $newJson = [
                'saldo' => [
                    'user_id' => $saldo->user_id,
                ],
                'pengeluaran' => $pengeluaran
            ];

            return ApiResponse::success(200, 'Data Pengeluaran', $newJson);
        } catch (\Throwable $th) {
            return ApiResponse::failed(500, 'Error', $th->getMessage());
        }
    }

    public function update($data)
    {
        try {
            $saldo = Saldo::where('user_id', auth()->user()->id)
                ->orderBy(
                    'created_at',
                    'desc'
                )->first();
            $pengeluaran = Pengeluaran::where('id', $data['id'])->first();

            if ($pengeluaran == null) {
                return ApiResponse::failed(404, 'Data Pengeluaran Tidak Ditemukan');
            }

            if ($data['jumlah_pengeluaran'] < $pengeluaran->jumlah_pengeluaran) {
                $saldoBaru = $saldo->sisa_saldo + $pengeluaran->jumlah_pengeluaran - $data['jumlah_pengeluaran'];
            } else {
                $saldoBaru = $saldo->sisa_saldo - $data['jumlah_pengeluaran'];
            }

            $saldo = Saldo::create([
                'sisa_saldo' => $saldoBaru,
                'user_id' => auth()->user()->id
            ]);

            $pengeluaran->tanggal_pengeluaran = $data['tanggal_pengeluaran'];
            $pengeluaran->kategori_pengeluaran = $data['kategori_pengeluaran'];
            $pengeluaran->deskripsi_pengeluaran = $data['deskripsi_pengeluaran'];
            $pengeluaran->jumlah_pengeluaran = $data['jumlah_pengeluaran'];
            $pengeluaran->metode_pengeluaran = $data['metode_pengeluaran'];
            $pengeluaran->user_id = auth()->user()->id;
            $pengeluaran->save();

            $json = [
                'saldo' => $saldo,
                'pengeluaran' => $pengeluaran,
                'saldoBaru' => $saldoBaru
            ];

            return ApiResponse::success(200, 'Data Pengeluaran', $json);
        } catch (\Throwable $th) {
            return ApiResponse::failed(500, 'Error', $th->getMessage());
        }
    }

    public function delete($data)
    {
        try {

            $saldo = Saldo::where('user_id', auth()->user()->id)
                ->orderBy(
                    'created_at',
                    'desc'
                )->first();

            $pengeluaran = Pengeluaran::where('id', $data['id'])->first();

            if ($pengeluaran == null) {
                return ApiResponse::failed(404, 'Data Pengeluaran Tidak Ditemukan');
            }

            $saldoBaru = $saldo->sisa_saldo + $pengeluaran->jumlah_pengeluaran;

            $saldo = Saldo::create([
                'sisa_saldo' => $saldoBaru,
                'user_id' => auth()->user()->id
            ]);

            $pengeluaran->delete();

            $json = [
                'saldo' => $saldo,
                'pengeluaran' => $pengeluaran,
            ];

            return ApiResponse::success(200, 'Data Pengeluaran', $json);
        } catch (\Throwable $th) {
            //throw $th;
        }
    }
}
