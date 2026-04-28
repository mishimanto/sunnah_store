<?php

namespace App\Repositories\Contracts;

use App\Models\Post;
use Illuminate\Contracts\Pagination\LengthAwarePaginator;
use Illuminate\Database\Eloquent\Collection;

interface PostRepositoryInterface
{
    public function paginatePublished(?string $search = null, int $perPage = 9): LengthAwarePaginator;

    public function paginateForAdmin(int $perPage = 12): LengthAwarePaginator;

    public function featured(int $limit = 4): Collection;

    public function findBySlug(string $slug): Post;

    public function create(array $data): Post;

    public function update(Post $post, array $data): Post;

    public function delete(Post $post): void;
}
