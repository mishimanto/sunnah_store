<?php

namespace App\Repositories\Eloquent;

use App\Models\Category;
use App\Models\Product;
use App\Repositories\Contracts\ProductRepositoryInterface;
use Illuminate\Contracts\Pagination\LengthAwarePaginator;
use Illuminate\Database\Eloquent\Collection;

class ProductRepository implements ProductRepositoryInterface
{
    public function paginateForStore(?string $search = null, ?Category $category = null, int $perPage = 12): LengthAwarePaginator
    {
        return Product::query()
            ->active()
            ->with('category')
            ->when($category, fn ($query) => $query->where('category_id', $category->id))
            ->when($search, function ($query, string $search): void {
                $query->where(function ($builder) use ($search): void {
                    $builder
                        ->where('name', 'like', "%{$search}%")
                        ->orWhere('tag_label', 'like', "%{$search}%")
                        ->orWhere('short_description', 'like', "%{$search}%");
                });
            })
            ->orderByDesc('is_best_seller')
            ->orderBy('sort_order')
            ->orderBy('name')
            ->paginate($perPage)
            ->withQueryString();
    }

    public function paginateForAdmin(int $perPage = 12): LengthAwarePaginator
    {
        return Product::query()
            ->with('category')
            ->orderBy('sort_order')
            ->orderBy('name')
            ->paginate($perPage);
    }

    public function featuredBestSellers(int $limit = 8): Collection
    {
        return Product::query()
            ->active()
            ->where('is_best_seller', true)
            ->orderBy('sort_order')
            ->orderBy('name')
            ->limit($limit)
            ->get();
    }

    public function featuredSwipeItems(int $limit = 4): Collection
    {
        return Product::query()
            ->active()
            ->where('is_swipe_featured', true)
            ->orderBy('sort_order')
            ->orderBy('name')
            ->limit($limit)
            ->get();
    }

    public function findBySlug(string $slug): Product
    {
        return Product::query()
            ->active()
            ->with('category')
            ->where('slug', $slug)
            ->firstOrFail();
    }

    public function create(array $data): Product
    {
        return Product::query()->create($data);
    }

    public function update(Product $product, array $data): Product
    {
        $product->update($data);

        return $product->fresh(['category']);
    }

    public function delete(Product $product): void
    {
        $product->delete();
    }
}
