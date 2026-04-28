<?php

namespace App\Repositories\Eloquent;

use App\Repositories\Contracts\CategoryRepositoryInterface;
use App\Repositories\Contracts\ContactMessageRepositoryInterface;
use App\Repositories\Contracts\HomeSectionRepositoryInterface;
use App\Repositories\Contracts\PageRepositoryInterface;
use App\Repositories\Contracts\PostRepositoryInterface;
use App\Repositories\Contracts\ProductRepositoryInterface;
use App\Repositories\Contracts\SettingRepositoryInterface;
use App\Repositories\Contracts\SiteRepositoryInterface;
use App\Repositories\Contracts\SubscriberRepositoryInterface;
use App\Repositories\Contracts\UserRepositoryInterface;
use App\Models\Category;
use App\Models\ContactMessage;
use App\Models\Page;
use App\Models\Post;
use App\Models\Product;
use App\Models\Subscriber;
use App\Models\User;

class SiteRepository implements SiteRepositoryInterface
{
    public function __construct(
        protected SettingRepositoryInterface $settings,
        protected CategoryRepositoryInterface $categories,
        protected HomeSectionRepositoryInterface $sections,
        protected ProductRepositoryInterface $products,
        protected PostRepositoryInterface $posts,
        protected PageRepositoryInterface $pages,
    ) {
    }

    public function homeData(): array
    {
        return [
            'settings' => $this->settings->get(),
            'sections' => $this->sections->keyedActive(),
            'bestSellers' => $this->products->featuredBestSellers(),
            'swipeProducts' => $this->products->featuredSwipeItems(),
            'featuredPosts' => $this->posts->featured(),
            'navigationCategories' => $this->categories->allForNavigation(),
            'footerPageGroups' => $this->pages->footerGroups(),
        ];
    }

    public function sharedLayoutData(): array
    {
        return [
            'siteSettings' => $this->settings->get(),
            'navigationCategories' => $this->categories->allForNavigation(),
            'footerCategories' => $this->categories->allTopLevel()->where('in_footer', true)->values(),
            'footerPageGroups' => $this->pages->footerGroups(),
        ];
    }

    public function dashboardStats(): array
    {
        return [
            'categories' => Category::count(),
            'products' => Product::count(),
            'posts' => Post::count(),
            'pages' => Page::count(),
            'users' => User::count(),
            'subscribers' => Subscriber::count(),
            'messages' => ContactMessage::count(),
        ];
    }
}
