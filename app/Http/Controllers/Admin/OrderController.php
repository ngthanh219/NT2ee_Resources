<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Order;
use App\Models\Product;
use App\Models\Store;
use App\Models\User;
use Illuminate\Http\Request;

class OrderController extends Controller
{
    public function index(Request $request)
    {
        try {
            $pageName = 'Đơn hàng';
            $orders = Order::orderByDesc('id');

            if (isset($request->key)) {
                $orders->where(function ($query) use ($request) {
                    return $query->where('address', 'like', "%$request->key%")
                        ->orWhere('phone', 'like', "%$request->key%")
                        ->orWhere('email', 'like', "%$request->key%");
                });
            }

            if (isset($request->view) && $request->view != config('base.view.all')) {
                $orders->where('view', $request->view);
            }

            $orders = $orders->paginate(config('base.pagination'));
            $compact = [
                'pageName',
                'request',
                'orders'
            ];

            return view('admin.order.index', compact($compact));
        } catch (\Exception $ex) {
            dd($ex->getMessage());
        }
    }

    public function create(Request $request)
    {
        try {
            $pageName = 'Thêm thông tin';
            $users = User::where('role_id', config('base.role_id.customer'))->orderByDesc('id')->get();
            $stores = Store::orderByDesc('id')->get();
            $products = Product::with([
                'prices' => function ($price) {
                    return $price->where('quantity', '>', 0)->orderBy('sale_price');
                }
            ])->orderByDesc('id')->get();

            $compact = [
                'pageName',
                'request',
                'users',
                'stores',
                'products'
            ];

            return view('admin.order.create', compact($compact));
        } catch (\Exception $ex) {
            dd($ex->getMessage());
        }
    }

    public function order(Request $request)
    {
        try {
            $data = $request->all();
            Order::create($data);

            return redirect()->route('orders.index')->with('noti', [
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
            $order = Order::findOrFail($id);
            $pageName = 'Thông tin dữ liệu';
            $compact = [
                'pageName',
                'request',
                'order'
            ];

            return view('admin.order.edit', compact($compact));
        } catch (\Exception $ex) {
            dd($ex->getMessage());
        }
    }

    public function update(Request $request, $id)
    {
        try {
            $order = Order::findOrFail($id);
            $data = $request->all();
            $order->update($data);

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
            $order = Order::findOrFail($id);
            $order->delete();

            return redirect()->back()->with('noti', [
                'type' => config('base.noti.success'),
                'message' => 'Xóa thành công'
            ]);
        } catch (\Exception $ex) {
            dd($ex->getMessage());
        }
    }
}
