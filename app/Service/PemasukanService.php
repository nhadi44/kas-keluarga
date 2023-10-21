<?php

namespace App\Service;

use App\Helpers\ApiResponse;
use App\Models\Pemasukan;
use App\Models\Saldo;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;
use Spatie\FlareClient\Api;
use Yajra\DataTables\Facades\DataTables;

class PemasukanService
{

    public function getAll()
    {
        $query = "SELECT pemasukans.id, pemasukans.sumber_pemasukan, pemasukans.tanggal_pemasukan, pemasukans.nominal_pemasukan, pemasukans.created_at, pemasukans.updated_at, pemasukans.user_id, users.username,
            (SELECT SISA_SALDO FROM saldos WHERE saldos.user_id = " . auth()->user()->id . " ORDER BY saldos.created_at DESC LIMIT 1) AS sisa_saldo
            FROM pemasukans
            INNER JOIN users ON pemasukans.user_id = users.id
            WHERE pemasukans.user_id = " . auth()->user()->id . "
            ORDER BY pemasukans.created_at DESC
            ";

        $data = DB::select($query);
        return DataTables::of($data)->toJson();
    }

    public function getSaldoByUserId($data)
    {
        try {
            $saldo = Saldo::where('user_id', $data['id'])->orderBy('created_at', 'desc')->first();
            return ApiResponse::success(200, 'Data Saldo', $saldo);
        } catch (\Throwable $th) {
            return ApiResponse::failed(500, 'Internal Server Error', $th->getMessage());
        }
    }

    public function store($data)
    {
        try {
            $pemasukan = Pemasukan::create([
                'sumber_pemasukan' => $data['sumber_pemasukan'],
                'tanggal_pemasukan' => $data['tanggal_pemasukan'],
                'nominal_pemasukan' => $data['nominal_pemasukan'],
                'user_id' => auth()->user()->id
            ]);

            $saldo = Saldo::where('user_id', auth()->user()->id)
                ->orderBy('created_at', 'desc')->first();

            if ($saldo == null) {
                $saldo = Saldo::create([
                    'sisa_saldo' => $data['nominal_pemasukan'],
                    'user_id' => auth()->user()->id
                ]);
            } else {
                $saldo = Saldo::create([
                    'sisa_saldo' => $saldo->sisa_saldo + $data['nominal_pemasukan'],
                    'user_id' => auth()->user()->id
                ]);
            }

            $newJson = [
                'saldo' => [
                    'user_id' => $saldo->user_id,
                ],
                'pemasukan' => $pemasukan
            ];

            return ApiResponse::success(200, 'Data Pemasukan', $newJson);
        } catch (\Throwable $th) {
            return ApiResponse::failed(500, 'Internal Server Error', $th->getMessage());
        }
    }

    public function update($data)
    {
        try {
            $pemasukan = Pemasukan::find($data['id']);

            if ($pemasukan == null) {
                return ApiResponse::failed(404, 'Data Pemasukan Tidak Ditemukan');
            }

            $saldo = Saldo::where('user_id', auth()->user()->id)->orderBy('created_at', 'desc')->first();

            if ($data['nominal_pemasukan'] < $pemasukan->nominal_pemasukan) {
                $totalSaldo = $pemasukan->nominal_pemasukan - $data['nominal_pemasukan'];
                $totalSisaSaldo = $saldo->sisa_saldo - $totalSaldo;

                $saldoBaru = Saldo::create([
                    'sisa_saldo' => $totalSisaSaldo,
                    'user_id' => auth()->user()->id
                ]);

                $pemasukan->sumber_pemasukan = $data['sumber_pemasukan'];
                $pemasukan->tanggal_pemasukan = $data['tanggal_pemasukan'];
                $pemasukan->nominal_pemasukan = $data['nominal_pemasukan'];
                $pemasukan->updated_at = Carbon::now()->format('d M y');
                $pemasukan->user_id = auth()->user()->id;
                $pemasukan->save();
            } else {
                $totalSaldo = $data['nominal_pemasukan'] - $pemasukan->nominal_pemasukan;
                $totalSisaSaldo = $saldo->sisa_saldo + $totalSaldo;

                $saldoBaru = Saldo::create([
                    'sisa_saldo' => $totalSisaSaldo,
                    'user_id' => auth()->user()->id
                ]);

                $pemasukan->sumber_pemasukan = $data['sumber_pemasukan'];
                $pemasukan->tanggal_pemasukan = $data['tanggal_pemasukan'];
                $pemasukan->nominal_pemasukan = $data['nominal_pemasukan'];
                $pemasukan->updated_at = Carbon::now()->format('d M y');
                $pemasukan->user_id = auth()->user()->id;
                $pemasukan->save();
            }

            return ApiResponse::success(200, 'Update Data Pemasukan', $saldoBaru);
        } catch (\Throwable $th) {
            return ApiResponse::failed(500, 'Internal Server Error', $th->getMessage());
        }
    }

    public function delete($data)
    {
        try {
            //code...
            $pemasukan = Pemasukan::find($data['id']);

            if ($pemasukan == null) {
                return ApiResponse::failed(404, 'Data Pemasukan Tidak Ditemukan');
            }

            $saldo = Saldo::where('user_id', auth()->user()->id)->orderBy('created_at', 'desc')->first();

            $saldoBaru = $saldo->sisa_saldo - $pemasukan->nominal_pemasukan;

            $newData = [
                'sisa_saldo' => $saldo->sisa_saldo - $pemasukan->nominal_pemasukan,
                'pemasukan' => $pemasukan->nominal_pemasukan,
                'saldo_baru' => $saldoBaru
            ];

            Saldo::create([
                'sisa_saldo' => $saldoBaru,
                'user_id' => auth()->user()->id
            ]);

            $pemasukan->delete();

            return ApiResponse::success(200, 'Delete Data Pemasukan', $newData);
        } catch (\Throwable $th) {
            return ApiResponse::failed(500, 'Internal Server Error', $th->getMessage());
        }
    }
}
