<?php

namespace App\Http\Searches\Filters\Product;

use Closure;
use Illuminate\Database\Eloquent\Builder;
use App\Http\Searches\Contracts\FilterContract;

class SearchByPrice implements FilterContract
{
    /** @var array|null */
    protected $price;

    /**
     * @param string|null $price
     * @return void
     */
    public function __construct($price)
    {
        $this->price = $price;
    }

    /**
     * @return mixed
     */
    public function handle(Builder $query, Closure $next)
    {
        if (!$this->keyword()[0] || !$this->keyword()[1]) {
            return $next($query);
        }

        $query->where(function ($query) {
            $query->whereBetween('price', $this->price);
        });

        return $next($query);
    }

    /**
     * Get price keyword.
     *
     * @return mixed
     */
    protected function keyword()
    {
        if ($this->price) {
            return $this->price;
        }

        $this->price = [request('price_from', null), request('price_to', null)];

        return [request('price_from'), request('price_to')];
    }
}
