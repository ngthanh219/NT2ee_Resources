<?php

namespace App\Http\Controllers\Admin;

use App\Helper;
use App\Http\Controllers\Controller;
use App\Http\Requests\OrderRequest;
use App\Models\Inventory;
use App\Models\Order;
use App\Models\OrderDetail;
use App\Models\Product;
use App\Models\ProductPrice;
use App\Models\Store;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class OrderController extends Controller
{
    public function index(Request $request)
    {
        try {
            $pageName = 'Đơn hàng';
            $orders = Order::orderByDesc('id');

            if (isset($request->key)) {
                $orders->where(function ($query) use ($request) {
                    return $query->where('name', 'like', "%$request->key%")
                        ->orWhere('address', 'like', "%$request->key%")
                        ->orWhere('phone', 'like', "%$request->key%")
                        ->orWhere('email', 'like', "%$request->key%");
                });
            }

            if (isset($request->status) && $request->status != config('base.order_status.all')) {
                $orders->where('status', $request->status);
            }

            if (isset($request->is_paid) && $request->is_paid != config('base.is_paid.all')) {
                $orders->where('is_paid', $request->is_paid);
            }

            $orders = $orders->paginate(config('base.pagination'));
            $orderStatusName = Helper::getOrderStatusName(true);
            $isPaidName = Helper::getIsPaidName(true);
            $compact = [
                'pageName',
                'request',
                'orders',
                'orderStatusName',
                'isPaidName'
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
            $stores = [];

            if (!config('base.env.multi_store')) {
                $products = Product::with([
                    'prices' => function ($price) {
                        return $price->where('quantity', '>', 0)->orderBy('sale_price');
                    }
                ])->orderByDesc('id')->get();
            } else {
                $stores = Store::orderByDesc('id')->get();
                $storeId = null;

                if (count($stores) > 0) {
                    $storeId = $stores[0]->id;
                }

                if (isset($request->store_id)) {
                    $storeId = $request->store_id;
                }

                $products = Product::with([
                    'prices' => function ($price) {
                        return $price->with('inventory')->orderBy('sale_price');
                    }
                ])->whereHas('prices.inventory', function ($inventory) use ($storeId) {
                    return $inventory->where('store_id', $storeId)->where('quantity', '>', 0);
                })->orderByDesc('id')->get();
            }

            $orderStatusName = Helper::getOrderStatusName(false);
            $isPaidName = Helper::getIsPaidName(false);
            $compact = [
                'pageName',
                'request',
                'users',
                'stores',
                'products',
                'orderStatusName',
                'isPaidName'
            ];

            return view('admin.order.create', compact($compact));
        } catch (\Exception $ex) {
            dd($ex->getMessage());
        }
    }

    public function store(OrderRequest $request)
    {
        try {
            $orderData = [
                'user_id' => $request->user_id,
                'name' => $request->name,
                'email' => $request->email,
                'phone' => $request->phone,
                'address' => $request->address,
                'note' => $request->note,
                'total' => 0,
                'status' => $request->status,
                'is_paid' => $request->is_paid
            ];
            $orderDetailData = [];
            $productPriceIds = array_values(array_keys($request->product));
            $productPrices = ProductPrice::with('product')->whereIn('id', $productPriceIds)->get();

            if (config('base.env.multi_store')) {
                $store = Store::findOrFail($request->store_id);
            }

            if (count($productPriceIds) != count($productPrices)) {
                return redirect()->back()->with('noti', [
                    'type' => config('base.noti.error'),
                    'message' => 'Sản phẩm lựa chọn không hợp lệ'
                ]);
            }

            foreach ($productPrices as $price) {
                $quantity = $request->product[$price->id];
                $orderDetailTotal = $price->sale_price * $quantity;
                $orderData['total'] += $orderDetailTotal;
                $orderDetailDataItem = [
                    'product_price_id' => $price->id,
                    'product_name' => $price->product->name . ' - ' . $price->attribute_names,
                    'product_price' => $price->sale_price,
                    'quantity' => $quantity,
                    'total' => $orderDetailTotal,
                    'created_at' => now(),
                    'updated_at' => now()
                ];

                if (config('base.env.multi_store')) {
                    $orderDetailDataItem['store_id'] = $store->id;
                }

                $orderDetailData[] = $orderDetailDataItem;
            }
        } catch (\Exception $ex) {
            dd($ex->getMessage());
        }

        try {
            DB::beginTransaction();
            $order = Order::create($orderData);

            foreach ($orderDetailData as &$item) {
                $item['order_id'] = $order->id;

                if (!config('base.env.multi_store')) {
                    $productPrice = ProductPrice::findOrFail($item['product_price_id']);
                    $productPrice->update([
                        'quantity' => $productPrice->quantity - $item['quantity']
                    ]);
                } else {
                    $inventory = Inventory::where('store_id', $item['store_id'])->where('product_price_id', $item['product_price_id'])->first();
                    $inventory->update([
                        'quantity' => $inventory->quantity - $item['quantity']
                    ]);
                }
            }

            OrderDetail::insert($orderDetailData);
            DB::commit();

            return redirect()->route('orders.edit', $order->id)->with('noti', [
                'type' => config('base.noti.success'),
                'message' => 'Lưu thành công'
            ]);
        } catch (\Exception $ex) {
            DB::rollBack();
            dd($ex->getMessage());
        }
    }

    public function edit(Request $request, $id)
    {
        try {
            $order = Order::findOrFail($id)->load([
                'user',
                'orderDetails' => function ($orderDetail) {
                    return $orderDetail->with(['productPrice', 'store']);
                }
            ]);
            $pageName = 'Thông tin dữ liệu';
            $users = User::where('role_id', config('base.role_id.customer'))->orderByDesc('id')->get();
            $stores = Store::orderByDesc('id')->get();
            $products = Product::with([
                'prices' => function ($price) {
                    return $price->where('quantity', '>', 0)->orderBy('sale_price');
                }
            ])->orderByDesc('id')->get();
            $orderStatusName = Helper::getOrderStatusName(false);
            $isPaidName = Helper::getIsPaidName(false);
            $compact = [
                'pageName',
                'request',
                'order',
                'users',
                'stores',
                'products',
                'orderStatusName',
                'isPaidName'
            ];

            return view('admin.order.edit', compact($compact));
        } catch (\Exception $ex) {
            dd($ex->getMessage());
        }
    }

    public function update(OrderRequest $request, $id)
    {
        try {
            DB::beginTransaction();
            $order = Order::findOrFail($id);
            $order->load('orderDetails');
            $orderData = [
                'name' => $request->name,
                'email' => $request->email,
                'phone' => $request->phone,
                'address' => $request->address,
                'note' => $request->note,
                'status' => $request->status,
                'is_paid' => $request->is_paid
            ];

            if (
                $order->restock_on_cancel == config('base.restock_on_cancel.no') &&
                $request->status == config('base.order_status.cancelled') &&
                $request->is_paid == config('base.is_paid.no')
            ) {
                $orderData['restock_on_cancel'] = config('base.restock_on_cancel.yes');
                foreach ($order->orderDetails as $orderDetail) {
                    $productPrice = ProductPrice::findOrFail($orderDetail->product_price_id);
                    $productPrice->update([
                        'quantity' => $productPrice->quantity + $orderDetail->quantity
                    ]);
                }
            }

            if (
                $order->restock_on_cancel == config('base.restock_on_cancel.yes') &&
                $request->status != config('base.order_status.cancelled')
            ) {
                $orderData['restock_on_cancel'] = config('base.restock_on_cancel.no');
                foreach ($order->orderDetails as $orderDetail) {
                    $productPrice = ProductPrice::findOrFail($orderDetail->product_price_id);
                    $productPrice->update([
                        'quantity' => $productPrice->quantity - $orderDetail->quantity
                    ]);
                }
            }

            $order->update($orderData);
            DB::commit();

            return redirect()->route('orders.edit', $order->id)->with('noti', [
                'type' => config('base.noti.success'),
                'message' => 'Lưu thành công'
            ]);
        } catch (\Exception $ex) {
            DB::rollBack();
            dd($ex->getMessage());
        }
    }

    public function destroy($id)
    {
        try {
            DB::beginTransaction();

            $order = Order::findOrFail($id);
            $order->orderDetails()->delete();
            $order->delete();

            DB::commit();

            return redirect()->back()->with('noti', [
                'type' => config('base.noti.success'),
                'message' => 'Xóa thành công'
            ]);
        } catch (\Exception $ex) {
            DB::rollBack();
            dd($ex->getMessage());
        }
    }

    public function getBilling(Request $request, $id)
    {
        try {
            $order = Order::findOrFail($id);
            $order->load('orderDetails');
            $compact = [
                'request',
                'order',
            ];

            return view('admin.order.billing', compact($compact));
        } catch (\Exception $ex) {
            DB::rollBack();
            dd($ex->getMessage());
        }
    }
}
