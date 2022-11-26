<?php

namespace App\Http\Repositories\Doctor;

use LaravelEasyRepository\Implementations\Eloquent;
use App\Models\Doctor;
use App\Models\User;

class DoctorRepositoryImplement extends Eloquent implements DoctorRepository
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
