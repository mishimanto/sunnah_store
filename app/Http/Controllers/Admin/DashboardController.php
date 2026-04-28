<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Repositories\Contracts\SiteRepositoryInterface;
use Illuminate\View\View;

class DashboardController extends Controller
{
    public function __construct(protected SiteRepositoryInterface $site)
    {
    }

    public function index(): View
    {
        return view('admin.dashboard.index', [
            'stats' => $this->site->dashboardStats(),
        ]);
    }
}
