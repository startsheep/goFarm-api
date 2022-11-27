<?php

namespace App\Http\Services\Dashboard;

use LaravelEasyRepository\Service;
use App\Http\Repositories\Dashboard\DashboardRepository;
use App\Models\Merchant;
use App\Models\Product;
use App\Models\Role;
use App\Models\User;

class DashboardServiceImplement extends Service implements DashboardService
{
    public function all()
    {
        $data = [
            'countMerchant' => $this->countMerchant(),
            'countCustomer' => $this->countCustomer(),
            'countProduct' => $this->countProduct(),
        ];

        return $data;
    }

    protected function countMerchant()
    {
        return Merchant::count();
    }

    protected function countCustomer()
    {
        return User::where('role_id', Role::CUSTOMER)->count();
    }

    protected function countProduct()
    {
        return Product::count();
    }
}
