<?php

namespace App\Http\Controllers;

use App\Service\DashboardService;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class DashboardController extends Controller
{

    public function __construct(DashboardService $dashboardService)
    {
        $this->dashboardService = $dashboardService;
    }

    public function index()
    {
        $breadcrumbs = [
            [
                'name' => 'Dashboard',
                'url' => 'dashboard.index',
            ],

        ];

        $pemasukan = $this->dashboardService->getTotalPemasukan();
        $pengeluaran = $this->dashboardService->getTotalPengeluaran();
        $saldo = $this->dashboardService->getTotalSaldo();

        return view('dashboard', compact('breadcrumbs', 'pemasukan', 'pengeluaran', 'saldo'));
    }

    public function getDataDiagramPemasukan(): JsonResponse
    {
        return $this->dashboardService->getDataDiagramPemasukan();
    }

    public function getDataPiePengeluaran(): JsonResponse
    {
        return $this->dashboardService->getDataPiePengeluaran();
    }
}
