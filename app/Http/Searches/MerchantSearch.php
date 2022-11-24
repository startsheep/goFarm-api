<?php

namespace App\Http\Searches;

use App\Http\Searches\Filters\Merchant\SearchByRole;
use App\Models\Merchant;
use App\Models\User;
use Illuminate\Database\Eloquent\Model;

class MerchantSearch extends HttpSearch
{
    protected function passable()
	{
		return Merchant::with(['user']);
	}

	protected function filters(): array
	{
		return [
            SearchByRole::class
		];
	}

	protected function thenReturn($merchantSearch)
	{
		return $merchantSearch;
	}
}
