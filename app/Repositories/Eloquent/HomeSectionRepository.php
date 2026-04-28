<?php

namespace App\Repositories\Eloquent;

use App\Models\HomeSection;
use App\Repositories\Contracts\HomeSectionRepositoryInterface;
use Illuminate\Contracts\Pagination\LengthAwarePaginator;
use Illuminate\Support\Collection;

class HomeSectionRepository implements HomeSectionRepositoryInterface
{
    public function allActive(): Collection
    {
        return HomeSection::query()
            ->active()
            ->orderBy('sort_order')
            ->orderBy('id')
            ->get();
    }

    public function keyedActive(): Collection
    {
        return $this->allActive()->keyBy('key');
    }

    public function paginate(int $perPage = 12): LengthAwarePaginator
    {
        return HomeSection::query()
            ->orderBy('sort_order')
            ->orderBy('id')
            ->paginate($perPage);
    }

    public function create(array $data): HomeSection
    {
        return HomeSection::query()->create($data);
    }

    public function update(HomeSection $section, array $data): HomeSection
    {
        $section->update($data);

        return $section->fresh();
    }

    public function delete(HomeSection $section): void
    {
        $section->delete();
    }
}
