<?php

namespace App\Http\Repositories\Category;

use LaravelEasyRepository\Repository;

interface CategoryRepository extends Repository
{
    public function whereName($name);
}
