<?php

namespace App\Repositories\Eloquent;

use App\Models\Post;
use App\Repositories\Contracts\PostRepositoryInterface;
use Illuminate\Contracts\Pagination\LengthAwarePaginator;
use Illuminate\Database\Eloquent\Collection;

class PostRepository implements PostRepositoryInterface
{
    public function paginatePublished(?string $search = null, int $perPage = 9): LengthAwarePaginator
    {
        return Post::query()
            ->published()
            ->when($search, function ($query, string $search): void {
                $query->where(function ($builder) use ($search): void {
                    $builder
                        ->where('title', 'like', "%{$search}%")
                        ->orWhere('excerpt', 'like', "%{$search}%")
                        ->orWhere('body', 'like', "%{$search}%")
                        ->orWhere('category_label', 'like', "%{$search}%");
                });
            })
            ->orderByDesc('published_at')
            ->orderBy('title')
            ->paginate($perPage)
            ->withQueryString();
    }

    public function paginateForAdmin(int $perPage = 12): LengthAwarePaginator
    {
        return Post::query()
            ->orderByDesc('published_at')
            ->orderBy('title')
            ->paginate($perPage);
    }

    public function featured(int $limit = 4): Collection
    {
        return Post::query()
            ->published()
            ->where('is_featured', true)
            ->orderByDesc('published_at')
            ->limit($limit)
            ->get();
    }

    public function findBySlug(string $slug): Post
    {
        return Post::query()
            ->published()
            ->where('slug', $slug)
            ->firstOrFail();
    }

    public function create(array $data): Post
    {
        return Post::query()->create($data);
    }

    public function update(Post $post, array $data): Post
    {
        $post->update($data);

        return $post->fresh();
    }

    public function delete(Post $post): void
    {
        $post->delete();
    }
}
