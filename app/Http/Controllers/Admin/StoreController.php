<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreRequest;
use App\Http\Requests\SupplyProductRequest;
use App\Models\Inventory;
use App\Models\ProductPrice;
use App\Models\Store;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class StoreController extends Controller
{
    public function index(Request $request)
    {
        try {
            $pageName = 'Chi nhánh cửa hàng';
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
            DB::beginTransaction();
            $store = Store::findOrFail($id);

            if (config('base.env.multi_store')) {
                $store->load([
                    'inventories' => function ($query) {
                        return $query->where('quantity', '>', 0);
                    },
                    'orderDetails'
                ]);

                if ($store->inventories->count() > 0) {
                    return redirect()->back()->with('noti', [
                        'type' => config('base.noti.error'),
                        'message' => 'Không thể xóa chi nhánh đã có sản phẩm'
                    ]);
                }

                if ($store->orderDetails->count() > 0) {
                    return redirect()->back()->with('noti', [
                        'type' => config('base.noti.error'),
                        'message' => 'Không thể xóa chi nhánh đã có đơn hàng'
                    ]);
                }

                $store->inventories()->delete();
            }

            $store->delete();
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

    public function show(Request $request, $id)
    {
        if (!config('base.env.multi_store')) {
            abort(404);
        }

        try {
            $store = Store::findOrFail($id);
            $pageName = "Chi nhánh: $store->address";
            $productPrices = ProductPrice::with([
                'product',
                'inventory' => function ($inventory) use ($id) {
                    return $inventory->where('store_id', $id);
                }
            ])->whereHas('product', function ($product) use ($request) {
                $product->where('name', 'like', "%$request->key%");
            });

            $productPrices = $productPrices->orderByDesc('product_id')->paginate(config('base.pagination'));
            $compact = [
                'pageName',
                'request',
                'store',
                'productPrices'
            ];

            return view('admin.store.show', compact($compact));
        } catch (\Exception $ex) {
            dd($ex->getMessage());
        }
    }

    public function supplyProduct(SupplyProductRequest $request, $storeId)
    {
        if (!config('base.env.multi_store')) {
            abort(404);
        }

        try {
            $store = Store::findOrFail($storeId);
            $productPriceId = $request->product_price_id;
            $productPrice = ProductPrice::findOrFail($productPriceId);
            $inventory = Inventory::where('store_id', $storeId)
                ->where('product_price_id', $productPriceId)
                ->first();

            if ($request->type == config('base.supply_type.import') && $request->quantity > $productPrice->quantity) {
                return redirect()->back()->with('noti', [
                    'type' => config('base.noti.error'),
                    'message' => 'Số lượng trong kho không đủ'
                ]);
            }

            if ($request->type == config('base.supply_type.export')) {
                if (!$inventory) {
                    return redirect()->back()->with('noti', [
                        'type' => config('base.noti.error'),
                        'message' => 'Sản phẩm này chưa có trong chi nhánh'
                    ]);
                }

                if ($request->quantity > $inventory->quantity) {
                    return redirect()->back()->with('noti', [
                        'type' => config('base.noti.error'),
                        'message' => 'Số lượng trong chi nhánh không đủ'
                    ]);
                }
            }
        } catch (\Exception $ex) {
            dd($ex->getMessage());
        }

        try {
            DB::beginTransaction();

            if (!$inventory) {
                Inventory::create([
                    'store_id' => $storeId,
                    'product_price_id' => $productPriceId,
                    'quantity' => $request->quantity
                ]);
            } else {
                if ($request->type == config('base.supply_type.import')) {
                    $inventory->update([
                        'quantity' => $inventory->quantity + $request->quantity
                    ]);
                }

                if ($request->type == config('base.supply_type.export')) {
                    $inventory->update([
                        'quantity' => $inventory->quantity - $request->quantity
                    ]);

                    $productPrice->update([
                        'quantity' => $productPrice->quantity + $request->quantity
                    ]);
                }
            }

            if ($request->type == config('base.supply_type.import')) {
                $productPrice->update([
                    'quantity' => $productPrice->quantity - $request->quantity
                ]);
            }

            DB::commit();
            return redirect()->back()->with('noti', [
                'type' => config('base.noti.success'),
                'message' => config('base.supply_type_name.' . $request->type) . ' thành công'
            ]);
        } catch (\Exception $ex) {
            DB::rollBack();
            dd($ex->getMessage());
        }
    }
}
