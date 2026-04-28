<?php

namespace App\Repositories\Contracts;

use App\Models\Category;
use Illuminate\Contracts\Pagination\LengthAwarePaginator;
use Illuminate\Database\Eloquent\Collection;

interface CategoryRepositoryInterface
{
    public function paginate(int $perPage = 12): LengthAwarePaginator;

    public function allForNavigation(): Collection;

    public function allTopLevel(): Collection;

    public function findBySlug(string $slug): Category;

    public function create(array $data): Category;

    public function update(Category $category, array $data): Category;

    public function delete(Category $category): void;
}
