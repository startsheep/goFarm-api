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
use Illuminate\Support\Facades\Session;

class LoginController extends Controller
{
    use MessageFixer;

    protected $userRepository;

    public function __construct(UserRepository $userRepository)
    {
        $this->userRepository = $userRepository;
        $this->middleware('guest');
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
            $role = $user->roles->pluck('name');
            $token = $user->createToken('api', [$role]);

            Session::put('token', $token->plainTextToken);

            $request->session()->regenerate();

            return redirect()->intended(route('web.dashboard.index'));
        }
    }
}
