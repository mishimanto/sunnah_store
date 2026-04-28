<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\PostRequest;
use App\Models\Post;
use App\Repositories\Contracts\PostRepositoryInterface;
use App\Support\MediaUploadService;
use Illuminate\Http\RedirectResponse;
use Illuminate\View\View;

class PostController extends Controller
{
    public function __construct(
        protected PostRepositoryInterface $posts,
        protected MediaUploadService $uploads,
    ) {
    }

    public function index(): View
    {
        return view('admin.posts.index', [
            'posts' => $this->posts->paginateForAdmin(),
        ]);
    }

    public function create(): View
    {
        return view('admin.posts.form', [
            'post' => new Post(),
        ]);
    }

    public function store(PostRequest $request): RedirectResponse
    {
        $data = $request->validated();
        $data['image_path'] = $this->uploads->store($request->file('image'), null, 'posts');

        $this->posts->create($data);

        return redirect()->route('admin.posts.index')->with('success', 'Post created.');
    }

    public function edit(Post $post): View
    {
        return view('admin.posts.form', ['post' => $post]);
    }

    public function update(PostRequest $request, Post $post): RedirectResponse
    {
        $data = $request->validated();
        $data['image_path'] = $this->uploads->store($request->file('image'), $post->image_path, 'posts');

        $this->posts->update($post, $data);

        return redirect()->route('admin.posts.index')->with('success', 'Post updated.');
    }

    public function destroy(Post $post): RedirectResponse
    {
        $this->posts->delete($post);

        return back()->with('success', 'Post deleted.');
    }
}
