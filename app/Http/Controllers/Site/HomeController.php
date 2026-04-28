<?php

namespace App\Http\Controllers\Site;

use App\Http\Controllers\Controller;
use App\Repositories\Contracts\SiteRepositoryInterface;
use Illuminate\View\View;

class HomeController extends Controller
{
    public function __construct(protected SiteRepositoryInterface $site)
    {
    }

    public function __invoke(): View
    {
        return view('home', $this->site->homeData());
    }
}
