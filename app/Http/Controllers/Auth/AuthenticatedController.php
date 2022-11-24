<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Http\Repositories\User\UserRepository;
use Illuminate\Http\Request;

class AuthenticatedController extends Controller
{
    protected $userRepository;

    public function __construct(UserRepository $userRepository)
    {
        $this->userRepository = $userRepository;
    }

    public function __invoke()
    {
        $user = auth()->user();

        return response()->json([
            'user' => $user,
            'permission' => $this->permissionGenerate($user),
            'role' => $user->roles->pluck('name')
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
