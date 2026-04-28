<?php

namespace App\Repositories\Eloquent;

use App\Models\Category;
use App\Repositories\Contracts\CategoryRepositoryInterface;
use Illuminate\Contracts\Pagination\LengthAwarePaginator;
use Illuminate\Database\Eloquent\Collection;

class CategoryRepository implements CategoryRepositoryInterface
{
    public function paginate(int $perPage = 12): LengthAwarePaginator
    {
        return Category::query()
            ->with('parent')
            ->orderBy('sort_order')
            ->orderBy('name')
            ->paginate($perPage);
    }

    public function allForNavigation(): Collection
    {
        return Category::query()
            ->active()
            ->whereNull('parent_id')
            ->where('in_header', true)
            ->with([
                'children' => fn ($query) => $query
                    ->active()
                    ->with(['children' => fn ($nestedQuery) => $nestedQuery->active()->orderBy('sort_order')->orderBy('name')])
                    ->orderBy('sort_order')
                    ->orderBy('name'),
            ])
            ->orderBy('sort_order')
            ->orderBy('name')
            ->get();
    }

    public function allTopLevel(): Collection
    {
        return Category::query()
            ->whereNull('parent_id')
            ->orderBy('sort_order')
            ->orderBy('name')
            ->get();
    }

    public function findBySlug(string $slug): Category
    {
        return Category::query()
            ->active()
            ->where('slug', $slug)
            ->with([
                'children' => fn ($query) => $query
                    ->active()
                    ->with(['children' => fn ($nestedQuery) => $nestedQuery->active()->orderBy('sort_order')->orderBy('name')])
                    ->orderBy('sort_order')
                    ->orderBy('name'),
                'products' => fn ($query) => $query->active(),
            ])
            ->firstOrFail();
    }

    public function create(array $data): Category
    {
        return Category::query()->create($data);
    }

    public function update(Category $category, array $data): Category
    {
        $category->update($data);

        return $category->fresh(['parent']);
    }

    public function delete(Category $category): void
    {
        $category->delete();
    }
}
