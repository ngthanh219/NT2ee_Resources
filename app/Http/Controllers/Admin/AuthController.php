<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\LoginRequest;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AuthController extends Controller
{
    public function loginForm(Request $request)
    {
        $auth = Auth::guard('admin')->check();
        if ($auth) {
            return redirect()->route('users.index');
        }

        $pageName = 'Đăng nhập quản trị';
        $compact = [
            'pageName'
        ];

        return view('admin.login', compact($compact));
    }

    public function login(LoginRequest $request)
    {
        try {
            $auth = Auth::guard('admin')->attempt([
                'role_id' => [
                    config('base.role_id.admin'),
                    config('base.role_id.manage'),
                    config('base.role_id.staff')
                ],
                'email' => $request->email,
                'password' => $request->password
            ]);

            if (!$auth) {
                return redirect()->back()->with('noti', [
                    'type' => config('base.noti.error'),
                    'message' => 'Thông tin không chính xác'
                ])->withInput();
            }
            
            return redirect()->route('users.index');
        } catch (\Exception $ex) {
            dd($ex->getMessage());
        }
    }

    public function logout(Request $request)
    {
        try {
            Auth::guard('admin')->logout();

            return redirect()->route('login.form');
        } catch (\Exception $ex) {
            dd($ex->getMessage());
        }
    }
}
