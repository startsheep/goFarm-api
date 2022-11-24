<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Http\Repositories\User\UserRepository;
use App\Http\Requests\Auth\RegistrationRequest;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

class RegistrationController extends Controller
{
    protected $userRepository;

    public function __construct(UserRepository $userRepository) {
        $this->userRepository = $userRepository;
    }

    public function __invoke(RegistrationRequest $request)
    {
        $request['password'] = 'password';
        $request['role_id'] = 3;

        $user = $this->userRepository->create($request->all());

        return response()->json([
            'message' => 'User has added!',
            'status' => 'success',
            'data' => $user
        ], Response::HTTP_CREATED);
    }
}
