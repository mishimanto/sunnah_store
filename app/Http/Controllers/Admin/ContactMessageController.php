<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Repositories\Contracts\ContactMessageRepositoryInterface;
use Illuminate\View\View;

class ContactMessageController extends Controller
{
    public function __construct(protected ContactMessageRepositoryInterface $messages)
    {
    }

    public function index(): View
    {
        return view('admin.messages.index', [
            'messages' => $this->messages->paginate(),
        ]);
    }
}
