<?php

namespace App\Repositories\Contracts;

use App\Models\SiteSetting;

interface SettingRepositoryInterface
{
    public function get(): SiteSetting;

    public function update(array $data): SiteSetting;
}
