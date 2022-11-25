<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Http\Repositories\User\UserRepository;
use App\Http\Requests\Auth\LoginRequest;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class LoginController extends Controller
{
    protected $userRepository;

    public function __construct(UserRepository $userRepository)
    {
        $this->middleware(['guest']);
        $this->userRepository = $userRepository;
    }

    public function __invoke(LoginRequest $request)
    {
        $user = $this->userRepository->wherePhone($request->phone);

        if (!$user) {
            return response()->json([
                'message' => 'telepon atau password salah!'
            ], Response::HTTP_BAD_REQUEST);
        }

        if (!Hash::check($request->password, $user->password)) {
            return response()->json([
                'message' => 'telepon atau password salah!'
            ], Response::HTTP_BAD_REQUEST);
        }

        $role = $user->roles->pluck('name');

        $token = $user->createToken('api', [$role]);

        Auth::login($user);

        return response()->json([
            'message' => 'Login success!',
            'data' => [
                'user' => [
                    'id' => $user->id,
                    'name' => $user->name,
                    'email' => $user->email,
                    'phone' => $user->phone,
                    'role_id' => $user->role_id,
                    'role' => $role
                ],
                'permission' => $this->permissionGenerate($user),
                'token' => $token->plainTextToken
            ]
        ]);
    }

    protected function permissionGenerate($user)
    {
        $permission = [];
        $perm = $user->getAllPermissions()->pluck('name');
        foreach ($perm as $item) {
            $var = explode('.', $item);
            $permission[$var[0]][] = $var[1];
        }
        return $permission;
    }
}
