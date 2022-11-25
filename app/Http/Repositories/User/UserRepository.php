<?php

namespace App\Http\Repositories\User;

use Illuminate\Database\Eloquent\Model;
use LaravelEasyRepository\Repository;

interface UserRepository extends Repository
{
    public function wherePhone($phone);

    public function findByCriteria(array $criteria): ?Model;
}
