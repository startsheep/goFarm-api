<?php

namespace App\Http\Services\Merchant;

use LaravelEasyRepository\Service;
use App\Http\Repositories\Merchant\MerchantRepository;

class MerchantServiceImplement extends Service implements MerchantService{

     /**
     * don't change $this->mainRepository variable name
     * because used in extends service class
     */
     protected $mainRepository;

    public function __construct(MerchantRepository $mainRepository)
    {
      $this->mainRepository = $mainRepository;
    }

    // Define your custom methods :)
}
