<?php

namespace App\Http\Services\Admin;

use LaravelEasyRepository\Service;
use App\Http\Repositories\Admin\AdminRepository;
use App\Models\Role;

class AdminServiceImplement extends Service implements AdminService
{

    /**
     * don't change $this->mainRepository variable name
     * because used in extends service class
     */
    protected $mainRepository;

    public function __construct(AdminRepository $mainRepository)
    {
        $this->mainRepository = $mainRepository;
    }

    public function all()
    {
        $data = [
            'admins' => $this->getAdmin()
        ];

        return $data;
    }

    public function getAdmin()
    {
        return $this->mainRepository->getByCriteria(['role_id' => Role::ADMIN]);
    }
}
