<?php

namespace App\Http\Repositories\Admin;

use LaravelEasyRepository\Implementations\Eloquent;
use App\Models\Admin;
use App\Models\User;

class AdminRepositoryImplement extends Eloquent implements AdminRepository
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

    public function findByCriteria(array $criteria)
    {
        return $this->model->where($criteria)->first();
    }

    public function getByCriteria(array $criteria)
    {
        return $this->model->where($criteria)->get();
    }
}
