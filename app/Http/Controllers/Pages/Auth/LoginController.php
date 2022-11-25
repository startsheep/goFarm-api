<?php

namespace App\Http\Controllers\Pages\Auth;

use App\Http\Controllers\Controller;
use App\Http\Repositories\User\UserRepository;
use App\Http\Requests\WEB\Auth\LoginRequest;
use App\Http\Traits\MessageFixer;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class LoginController extends Controller
{
    use MessageFixer;

    protected $userRepository;

    public function __construct(UserRepository $userRepository)
    {
        $this->userRepository = $userRepository;
    }

    public function index()
    {
        return view('auth.login');
    }

    public function process(LoginRequest $request)
    {
        $user = $this->userRepository->findByCriteria(['email' => $request->email]);
        if (!$user) {
            return $this->error('email atau password salah!');
        }

        if (!Hash::check($request->password, $user->password)) {
            return $this->error('email atau password salah!');
        }

        if (Auth::attempt(['email' => $request->email, 'password' => $request->password])) {
            $request->session()->regenerate();

            return redirect()->intended(route('web.dashboard.index'));
        }
    }
}
