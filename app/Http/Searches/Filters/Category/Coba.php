<?php
namespace App\Http\Searches\Filters\Category;

use Closure;
use Illuminate\Database\Eloquent\Builder;
use App\Http\Searches\Contracts\FilterContract;

class Coba implements FilterContract
{
	/** @var string|null */
	protected $coba;

	/**
	 * @param string|null $coba
	 * @return void
	 */
	public function __construct($coba)
	{
		$this->coba = $coba;
	}

	/**
	 * @return mixed
	 */
	public function handle(Builder $query, Closure $next)
	{
		if (!$this->keyword()) {
			return $next($query);
		}
		$query->where('coba', 'LIKE', '%' . $this->coba . '%');

		return $next($query);
	}

	/**
	 * Get coba keyword.
	 *
	 * @return mixed
	 */
	protected function keyword()
	{
		if ($this->coba) {
			return $this->coba;
	}

		$this->coba = request('coba', null);

		return request('coba');
	}
}