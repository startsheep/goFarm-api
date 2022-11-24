<?php

namespace App\Http\Repositories\Merchant;

use LaravelEasyRepository\Implementations\Eloquent;
use App\Models\Merchant;
use App\Models\User;

class MerchantRepositoryImplement extends Eloquent implements MerchantRepository{

    /**
    * Model class to be used in this repository for the common methods inside Eloquent
    * Don't remove or change $this->model variable name
    * @property Model|mixed $model;
    */
    protected $model;

    public function __construct(Merchant $model)
    {
        $this->model = $model;
    }

    // Write something awesome :)
}
