<?php

namespace App\Http\Controllers\Site;

use App\Http\Controllers\Controller;
use App\Repositories\Contracts\PostRepositoryInterface;
use Illuminate\Http\Request;
use Illuminate\View\View;

class PostController extends Controller
{
    public function __construct(protected PostRepositoryInterface $posts)
    {
    }

    public function index(Request $request): View
    {
        return view('site.posts.index', [
            'posts' => $this->posts->paginatePublished($request->string('q')->toString()),
            'search' => $request->string('q')->toString(),
        ]);
    }

    public function show(string $slug): View
    {
        return view('site.posts.show', [
            'post' => $this->posts->findBySlug($slug),
        ]);
    }
}
