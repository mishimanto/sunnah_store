<?php

namespace App\Repositories\Eloquent;

use App\Models\SiteSetting;
use App\Repositories\Contracts\SettingRepositoryInterface;

class SettingRepository implements SettingRepositoryInterface
{
    public function get(): SiteSetting
    {
        return SiteSetting::query()->firstOrCreate(
            ['id' => 1],
            [
                'site_name' => 'The Sunnah Store',
                'site_tagline' => 'Meaningful gifting rooted in faith.',
                'topbar_text' => 'CREATE YOUR OWN GIFT BOX',
                'topbar_button_label' => 'Shop Now',
                'topbar_button_url' => '/products',
                'footer_newsletter_text' => 'For your weekly soulful coffee',
                'footer_copyright_text' => '© 2026, The Sunnah Store Powered by Laravel',
                'footer_privacy_label' => 'Privacy policy',
                'footer_privacy_url' => '/privacy-policy',
                'blog_section_title' => 'SOULFUL LATTE',
                'blog_section_subtitle' => 'faith & self-growth journal',
                'blog_search_placeholder' => 'Search for wisdom, reflection, growth...',
                'social_links' => [
                    'facebook' => '#',
                    'instagram' => '#',
                    'music-2' => '#',
                    'twitter' => '#',
                    'pin' => '#',
                ],
            ],
        );
    }

    public function update(array $data): SiteSetting
    {
        $setting = $this->get();
        $setting->update($data);

        return $setting->fresh();
    }
}
