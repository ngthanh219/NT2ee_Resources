<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\UserRequest;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class UserController extends Controller
{
    public function index(Request $request)
    {
        try {
            $pageName = 'Thông tin người dùng';
            $users = User::orderByDesc('id');

            if (isset($request->key)) {
                $users->where(function ($query) use ($request) {
                    return $query->where('name', 'like', "%$request->key%")
                        ->orWhere('email', 'like', "%$request->key%")
                        ->orWhere('phone', 'like', "%$request->key%");
                });
            }

            if (isset($request->role_id) && $request->role_id != config('base.role_id.all')) {
                $users->where('role_id', $request->role_id);
            }

            $users = $users->paginate(config('base.pagination'));

            $compact = [
                'pageName',
                'request',
                'users'
            ];

            return view('admin.user.index', compact($compact));
        } catch (\Exception $ex) {
            dd($ex->getMessage());
        }
    }

    public function create(Request $request)
    {
        try {
            $pageName = 'Thêm thông tin';
            $compact = [
                'pageName',
                'request'
            ];

            return view('admin.user.create', compact($compact));
        } catch (\Exception $ex) {
            dd($ex->getMessage());
        }
    }

    public function store(UserRequest $request)
    {
        try {
            $data = $request->all();
            $data['password'] = bcrypt($data['password']);
            User::create($data);

            return redirect()->route('users.index')->with('noti', [
                'type' => config('base.noti.success'),
                'message' => 'Lưu thành công'
            ]);
        } catch (\Exception $ex) {
            dd($ex->getMessage());
        }
    }

    public function edit(Request $request, $id)
    {
        try {
            $user = User::findOrFail($id);
            $pageName = 'Thông tin dữ liệu';
            $compact = [
                'pageName',
                'request',
                'user'
            ];

            return view('admin.user.edit', compact($compact));
        } catch (\Exception $ex) {
            dd($ex->getMessage());
        }
    }

    public function update(UserRequest $request, $id)
    {
        try {
            $user = User::findOrFail($id);
            $data = $request->all();

            if ($data['password'] == null) {
                unset($data['password']);
            } else {
                $data['password'] = bcrypt($data['password']);
            }

            $user->update($data);

            return redirect()->back()->with('noti', [
                'type' => config('base.noti.success'),
                'message' => 'Lưu thành công'
            ]);
        } catch (\Exception $ex) {
            dd($ex->getMessage());
        }
    }

    public function destroy($id)
    {
        try {
            $user = User::findOrFail($id);
            if (Auth::guard('admin')->user()->id == $user->id) {
                return redirect()->back()->with('noti', [
                    'type' => config('base.noti.error'),
                    'message' => 'Không thể xóa tài khoản đang đăng nhập'
                ]);
            }

            $user->load('orders');
            if ($user->orders->count() > 0) {
                return redirect()->back()->with('noti', [
                    'type' => config('base.noti.error'),
                    'message' => 'Không thể xóa tài khoản đã có đơn hàng'
                ]);
            }

            $user->delete();

            return redirect()->back()->with('noti', [
                'type' => config('base.noti.success'),
                'message' => 'Xóa thành công'
            ]);
        } catch (\Exception $ex) {
            dd($ex->getMessage());
        }
    }
}
