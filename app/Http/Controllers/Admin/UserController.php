<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\UserRequest;
use App\Models\User;
use Illuminate\Http\Request;

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

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
