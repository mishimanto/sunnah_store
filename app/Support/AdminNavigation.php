<?php

namespace App\Support;

use App\Enums\UserRole;
use App\Models\User;

class AdminNavigation
{
    public static function items(User $user): array
    {
        $items = [
            ['label' => 'Dashboard', 'icon' => 'layout-dashboard', 'route' => 'admin.dashboard'],
            ['label' => 'Home Sections', 'icon' => 'monitor-play', 'route' => 'admin.home-sections.index'],
            ['label' => 'Categories', 'icon' => 'folders', 'route' => 'admin.categories.index'],
            ['label' => 'Products', 'icon' => 'package', 'route' => 'admin.products.index'],
            ['label' => 'Posts', 'icon' => 'newspaper', 'route' => 'admin.posts.index'],
            ['label' => 'Pages', 'icon' => 'file-text', 'route' => 'admin.pages.index'],
            ['label' => 'Subscribers', 'icon' => 'mail', 'route' => 'admin.subscribers.index'],
            ['label' => 'Messages', 'icon' => 'messages-square', 'route' => 'admin.messages.index'],
        ];

        if ($user->hasRole(UserRole::SuperAdmin, UserRole::Admin)) {
            $items[] = ['label' => 'Settings', 'icon' => 'settings', 'route' => 'admin.settings.edit'];
        }

        if ($user->hasRole(UserRole::SuperAdmin)) {
            $items[] = ['label' => 'Users', 'icon' => 'users', 'route' => 'admin.users.index'];
        }

        return $items;
    }
}
