<?php

namespace App\Http\Controllers\Pages;

use App\Http\Controllers\Controller;
use App\Http\Services\Dashboard\DashboardService;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    // Product, Transaksi, Dokter, Customer, Merchant, Admin, Role

    protected $dashboardService;

    public function __construct(DashboardService $dashboardService)
    {
        $this->dashboardService = $dashboardService;
    }

    public function __invoke()
    {
        $data = $this->dashboardService->all();
        return view('home.index', $data);
    }
}
