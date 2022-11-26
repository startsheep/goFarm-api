<?php

namespace App\Http\Controllers;

use App\Http\Services\Admin\AdminService;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

class AdminController extends Controller
{
    protected $adminService;

    public function __construct(AdminService $adminService)
    {
        $this->adminService = $adminService;
    }

    public function updateStatus($id)
    {
        $customer = $this->adminService->findOrFail($id);

        $request['status'] = $customer->status ? 0 : 1;
        $status = $customer->status ? 'deactive' : 'active';

        $customer = $this->adminService->update($id, $request);

        return response()->json([
            'message' => "admin has been $status!",
            'status' => 'success',
            'data' => $status
        ], Response::HTTP_OK);
    }
}
