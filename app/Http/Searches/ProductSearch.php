<?php

namespace App\Http\Searches;

use App\Models\Product;
use Illuminate\Database\Eloquent\Model;

class ProductSearch extends HttpSearch
{

    protected function passable()
    {
        return Product::query();
    }

    protected function filters(): array
    {
        return [];
    }

    protected function thenReturn($productSearch)
    {
        return $productSearch;
    }
}
