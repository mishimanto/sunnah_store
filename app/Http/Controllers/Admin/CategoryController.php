<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\CategoryRequest;
use App\Models\Category;
use App\Repositories\Contracts\CategoryRepositoryInterface;
use App\Support\MediaUploadService;
use Illuminate\Http\RedirectResponse;
use Illuminate\View\View;

class CategoryController extends Controller
{
    public function __construct(
        protected CategoryRepositoryInterface $categories,
        protected MediaUploadService $uploads,
    ) {
    }

    public function index(): View
    {
        return view('admin.categories.index', [
            'categories' => $this->categories->paginate(),
        ]);
    }

    public function create(): View
    {
        return view('admin.categories.form', [
            'category' => new Category(),
            'parents' => $this->categories->allTopLevel(),
        ]);
    }

    public function store(CategoryRequest $request): RedirectResponse
    {
        $data = $request->validated();
        $data['image_path'] = $this->uploads->store($request->file('image'), null, 'categories');

        $this->categories->create($data);

        return redirect()->route('admin.categories.index')->with('success', 'Category created.');
    }

    public function edit(Category $category): View
    {
        return view('admin.categories.form', [
            'category' => $category,
            'parents' => $this->categories->allTopLevel()->where('id', '!=', $category->id),
        ]);
    }

    public function update(CategoryRequest $request, Category $category): RedirectResponse
    {
        $data = $request->validated();
        $data['image_path'] = $this->uploads->store($request->file('image'), $category->image_path, 'categories');

        $this->categories->update($category, $data);

        return redirect()->route('admin.categories.index')->with('success', 'Category updated.');
    }

    public function destroy(Category $category): RedirectResponse
    {
        $this->categories->delete($category);

        return back()->with('success', 'Category deleted.');
    }
}
