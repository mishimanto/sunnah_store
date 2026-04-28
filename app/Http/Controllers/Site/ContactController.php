<?php

namespace App\Http\Controllers\Site;

use App\Http\Controllers\Controller;
use App\Http\Requests\Site\ContactMessageRequest;
use App\Repositories\Contracts\ContactMessageRepositoryInterface;
use Illuminate\Http\RedirectResponse;

class ContactController extends Controller
{
    public function __construct(protected ContactMessageRepositoryInterface $messages)
    {
    }

    public function store(ContactMessageRequest $request): RedirectResponse
    {
        $this->messages->create($request->validated());

        return back()->with('success', 'Your message has been sent.');
    }
}
