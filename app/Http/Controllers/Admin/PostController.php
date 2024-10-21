<?php

namespace App\Http\Controllers\Admin;

use App\Helper;
use App\Http\Controllers\Controller;
use App\Http\Requests\PostRequest;
use App\Models\Post;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class PostController extends Controller
{
    public function index(Request $request)
    {
        try {
            $pageName = 'Bài viết';
            $posts = Post::orderByDesc('id');

            if (isset($request->key)) {
                $posts->where(function ($query) use ($request) {
                    return $query->where('name', 'like', "%$request->key%")
                        ->orWhere('short_description', 'like', "%$request->key%")
                        ->orWhere('content', 'like', "%$request->key%");
                });
            }

            if (isset($request->view) && $request->view != config('base.view.all')) {
                $posts->where('view', $request->view);
            }

            $posts = $posts->paginate(config('base.pagination'));
            $compact = [
                'pageName',
                'request',
                'posts'
            ];

            return view('admin.post.index', compact($compact));
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

            return view('admin.post.create', compact($compact));
        } catch (\Exception $ex) {
            dd($ex->getMessage());
        }
    }

    public function store(PostRequest $request)
    {
        try {
            $data = $request->all();
            $data['slug'] = Str::slug($data['name']);
            $existSlug = Post::where('slug', $data['slug'])->first();

            if ($existSlug) {
                return redirect()->back()->with('noti', [
                    'type' => config('base.noti.error'),
                    'message' => 'Tên bài viết đã tồn tại'
                ])->withInput();
            }

            $data['image'] = Helper::uploadFile(null, $request->file('image'), 'posts');
            Post::create($data);

            return redirect()->route('posts.index')->with('noti', [
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
            $post = Post::findOrFail($id);
            $pageName = 'Thông tin dữ liệu';
            $compact = [
                'pageName',
                'request',
                'post'
            ];

            return view('admin.post.edit', compact($compact));
        } catch (\Exception $ex) {
            dd($ex->getMessage());
        }
    }

    public function update(PostRequest $request, $id)
    {
        try {
            $post = Post::findOrFail($id);
            $data = $request->all();
            $data['slug'] = Str::slug($data['name']);
            $existSlug = Post::where('slug', $data['slug'])->where('id', '!=', $id)->first();

            if ($existSlug) {
                return redirect()->back()->with('noti', [
                    'type' => config('base.noti.error'),
                    'message' => 'Tên bài viết đã tồn tại'
                ])->withInput();
            }

            if (isset($data['image'])) {
                Helper::removeFile($post->image);
                $data['image'] = Helper::uploadFile($post->image, $request->file('image'), 'posts');
            }

            $post->update($data);

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
            $post = Post::findOrFail($id);
            Helper::removeFile($post->image);
            $post->delete();

            return redirect()->back()->with('noti', [
                'type' => config('base.noti.success'),
                'message' => 'Xóa thành công'
            ]);
        } catch (\Exception $ex) {
            dd($ex->getMessage());
        }
    }
}
