<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\CategoryRequest;
use App\Models\Category;
use Illuminate\Http\Request;

class CategoryController extends Controller
{
    public function index(Request $request)
    {
        try {
            $pageName = 'Thông tin danh mục';
            $categories = Category::orderByDesc('id');

            if (isset($request->key)) {
                $categories->where(function ($query) use ($request) {
                    return $query->where('name', 'like', "%$request->key%");
                });
            }

            if (isset($request->parent_id) && $request->parent_id != 0) {
                $categories->where('parent_id', $request->parent_id);
            } else {
                $categories->where('parent_id', config('base.parent_category_default'))->withCount('children');
            }

            if (isset($request->view) && $request->view != config('base.view.all')) {
                $categories->where('view', $request->view);
            }

            $categories = $categories->paginate(config('base.pagination'));
            $parentCategories = Category::where('parent_id', config('base.parent_category_default'))->orderByDesc('id')->get();
            $compact = [
                'pageName',
                'request',
                'categories',
                'parentCategories'
            ];

            return view('admin.category.index', compact($compact));
        } catch (\Exception $ex) {
            dd($ex->getMessage());
        }
    }

    public function create(Request $request)
    {
        try {
            $pageName = 'Thêm thông tin';
            $parentCategories = Category::where('parent_id', config('base.parent_category_default'))->orderByDesc('id')->get();
            $compact = [
                'pageName',
                'request',
                'parentCategories'
            ];

            return view('admin.category.create', compact($compact));
        } catch (\Exception $ex) {
            dd($ex->getMessage());
        }
    }

    public function store(CategoryRequest $request)
    {
        try {
            $data = $request->all();
            Category::create($data);

            return redirect()->route('categories.index')->with('noti', [
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
            $category = Category::findOrFail($id);
            $pageName = 'Thông tin dữ liệu';
            $parentCategories = Category::where('parent_id', config('base.parent_category_default'))
                ->where('id', '!=', $id)
                ->orderByDesc('id')
                ->get();

            $compact = [
                'pageName',
                'request',
                'category',
                'parentCategories'
            ];

            return view('admin.category.edit', compact($compact));
        } catch (\Exception $ex) {
            dd($ex->getMessage());
        }
    }

    public function update(CategoryRequest $request, $id)
    {
        try {
            $category = Category::findOrFail($id);
            $data = $request->all();
            $category->update($data);

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
            $category = Category::findOrFail($id);
            $childrenCategory = Category::where('parent_id', $id)->first();

            if ($childrenCategory) {
                return redirect()->back()->with('noti', [
                    'type' => config('base.noti.error'),
                    'message' => 'Danh mục này đang có dữ liệu'
                ]);
            }

            $category->delete();

            return redirect()->back()->with('noti', [
                'type' => config('base.noti.success'),
                'message' => 'Xóa thành công'
            ]);
        } catch (\Exception $ex) {
            dd($ex->getMessage());
        }
    }
}
