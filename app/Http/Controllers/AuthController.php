<?php

namespace App\Http\Controllers;

use App\Helpers\ApiResponse;
use App\Service\AuthService;
use App\Service\RegisterService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;

class AuthController extends Controller
{

    public function __construct(AuthService $authService)
    {
        $this->authService = $authService;
    }

    public function login()
    {
        if (Auth::check()) {
            return redirect()->route('dashboard.index');
        }

        return view('auth.login');
    }

    public function loginProcess(Request $request)
    {
        // create logic for if user 3 time login and fill wrong password, user will be locked for 1 minutes



        return $this->authService->login($request->all());
    }

    public function register()
    {
        if (Auth::check()) {
            return redirect()->route('dashboard.index');
        }

        return view('auth.register');
    }

    public function registerProcess(Request $request)
    {

        $validation = Validator::make($request->all(), [
            'email' => 'required|email|unique:users,email',
            'username' => 'required|unique:users,username',
            'password' => 'required|min:8',
            'password_confirm' => 'required'
        ], [
            'email.required' => 'Email tidak boleh kosong',
            'email.email' => 'Email tidak valid',
            'email.unique' => 'Email sudah terdaftar',
            'username.required' => 'Username tidak boleh kosong',
            'username.unique' => 'Username sudah terdaftar',
            'password.required' => 'Password tidak boleh kosong',
            'password.min' => 'Password minimal 8 karakter',
            'password_confirm.required' => 'Konfirmasi password tidak boleh kosong'
        ]);

        if ($validation->fails()) {
            return ApiResponse::failed(422, $validation->messages(), $validation->errors()->first());
        }

        return $this->authService->register($request);
    }

    public function changePassword(Request $request)
    {
        $validated = Validator::make(
            $request->all(),
            [
                'password_lama' => 'required',
                'password_baru' => 'required|min:8',
            ],
            [
                'password_baru.required' => 'Password baru tidak boleh kosong',
                'password_baru.min' => 'Password minimal 8 karakter',
                'password_lama.required' => 'Password lama tidak boleh kosong'
            ]
        );

        if ($validated->fails()) {
            return ApiResponse::failed(422, $validated->messages(), $validated->errors()->first());
        }

        if (!Auth::attempt(['username' => Auth::user()->username, 'password' => $request->password_lama])) {
            return ApiResponse::failed(401, 'Password lama salah');
        }

        // don't same with old password
        if ($request->password_lama == $request->password_baru) {
            return ApiResponse::failed(401, 'Password baru tidak boleh sama dengan password lama');
        }

        return $this->authService->changePassword($request->all());
    }

    public function logout()
    {
        Auth::logout();
        return redirect()->route('login.index');
    }
}
