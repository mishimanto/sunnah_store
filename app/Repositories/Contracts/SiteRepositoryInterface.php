<?php

namespace App\Repositories\Contracts;

interface SiteRepositoryInterface
{
    public function homeData(): array;

    public function sharedLayoutData(): array;

    public function dashboardStats(): array;
}
