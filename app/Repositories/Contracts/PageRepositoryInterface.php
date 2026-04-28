<?php

namespace App\Repositories\Contracts;

use App\Models\Page;
use Illuminate\Contracts\Pagination\LengthAwarePaginator;
use Illuminate\Support\Collection;

interface PageRepositoryInterface
{
    public function paginate(int $perPage = 12): LengthAwarePaginator;

    public function footerGroups(): Collection;

    public function visiblePageBySlug(string $slug): Page;

    public function create(array $data): Page;

    public function update(Page $page, array $data): Page;

    public function delete(Page $page): void;
}
