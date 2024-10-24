<?php

namespace App\Http\Controllers\Admin;

use App\Helper;
use App\Http\Controllers\Controller;
use App\Http\Requests\ProductPriceRequest;
use App\Http\Requests\ProductRequest;
use App\Models\Attribute;
use App\Models\Category;
use App\Models\Product;
use App\Models\ProductPrice;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

class ProductController extends Controller
{
    public function index(Request $request)
    {
        try {
            $pageName = 'Sản phẩm';
            $products = Product::orderByDesc('id');

            if (isset($request->key)) {
                $products->where(function ($query) use ($request) {
                    return $query->where('name', 'like', "%$request->key%");
                });
            }

            if (isset($request->view) && $request->view != config('base.view.all')) {
                $products->where('view', $request->view);
            }

            $products = $products->paginate(config('base.pagination'));
            $compact = [
                'pageName',
                'request',
                'products'
            ];

            return view('admin.product.index', compact($compact));
        } catch (\Exception $ex) {
            dd($ex->getMessage());
        }
    }

    public function create(Request $request)
    {
        try {
            $pageName = 'Thêm thông tin';
            $categories = Category::orderBydesc('created_at')->get();
            $compact = [
                'pageName',
                'request',
                'categories'
            ];

            return view('admin.product.create', compact($compact));
        } catch (\Exception $ex) {
            dd($ex->getMessage());
        }
    }

    public function store(ProductRequest $request)
    {
        $data = $request->all();
        $data['image'] = [];

        try {
            $data['slug'] = Str::slug($data['name']);
            $existSlug = Product::where('slug', $data['slug'])->first();

            if ($existSlug) {
                return redirect()->back()->with('noti', [
                    'type' => config('base.noti.error'),
                    'message' => 'Tên sản phẩm đã tồn tại'
                ])->withInput();
            }

            foreach ($request->file('image') as $image) {
                $data['image'][] = Helper::uploadFile(null, $image, 'products');
            }
        } catch (\Exception $ex) {
            if ($data['image']) {
                foreach ($data['image'] as $image) {
                    Helper::removeFile($image);
                }
            }

            dd($ex->getMessage());
        }

        try {
            DB::beginTransaction();

            $product = Product::create($data);
            $product->categories()->sync($data['category_id']);

            DB::commit();

            return redirect()->route('products.index')->with('noti', [
                'type' => config('base.noti.success'),
                'message' => 'Lưu thành công'
            ]);
        } catch (\Exception $ex) {
            if ($data['image']) {
                foreach ($data['image'] as $image) {
                    Helper::removeFile($image);
                }
            }

            DB::rollBack();
            dd($ex->getMessage());
        }
    }

    public function edit(Request $request, $id)
    {
        try {
            $product = Product::findOrFail($id)->load('categories');
            $pageName = 'Thông tin dữ liệu';
            $productCategories = $product->categories->pluck('id')->toArray();
            $categories = Category::orderBydesc('created_at')->get();
            $attributes = Helper::getAttributes();
            $productPrices = ProductPrice::where('product_id', $id)->orderBy('sale_price')->get();
            $productPrice = null;

            if (isset($request->product_price_id)) {
                $productPrice = ProductPrice::findOrFail($request->product_price_id);
            }

            $compact = [
                'pageName',
                'request',
                'product',
                'productCategories',
                'categories',
                'attributes',
                'productPrices',
                'productPrice'
            ];

            return view('admin.product.edit', compact($compact));
        } catch (\Exception $ex) {
            dd($ex->getMessage());
        }
    }

