<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class LaporanController extends Controller
{
    public function index()
    {
        $breadcrumbs = [
            [
                'name' => 'Laporan',
                'url' => 'laporan.keuangan.index',
            ],
            [
                'name' => 'Keuangan',
                'url' => 'laporan.keuangan.index',
            ]
        ];

        return view('users.laporan.keuangan.index', compact('breadcrumbs'));
    }
}
