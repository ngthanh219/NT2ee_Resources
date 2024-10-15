<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\AttributeRequest;
use App\Models\Attribute;
use Illuminate\Http\Request;

class AttributeController extends Controller
{
    public function index(Request $request)
    {
        try {
            $pageName = 'Loại sản phẩm';
            $attributes = Attribute::orderByDesc('id');

            if (isset($request->key)) {
                $attributes->where(function ($query) use ($request) {
                    return $query->where('name', 'like', "%$request->key%");
                });
            }

            if (isset($request->type) && $request->type != config('base.attribute_type.all')) {
                $attributes->where('type', $request->type);
            }

            $attributes = $attributes->paginate(config('base.pagination'));
            $compact = [
                'pageName',
                'request',
                'attributes'
            ];

            return view('admin.attribute.index', compact($compact));
        } catch (\Exception $ex) {
            dd($ex->getMessage());
        }
    }

    public function create(Request $request)
    {
        try {
            $pageName = 'Thêm thông tin';
            $attributeTypes = config('base.attribute_type_name');
            unset($attributeTypes[config('base.attribute_type.all')]);
            $compact = [
                'pageName',
                'request',
                'attributeTypes'
            ];

            return view('admin.attribute.create', compact($compact));
        } catch (\Exception $ex) {
            dd($ex->getMessage());
        }
    }

    public function store(AttributeRequest $request)
    {
        try {
            $data = $request->all();
            Attribute::create($data);

            return redirect()->route('attributes.index')->with('noti', [
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
            $attribute = Attribute::findOrFail($id);
            $pageName = 'Thông tin dữ liệu';
            $attributeTypes = config('base.attribute_type_name');
            unset($attributeTypes[config('base.attribute_type.all')]);
            $compact = [
                'pageName',
                'request',
                'attribute',
                'attributeTypes'
            ];

            return view('admin.attribute.edit', compact($compact));
        } catch (\Exception $ex) {
            dd($ex->getMessage());
        }
    }

    public function update(AttributeRequest $request, $id)
    {
        try {
            $attribute = Attribute::findOrFail($id);
            $data = $request->all();
            $attribute->update($data);

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
            $attribute = Attribute::findOrFail($id);
            $attribute->delete();

            return redirect()->back()->with('noti', [
                'type' => config('base.noti.success'),
                'message' => 'Xóa thành công'
            ]);
        } catch (\Exception $ex) {
            dd($ex->getMessage());
        }
    }
}
