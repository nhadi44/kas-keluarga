<?php

namespace App\Http\Controllers;

use App\Models\Pemasukan;
use App\Models\Saldo;
use App\Service\PemasukanService;
use Illuminate\Http\Request;

class PemasukanController extends Controller
{

    public function __construct(PemasukanService $pemasukanService)
    {
        $this->pemasukanService = $pemasukanService;
    }

    public function index()
    {
        $breadcrumbs = [
            [
                'name' => 'Manajemen Keuangan',
                'url' => 'pemasukan.index',
            ],
            [
                'name' => 'Data Pemasukan',
                'url' => 'pemasukan.index',
            ]
        ];

        $saldo = Saldo::where('user_id', auth()->user()->id)->orderBy('created_at', 'desc')->first();
        return view('users.keuangan.pemasukan.index', compact('breadcrumbs', 'saldo'));
    }

    public function getData()
    {
        return $this->pemasukanService->getAll();
    }

    public function getSaldoByUserId(Request $request)
    {
        return $this->pemasukanService->getSaldoByUserId($request->all());
    }

    public function store(Request $request)
    {
        return $this->pemasukanService->store($request->all());
    }

    public function update(Request $request)
    {
        return $this->pemasukanService->update($request->all());
    }

    public function delete(Request $request)
    {
        return $this->pemasukanService->delete($request->all());
    }
}
