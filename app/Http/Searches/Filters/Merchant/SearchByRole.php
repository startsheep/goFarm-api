<?php
namespace App\Http\Searches\Filters\Merchant;

use Closure;
use Illuminate\Database\Eloquent\Builder;
use App\Http\Searches\Contracts\FilterContract;
use App\Models\Role;

class SearchByRole implements FilterContract
{
	/** @var string|null */
	protected $searchByRole;

	/**
	 * @param string|null $searchByRole
	 * @return void
	 */
	public function __construct($searchByRole)
	{
		$this->searchByRole = $searchByRole;
	}

	/**
	 * @return mixed
	 */
	public function handle(Builder $query, Closure $next)
	{
		$query->whereHas('user', function($queryUser) {
            $queryUser->where('role_id', Role::MERCHANT);
        });

		return $next($query);
	}

	/**
	 * Get searchByRole keyword.
	 *
	 * @return mixed
	 */
	protected function keyword()
	{
		if ($this->searchByRole) {
			return $this->searchByRole;
	}

		$this->searchByRole = request('search_by_role', null);

		return request('search_by_role');
	}
}
