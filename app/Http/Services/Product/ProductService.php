<?php

namespace App\Http\Services\Product;

use LaravelEasyRepository\BaseService;

interface ProductService extends BaseService
{
    public function updateStatus($id, $attributes);
}
