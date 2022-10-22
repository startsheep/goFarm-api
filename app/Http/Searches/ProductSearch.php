<?php

namespace App\Http\Searches;

use App\Http\Searches\Filters\Product\Search;
use App\Http\Searches\Filters\Product\SearchByCategory;
use App\Http\Searches\Filters\Product\SearchByPrice;
use App\Http\Searches\Filters\Product\SearchByUser;
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
        return [
            Search::class,
            SearchByCategory::class,
            SearchByUser::class,
            SearchByPrice::class
        ];
    }

    protected function thenReturn($productSearch)
    {
        return $productSearch;
    }
}
