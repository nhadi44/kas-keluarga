<?php

namespace App\Http\Controllers;

use App\Models\Saldo;
use App\Service\PengeluaranService;
use Illuminate\Http\Request;

class PengeluaranController extends Controller
{

    public function __construct(PengeluaranService $pengeluaranService)
    {
        $this->pengeluaranService = $pengeluaranService;
    }

    public function index()
    {
        $breadcrumbs = [
            [
                'name' => 'Manajemen Keuangan',
                'url' => 'pengeluaran.index',
            ],
            [
                'name' => 'Data Pengeluaran',
                'url' => 'pengeluaran.index',
            ]
        ];

        $saldo = Saldo::where('user_id', auth()->user()->id)->orderBy('created_at', 'desc')->first();
        // parse to int
        // $saldo = (int) $saldo->sisa_saldo;
        return view('users.keuangan.pengeluaran.index', compact('breadcrumbs', 'saldo'));
    }

    public function getAll()
    {
        return $this->pengeluaranService->getAll();
    }

    public function getSaldoByUserId(Request $request)
    {
        
        return $this->pengeluaranService->getSaldoByUserId($request->all());
    }

    public function store(Request $request)
    {
        return $this->pengeluaranService->store($request->all());
    }

    public function update(Request $request)
    {
        return $this->pengeluaranService->update($request->all());
    }

    public function delete(Request $request)
    {
        return $this->pengeluaranService->delete($request->all());
    }
}
