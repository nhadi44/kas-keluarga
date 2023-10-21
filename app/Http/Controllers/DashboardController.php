<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class DashboardController extends Controller
{

    public function index()
    {

        $breadcrumbs = [
            [
                'name' => 'Dashboard',
                'url' => 'dashboard.index',
            ],

        ];

        return view('dashboard', compact('breadcrumbs'));
    }
}
