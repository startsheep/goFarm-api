<?php

namespace App\Http\Services\Dashboard;

use LaravelEasyRepository\Service;
use App\Http\Repositories\Dashboard\DashboardRepository;
use App\Models\Merchant;
use App\Models\Role;
use App\Models\User;

class DashboardServiceImplement extends Service implements DashboardService
{
    public function all()
    {
        $data = [
            'countAdmin' => $this->countAdmin(),
            'countMerchant' => $this->countMerchant(),
            'countCustomer' => $this->countCustomer(),
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

    protected function countAdmin()
    {
        return User::where('role_id', Role::ADMIN)->count();
    }
}
