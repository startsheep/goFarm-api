<?php

namespace App\Http\Services\Customer;

use LaravelEasyRepository\Service;
use App\Http\Repositories\Customer\CustomerRepository;

class CustomerServiceImplement extends Service implements CustomerService{

     /**
     * don't change $this->mainRepository variable name
     * because used in extends service class
     */
     protected $mainRepository;

    public function __construct(CustomerRepository $mainRepository)
    {
      $this->mainRepository = $mainRepository;
    }

    // Define your custom methods :)
}
