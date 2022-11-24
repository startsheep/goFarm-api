<?php

namespace App\Http\Searches\Filters\Product;

use Closure;
use Illuminate\Database\Eloquent\Builder;
use App\Http\Searches\Contracts\FilterContract;

class SearchByCategory implements FilterContract
{
    /** @var string|null */
    protected $category;

    /**
     * @param string|null $category
     * @return void
     */
    public function __construct($category)
    {
        $this->category = $category;
    }

    /**
     * @return mixed
     */
    public function handle(Builder $query, Closure $next)
    {
        if (!$this->keyword()) {
            return $next($query);
        }

        $query->where(function ($query) {
            $query->whereHas('category', function ($category) {
                $category->where('id', $this->category)->orWhere('name', 'LIKE', '%' . $this->category . '%');
            });
        });

        return $next($query);
    }

    /**
     * Get category keyword.
     *
     * @return mixed
     */
    protected function keyword()
    {
        if ($this->category) {
            return $this->category;
        }

        $this->category = request('category', null);

        return request('category');
    }
}
