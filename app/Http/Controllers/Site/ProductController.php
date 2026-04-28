<?php

namespace App\Http\Controllers\Site;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Repositories\Contracts\ProductRepositoryInterface;
use Illuminate\Http\Request;
use Illuminate\View\View;

class ProductController extends Controller
{
    public function __construct(protected ProductRepositoryInterface $products)
    {
    }

    public function index(Request $request): View
    {
        $category = $request->filled('category')
            ? Category::query()->where('slug', $request->string('category'))->first()
            : null;

        return view('site.products.index', [
            'products' => $this->products->paginateForStore($request->string('q')->toString(), $category),
            'activeCategory' => $category,
            'search' => $request->string('q')->toString(),
        ]);
    }

    public function show(string $slug): View
    {
        return view('site.products.show', [
            'product' => $this->products->findBySlug($slug),
        ]);
    }
}
