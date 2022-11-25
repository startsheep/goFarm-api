<?php

namespace App\Http\Repositories\Admin;

use LaravelEasyRepository\Repository;

interface AdminRepository extends Repository
{
    public function findByCriteria(array $criteria);
    public function getByCriteria(array $criteria);
}
