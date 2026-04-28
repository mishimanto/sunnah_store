<?php

namespace App\Http\Controllers\Site;

use App\Http\Controllers\Controller;
use App\Repositories\Contracts\CategoryRepositoryInterface;
use Illuminate\View\View;

class CategoryController extends Controller
{
    public function __construct(protected CategoryRepositoryInterface $categories)
    {
    }

    public function show(string $slug): View
    {
        return view('site.categories.show', [
            'category' => $this->categories->findBySlug($slug),
        ]);
    }
}
