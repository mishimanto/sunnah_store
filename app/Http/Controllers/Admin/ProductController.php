<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\ProductRequest;
use App\Models\Product;
use App\Repositories\Contracts\CategoryRepositoryInterface;
use App\Repositories\Contracts\ProductRepositoryInterface;
use App\Support\MediaUploadService;
use Illuminate\Http\RedirectResponse;
use Illuminate\View\View;

class ProductController extends Controller
{
    public function __construct(
        protected ProductRepositoryInterface $products,
        protected CategoryRepositoryInterface $categories,
        protected MediaUploadService $uploads,
    ) {
    }

    public function index(): View
    {
        return view('admin.products.index', [
            'products' => $this->products->paginateForAdmin(),
        ]);
    }

    public function create(): View
    {
        return view('admin.products.form', [
            'product' => new Product(),
            'categories' => $this->categories->allTopLevel(),
        ]);
    }

    public function store(ProductRequest $request): RedirectResponse
    {
        $data = $request->validated();
        $data['image_path'] = $this->uploads->store($request->file('image'), null, 'products');

        $this->products->create($data);

        return redirect()->route('admin.products.index')->with('success', 'Product created.');
    }

    public function edit(Product $product): View
    {
        return view('admin.products.form', [
            'product' => $product,
            'categories' => $this->categories->allTopLevel(),
        ]);
    }

    public function update(ProductRequest $request, Product $product): RedirectResponse
    {
        $data = $request->validated();
        $data['image_path'] = $this->uploads->store($request->file('image'), $product->image_path, 'products');

        $this->products->update($product, $data);

        return redirect()->route('admin.products.index')->with('success', 'Product updated.');
    }

    public function destroy(Product $product): RedirectResponse
    {
        $this->products->delete($product);

        return back()->with('success', 'Product deleted.');
    }
}
