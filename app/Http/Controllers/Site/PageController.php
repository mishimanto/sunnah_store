<?php

namespace App\Http\Controllers\Site;

use App\Http\Controllers\Controller;
use App\Repositories\Contracts\PageRepositoryInterface;
use Illuminate\View\View;

class PageController extends Controller
{
    public function __construct(protected PageRepositoryInterface $pages)
    {
    }

    public function show(string $slug): View
    {
        return view('site.pages.show', [
            'page' => $this->pages->visiblePageBySlug($slug),
        ]);
    }
}
