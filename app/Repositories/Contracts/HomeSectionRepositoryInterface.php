<?php

namespace App\Repositories\Contracts;

use App\Models\HomeSection;
use Illuminate\Contracts\Pagination\LengthAwarePaginator;
use Illuminate\Support\Collection;

interface HomeSectionRepositoryInterface
{
    public function allActive(): Collection;

    public function keyedActive(): Collection;

    public function paginate(int $perPage = 12): LengthAwarePaginator;

    public function create(array $data): HomeSection;

    public function update(HomeSection $section, array $data): HomeSection;

    public function delete(HomeSection $section): void;
}
