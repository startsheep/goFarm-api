<?php

namespace App\Http\Repositories\Doctor;

use LaravelEasyRepository\Repository;

interface DoctorRepository extends Repository
{
    public function findByCriteria(array $criteria);
    public function getByCriteria(array $criteria);
}
