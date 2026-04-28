<?php

namespace App\Repositories\Contracts;

use App\Models\Category;
use App\Models\Product;
use Illuminate\Contracts\Pagination\LengthAwarePaginator;
use Illuminate\Database\Eloquent\Collection;

interface ProductRepositoryInterface
{
    public function paginateForStore(?string $search = null, ?Category $category = null, int $perPage = 12): LengthAwarePaginator;

    public function paginateForAdmin(int $perPage = 12): LengthAwarePaginator;

    public function featuredBestSellers(int $limit = 8): Collection;

    public function featuredSwipeItems(int $limit = 4): Collection;

    public function findBySlug(string $slug): Product;

    public function create(array $data): Product;

    public function update(Product $product, array $data): Product;

    public function delete(Product $product): void;
}
