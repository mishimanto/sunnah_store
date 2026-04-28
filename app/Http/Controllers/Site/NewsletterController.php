<?php

namespace App\Http\Controllers\Site;

use App\Http\Controllers\Controller;
use App\Http\Requests\Site\NewsletterSubscriptionRequest;
use App\Repositories\Contracts\SubscriberRepositoryInterface;
use Illuminate\Http\RedirectResponse;

class NewsletterController extends Controller
{
    public function __construct(protected SubscriberRepositoryInterface $subscribers)
    {
    }

    public function store(NewsletterSubscriptionRequest $request): RedirectResponse
    {
        $this->subscribers->subscribe($request->validated('email'));

        return back()->with('success', 'You have been subscribed successfully.');
    }
}
