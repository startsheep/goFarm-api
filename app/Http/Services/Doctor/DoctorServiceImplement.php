<?php

namespace App\Http\Services\Doctor;

use LaravelEasyRepository\Service;
use App\Http\Repositories\Doctor\DoctorRepository;

class DoctorServiceImplement extends Service implements DoctorService{

     /**
     * don't change $this->mainRepository variable name
     * because used in extends service class
     */
     protected $mainRepository;

    public function __construct(DoctorRepository $mainRepository)
    {
      $this->mainRepository = $mainRepository;
    }

    // Define your custom methods :)
}
