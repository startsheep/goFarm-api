<?php

namespace App\Http\Repositories\Customer;

use LaravelEasyRepository\Implementations\Eloquent;
use App\Models\Customer;
use App\Models\User;

class CustomerRepositoryImplement extends Eloquent implements CustomerRepository
{

    /**
     * Model class to be used in this repository for the common methods inside Eloquent
     * Don't remove or change $this->model variable name
     * @property Model|mixed $model;
     */
    protected $model;

    public function __construct(User $model)
    {
        $this->model = $model;
    }

    // Write something awesome :)
}