    public function update(ProductRequest $request, $id)
    {
        $data = $request->all();
        $data['image'] = [];

        try {
            if (!isset($data['current_image']) && !$request->file('image')) {
                return redirect()->back()->with('noti', [
                    'type' => config('base.noti.error'),
                    'message' => 'Ảnh không được bỏ trống'
                ])->withInput();
            }

            $product = Product::findOrFail($id);
            $data['slug'] = Str::slug($data['name']);
            $data['image'] = $data['current_image'] ?? [];
            $existSlug = Product::where('slug', $data['slug'])->where('id', '!=', $id)->first();

            if ($existSlug) {
                return redirect()->back()->with('noti', [
                    'type' => config('base.noti.error'),
                    'message' => 'Tên sản phẩm đã tồn tại'
                ])->withInput();
            }

            if ($request->file('image')) {
                foreach ($request->file('image') as $image) {
                    $data['image'][] = Helper::uploadFile(null, $image, 'products');
                }
            }
        } catch (\Exception $ex) {
            dd($ex->getMessage());
        }

        try {
            DB::beginTransaction();

            $product->update($data);
            $product->categories()->sync($data['category_id']);

            DB::commit();

            return redirect()->route('products.edit', $id)->with('noti', [
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
            $product = Product::findOrFail($id);
            $product->load('prices');

            if ($product->prices->count() > 0) {
                return redirect()->back()->with('noti', [
                    'type' => config('base.noti.error'),
                    'message' => 'Không thể xóa sản phẩm đã có loại sản phẩm'
                ]);
            }

            $product->prices()->delete();
            $product->categories()->sync([]);

            foreach ($product->image as $image) {
                Helper::removeFile($image);
            }

            $product->delete();
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

    public function createProductPrices(ProductPriceRequest $request, $id)
    {
        try {
            Product::findOrFail($id);
            $data = $request->all();

            if (isset($request->attribute_ids)) {
                $attributeIds = $request->attribute_ids;

                foreach ($attributeIds as $key => $value) {
                    if ($value == '0') {
                        unset($attributeIds[$key]);
                    }
                }

                $attributeIds = array_values($attributeIds);

                if ($attributeIds) {
                    $existAttributesCount = Attribute::whereIn('id', $attributeIds)->count();

                    if ($existAttributesCount != count($attributeIds)) {
                        return redirect()->back()->with('noti', [
                            'type' => config('base.noti.error'),
                            'message' => 'Loại sản phẩm không hợp lệ'
                        ])->withInput();
                    }

                    $productPrices = ProductPrice::where('product_id', $id)
                        ->where('attribute_ids', '!=', null)
                        ->get();

                    foreach ($productPrices as $productPrice) {
                        $attributeCount = count($productPrice->attribute_ids);

                        foreach ($attributeIds as $attributeId) {
                            if (in_array($attributeId, $productPrice->attribute_ids)) {
                                $attributeCount--;
                            }
                        }

                        if ($attributeCount == 0) {
                            return redirect()->back()->with('noti', [
                                'type' => config('base.noti.error'),
                                'message' => 'Loại sản phẩm đã tồn tại'
                            ])->withInput();
                        }
                    }
                    foreach ($attributeIds as $key => $value) {
                        if ($value == '0') {
                            unset($attributeIds[$key]);
                        }
                    }

                    $attributeIds = array_values($attributeIds);
                    $data['attribute_ids'] = $attributeIds;
                } else {
                    $productPriceCount = ProductPrice::where('product_id', $id)
                        ->where('attribute_ids', null)
                        ->count();

                    if ($productPriceCount > 0) {
                        return redirect()->back()->with('noti', [
                            'type' => config('base.noti.error'),
                            'message' => 'Loại sản phẩm đã tồn tại'
                        ])->withInput();
                    }

                    unset($data['attribute_ids']);
                }
            }

            $data['product_id'] = $id;
            ProductPrice::create($data);

            return redirect()->route('products.edit', $id)->with('noti', [
                'type' => config('base.noti.success'),
                'message' => 'Lưu thành công'
            ]);
        } catch (\Exception $ex) {
            dd($ex->getMessage());
        }
    }

    public function deleteProductPrices(Request $request, $id, $productPriceId)
    {
        try {
            Product::findOrFail($id);
            $productPrice = ProductPrice::findOrFail($productPriceId);
            $productPrice->load('orderDetails');

            if ($productPrice->orderDetails->count() > 0) {
                return redirect()->route('products.edit', $id)->with('noti', [
                    'type' => config('base.noti.error'),
                    'message' => 'Không thể xóa loại sản phẩm đã có đơn hàng'
                ]);
            }

            $productPrice->delete();

            return redirect()->route('products.edit', $id)->with('noti', [
                'type' => config('base.noti.success'),
                'message' => 'Lưu thành công'
            ]);
        } catch (\Exception $ex) {
            dd($ex->getMessage());
        }
    }

    public function updateProductPrices(ProductPriceRequest $request, $id, $productPriceId)
    {
        try {
            Product::findOrFail($id);
            $productPrice = ProductPrice::findOrFail($productPriceId);
            $data = $request->only([
                'quantity',
                'price',
                'sale_percent',
                'sale_price'
            ]);

            $productPrice->update($data);

            return redirect()->route('products.edit', $id)->with('noti', [
                'type' => config('base.noti.success'),
                'message' => 'Lưu thành công'
            ]);
        } catch (\Exception $ex) {
            dd($ex->getMessage());
        }
    }
}
