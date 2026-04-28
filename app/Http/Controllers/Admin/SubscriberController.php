<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Repositories\Contracts\SubscriberRepositoryInterface;
use Illuminate\View\View;

class SubscriberController extends Controller
{
    public function __construct(protected SubscriberRepositoryInterface $subscribers)
    {
    }

    public function index(): View
    {
        return view('admin.subscribers.index', [
            'subscribers' => $this->subscribers->paginate(),
        ]);
    }
}
