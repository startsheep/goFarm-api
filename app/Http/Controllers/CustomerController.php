<?php

namespace App\Http\Controllers;

use App\Http\Services\Customer\CustomerService;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

class CustomerController extends Controller
{
    protected $customerService;

    public function __construct(CustomerService $customerService)
    {
        $this->customerService = $customerService;
    }

    public function updateStatus($id)
    {
        $customer = $this->customerService->findOrFail($id);

        $request['status'] = $customer->status ? 0 : 1;
        $status = $customer->status ? 'deactive' : 'active';

        $customer = $this->customerService->update($id, $request);

        return response()->json([
            'message' => "customer has been $status!",
            'status' => 'success',
            'data' => $status
        ], Response::HTTP_OK);
    }
}
