<?php

namespace App\Service;

use App\Helpers\ApiResponse;
use App\Models\User;
use Illuminate\Support\Facades\Auth;

class AuthService
{
    public function register($data)
    {
        try {
            $register = User::create([
                'email' => $data['email'],
                'username' => $data['username'],
                'password' => bcrypt($data['password'])
            ]);

            return ApiResponse::success(200, 'Akun berhasil dibuat', $register);
        } catch (\Throwable $th) {
            return ApiResponse::failed(500, 'Terjadi kesalahan');
        }
    }

    public function login($data)
    {
        try {
            //code...
            $login = Auth::attempt([
                'username' => $data['username'],
                'password' => $data['password']
            ]);

            if ($login) {
                request()->session()->regenerate();
                return ApiResponse::success(200, 'Login berhasil', $login);
            } else {
                return ApiResponse::failed(401, 'Username atau password salah');
            }
        } catch (\Throwable $th) {
            //throw $th;
            return ApiResponse::failed(500, 'Terjadi kesalahan');
        }
    }

    public function changePassword($data)
    {
        $newPassword = $data['password_baru'];


        try {
            $user = User::find(Auth::user()->id);
            $user->password = bcrypt($newPassword);
            $user->save();

            // create new session
            Auth::attempt([
                'username' => $user->username,
                'password' => $newPassword
            ]);
        } catch (\Throwable $th) {
            return ApiResponse::failed(500, 'Terjadi kesalahan');
        }

        return ApiResponse::success(200, 'Password berhasil diubah', $data);
    }
}
