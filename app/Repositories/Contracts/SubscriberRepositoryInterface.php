<?php

namespace App\Repositories\Contracts;

use App\Models\Subscriber;
use Illuminate\Contracts\Pagination\LengthAwarePaginator;

interface SubscriberRepositoryInterface
{
    public function paginate(int $perPage = 15): LengthAwarePaginator;

    public function subscribe(string $email): Subscriber;
}
