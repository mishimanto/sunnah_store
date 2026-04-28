<?php

namespace App\Repositories\Eloquent;

use App\Models\ContactMessage;
use App\Repositories\Contracts\ContactMessageRepositoryInterface;
use Illuminate\Contracts\Pagination\LengthAwarePaginator;

class ContactMessageRepository implements ContactMessageRepositoryInterface
{
    public function paginate(int $perPage = 15): LengthAwarePaginator
    {
        return ContactMessage::query()->latest()->paginate($perPage);
    }

    public function create(array $data): ContactMessage
    {
        return ContactMessage::query()->create($data);
    }
}
