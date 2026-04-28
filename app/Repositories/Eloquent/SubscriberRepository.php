<?php

namespace App\Repositories\Eloquent;

use App\Models\Subscriber;
use App\Repositories\Contracts\SubscriberRepositoryInterface;
use Illuminate\Contracts\Pagination\LengthAwarePaginator;

class SubscriberRepository implements SubscriberRepositoryInterface
{
    public function paginate(int $perPage = 15): LengthAwarePaginator
    {
        return Subscriber::query()->latest()->paginate($perPage);
    }

    public function subscribe(string $email): Subscriber
    {
        return Subscriber::query()->firstOrCreate(['email' => $email]);
    }
}
