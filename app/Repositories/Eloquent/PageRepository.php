<?php

namespace App\Repositories\Eloquent;

use App\Models\Page;
use App\Repositories\Contracts\PageRepositoryInterface;
use Illuminate\Contracts\Pagination\LengthAwarePaginator;
use Illuminate\Support\Collection;

class PageRepository implements PageRepositoryInterface
{
    public function paginate(int $perPage = 12): LengthAwarePaginator
    {
        return Page::query()
            ->orderBy('section')
            ->orderBy('sort_order')
            ->orderBy('title')
            ->paginate($perPage);
    }

    public function footerGroups(): Collection
    {
        return Page::query()
            ->visible()
            ->orderBy('sort_order')
            ->orderBy('title')
            ->get()
            ->groupBy('section');
    }

    public function visiblePageBySlug(string $slug): Page
    {
        return Page::query()
            ->visible()
            ->where('slug', $slug)
            ->firstOrFail();
    }

    public function create(array $data): Page
    {
        return Page::query()->create($data);
    }

    public function update(Page $page, array $data): Page
    {
        $page->update($data);

        return $page->fresh();
    }

    public function delete(Page $page): void
    {
        $page->delete();
    }
}
