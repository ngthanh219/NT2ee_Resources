<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreRequest;
use App\Models\Store;
use Illuminate\Http\Request;

class StoreController extends Controller
{
    public function index(Request $request)
    {
        try {
            $pageName = 'Hệ thống cửa hàng';
            $stores = Store::orderByDesc('id');

            if (isset($request->key)) {
                $stores->where(function ($query) use ($request) {
                    return $query->where('address', 'like', "%$request->key%")
                        ->orWhere('phone', 'like', "%$request->key%")
                        ->orWhere('email', 'like', "%$request->key%");
                });
            }

            if (isset($request->view) && $request->view != config('base.view.all')) {
                $stores->where('view', $request->view);
            }

            $stores = $stores->paginate(config('base.pagination'));
            $compact = [
                'pageName',
                'request',
                'stores'
            ];

            return view('admin.store.index', compact($compact));
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

            return view('admin.store.create', compact($compact));
        } catch (\Exception $ex) {
            dd($ex->getMessage());
        }
    }

    public function store(StoreRequest $request)
    {
        try {
            $data = $request->all();
            Store::create($data);

            return redirect()->route('stores.index')->with('noti', [
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
            $store = Store::findOrFail($id);
            $pageName = 'Thông tin dữ liệu';
            $compact = [
                'pageName',
                'request',
                'store'
            ];

            return view('admin.store.edit', compact($compact));
        } catch (\Exception $ex) {
            dd($ex->getMessage());
        }
    }

    public function update(StoreRequest $request, $id)
    {
        try {
            $store = Store::findOrFail($id);
            $data = $request->all();
            $store->update($data);

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
            $store = Store::findOrFail($id);
            $store->delete();

            return redirect()->back()->with('noti', [
                'type' => config('base.noti.success'),
                'message' => 'Xóa thành công'
            ]);
        } catch (\Exception $ex) {
            dd($ex->getMessage());
        }
    }
}
