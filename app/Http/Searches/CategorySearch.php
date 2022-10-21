<?php

namespace App\Http\Searches;

use App\Http\Searches\Filters\Category\Search;
use App\Models\Category;
use Illuminate\Database\Eloquent\Model;

class CategorySearch extends HttpSearch
{

    protected function passable()
    {
        return Category::query();
    }

    protected function filters(): array
    {
        return [
            Search::class
        ];
    }

    protected function thenReturn($categorySearch)
    {
        return $categorySearch;
    }
}
