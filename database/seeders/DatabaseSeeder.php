<?php

namespace Database\Seeders;

use App\Enums\UserRole;
use App\Models\Category;
use App\Models\HomeSection;
use App\Models\Page;
use App\Models\Post;
use App\Models\Product;
use App\Models\SiteSetting;
use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Carbon;

class DatabaseSeeder extends Seeder
{
    use WithoutModelEvents;

    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        SiteSetting::query()->updateOrCreate(
            ['id' => 1],
            [
                'site_name' => 'The Sunnah Store',
                'site_tagline' => 'Meaningful gifting rooted in faith and memory.',
                'logo_path' => 'images/logo.jpg',
                'topbar_text' => 'CREATE YOUR OWN GIFT BOX',
                'topbar_button_label' => 'Explore',
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

        $categories = [
            [
                'name' => 'Stationeries',
                'slug' => 'stationeries',
                'icon' => 'notebook-pen',
                'sort_order' => 1,
                'in_footer' => true,
                'children' => [
                    ['name' => 'Notebooks', 'slug' => 'stationeries-notebooks', 'children' => ['Coloured', 'Gold Foiled', 'Monochromed']],
                    ['name' => 'Journals', 'slug' => 'stationeries-journals', 'children' => ['Journaling', 'Planner', 'Holy Book']],
                    ['name' => 'Cards', 'slug' => 'stationeries-cards', 'children' => ['Ramadan Cards', 'Eid Cards', 'Dua Cards']],
                    ['name' => 'Accessories', 'slug' => 'stationeries-accessories', 'children' => ['Prayer Mat', 'Clips', 'Tasbeeh']],
                ],
            ],
            [
                'name' => 'Home Decor',
                'slug' => 'home-decor',
                'icon' => 'house',
                'sort_order' => 2,
                'in_footer' => true,
                'children' => [
                    ['name' => 'Wall Art', 'slug' => 'home-decor-wall-art', 'children' => ['Calligraphy Frames', 'Canvas Prints', 'Posters']],
                    ['name' => 'Lighting', 'slug' => 'home-decor-lighting', 'children' => ['Lanterns', 'Moon Lamps', 'Candles']],
                    ['name' => 'Table Decor', 'slug' => 'home-decor-table-decor', 'children' => ['Incense Holders', 'Figurines', 'Trays']],
                    ['name' => 'Rugs & Mats', 'slug' => 'home-decor-rugs', 'children' => ['Prayer Rugs', 'Decorative Rugs']],
                ],
            ],
            [
                'name' => 'Gifts',
                'slug' => 'gifts',
                'icon' => 'gift',
                'sort_order' => 3,
                'in_footer' => true,
                'children' => [
                    ['name' => 'Gift Sets', 'slug' => 'gifts-gift-sets', 'children' => ['Eid Gift Box', 'Ramadan Set', 'Wedding Gift']],
                    ['name' => 'Occasion', 'slug' => 'gifts-occasion', 'children' => ['Birthday', 'New Baby', 'Hajj Gift']],
                    ['name' => 'Build Your Own', 'slug' => 'gifts-build-your-own', 'children' => ['Custom Gift Box', 'Add a Card']],
                ],
            ],
            [
                'name' => 'Lifestyle',
                'slug' => 'lifestyle',
                'icon' => 'sparkles',
                'sort_order' => 4,
                'in_footer' => true,
                'children' => [
                    ['name' => 'Fragrance', 'slug' => 'lifestyle-fragrance', 'children' => ['Attar / Oud', 'Bakhoor', 'Room Spray']],
                    ['name' => 'Wellness', 'slug' => 'lifestyle-wellness', 'children' => ['Miswak', 'Black Seed Oil', 'Honey']],
                    ['name' => 'Prayer', 'slug' => 'lifestyle-prayer', 'children' => ['Tasbeeh', 'Prayer Mat', 'Hijab Pins']],
                ],
            ],
            [
                'name' => 'Academic',
                'slug' => 'academic',
                'icon' => 'graduation-cap',
                'sort_order' => 5,
                'in_footer' => true,
                'children' => [
                    ['name' => 'Books', 'slug' => 'academic-books', 'children' => ['Islamic Books', 'Children Books', 'Quran']],
                    ['name' => 'Planners', 'slug' => 'academic-planners', 'children' => ['Study Planner', 'Ramadan Planner', 'Daily Journal']],
                ],
            ],
            [
                'name' => 'Hajj',
                'slug' => 'hajj',
                'icon' => 'plane',
                'sort_order' => 6,
                'in_footer' => true,
                'children' => [
                    ['name' => 'Hajj Essentials', 'slug' => 'hajj-essentials', 'children' => ['Ihram Clothing', 'Hajj Bag', 'Dua Book']],
                    ['name' => 'Umrah', 'slug' => 'hajj-umrah', 'children' => ['Umrah Kit', 'Travel Prayer Mat', 'Zamzam Bottle']],
                ],
            ],
        ];

        foreach ($categories as $categoryData) {
            $topCategory = Category::query()->updateOrCreate(
                ['slug' => $categoryData['slug']],
                collect($categoryData)->except('children')->all(),
            );

            foreach ($categoryData['children'] as $childData) {
                $group = Category::query()->updateOrCreate(
                    ['slug' => $childData['slug']],
                    [
                        'parent_id' => $topCategory->id,
                        'name' => $childData['name'],
                        'slug' => $childData['slug'],
                        'is_active' => true,
                        'in_header' => false,
                    ],
                );

                foreach ($childData['children'] as $index => $leafName) {
                    Category::query()->updateOrCreate(
                        ['slug' => \Illuminate\Support\Str::slug($childData['slug'].'-'.$leafName)],
                        [
                            'parent_id' => $group->id,
                            'name' => $leafName,
                            'slug' => \Illuminate\Support\Str::slug($childData['slug'].'-'.$leafName),
                            'is_active' => true,
                            'in_header' => false,
                            'sort_order' => $index,
                        ],
                    );
                }
            }
        }

        $productSeeds = [
            ['category' => 'stationeries', 'name' => 'Rabbana Dua', 'slug' => 'rabbana-dua', 'price' => 19.00, 'image_path' => 'images/img.jpg', 'tag_label' => 'Dua Card', 'badge_label' => 'Best Seller', 'is_best_seller' => true],
            ['category' => 'gifts', 'name' => 'Wallet', 'slug' => 'wallet', 'price' => 35.00, 'image_path' => 'images/img-2.jpg', 'tag_label' => 'Gift', 'is_best_seller' => true],
            ['category' => 'hajj', 'name' => 'Hajj Dua Card', 'slug' => 'hajj-dua-card', 'price' => 16.00, 'image_path' => 'images/img-3.jpg', 'tag_label' => 'Hajj', 'is_best_seller' => true],
            ['category' => 'hajj', 'name' => 'Hajj Daily Reminder', 'slug' => 'hajj-daily-reminder', 'price' => 18.00, 'image_path' => 'images/img-4.jpg', 'tag_label' => 'Hajj', 'is_best_seller' => true],
            ['category' => 'lifestyle', 'name' => 'Attar Perfume Oil', 'slug' => 'attar-perfume-oil', 'price' => 28.00, 'image_path' => 'images/img-5.jpg', 'tag_label' => 'Fragrance', 'is_best_seller' => true],
            ['category' => 'lifestyle', 'name' => 'Velvet Prayer Mat', 'slug' => 'velvet-prayer-mat', 'price' => 42.00, 'image_path' => 'images/img-6.jpg', 'tag_label' => 'Prayer', 'is_best_seller' => true, 'is_swipe_featured' => true],
            ['category' => 'home-decor', 'name' => 'Arabic Frame', 'slug' => 'arabic-frame', 'price' => 54.00, 'image_path' => 'images/img-7.jpg', 'tag_label' => 'Wall Art', 'is_best_seller' => true],
            ['category' => 'gifts', 'name' => 'Sunnah Gift Box', 'slug' => 'sunnah-gift-box', 'price' => 62.00, 'image_path' => 'images/img-8.jpg', 'tag_label' => 'Gift Set', 'badge_label' => 'Featured', 'is_best_seller' => true, 'is_swipe_featured' => true],
            ['category' => 'gifts', 'name' => 'Explore Mugs', 'slug' => 'explore-mugs', 'price' => 22.00, 'image_path' => 'images/store.jpg', 'tag_label' => 'Mugs', 'is_swipe_featured' => true],
            ['category' => 'hajj', 'name' => 'Shop Hajj Dua Card', 'slug' => 'shop-hajj-dua-card', 'price' => 15.00, 'image_path' => 'images/store-2.jpg', 'tag_label' => 'Dua Card', 'is_swipe_featured' => true],
            ['category' => 'stationeries', 'name' => 'Start Writing', 'slug' => 'start-writing', 'price' => 21.00, 'image_path' => 'images/store-3.jpg', 'tag_label' => 'Journal', 'is_swipe_featured' => true],
            ['category' => 'home-decor', 'name' => 'Browse Frames', 'slug' => 'browse-frames', 'price' => 39.00, 'image_path' => 'images/store-4.jpg', 'tag_label' => 'Frames', 'is_swipe_featured' => true],
        ];

        foreach ($productSeeds as $index => $productData) {
            $category = Category::query()->where('slug', $productData['category'])->first();

            Product::query()->updateOrCreate(
                ['slug' => $productData['slug']],
                [
                    'category_id' => $category?->id,
                    'name' => $productData['name'],
                    'slug' => $productData['slug'],
                    'short_description' => 'A thoughtful product curated for meaningful gifting.',
                    'description' => 'Crafted with care, this piece keeps the store aesthetic while making the content fully manageable from the backend.',
                    'price' => $productData['price'],
                    'image_path' => $productData['image_path'],
                    'badge_label' => $productData['badge_label'] ?? null,
                    'tag_label' => $productData['tag_label'] ?? null,
                    'is_best_seller' => $productData['is_best_seller'] ?? false,
                    'is_swipe_featured' => $productData['is_swipe_featured'] ?? false,
                    'sort_order' => $index + 1,
                ],
            );
        }

        $posts = [
            [
                'title' => 'যার অন্তরে কেবল আপনারই নাম',
                'slug' => 'jar-ontore-kebol-apnari-nam',
                'excerpt' => 'আমি শুধু আপনারই বান্দা।',
                'body' => 'ইয়া আল্লাহ, কখনো রাতের আঁধার ভয় দেখায়, কখনো নিজের গুনাহ। আপনার রহমতই আমার আশ্রয়। এই দোয়া প্রতিটি পথচলায় আমাকে নম্রতা আর স্থিরতা শেখায়।',
                'quote' => 'যার অন্তরে কেবল',
                'quote_highlight' => 'আপনারই নাম',
                'image_path' => 'images/store-5.jpg',
                'category_label' => 'Dua',
                'reading_time' => '6 Min',
            ],
            [
                'title' => 'তোমার সন্তুষ্টিই আমার জান্নাত',
                'slug' => 'tomar-sontustitei-amar-jannat',
                'excerpt' => 'শান্তির ছায়ায় দয়ার প্রার্থনা।',
                'body' => 'আমার মালিক, আমার রব-আল্লাহ, আমার মা-বাবার দিকে আপনি দয়াভরা দৃষ্টি দিন। হৃদয়ের ক্লান্তিতে আপনার সন্তুষ্টি-ই আমার শান্তির দরজা।',
                'quote' => 'তোমার সন্তুষ্টিই',
                'quote_highlight' => 'আমার জান্নাত',
                'image_path' => 'images/store-6.jpg',
                'category_label' => 'Dua',
                'reading_time' => '8 Min',
            ],
            [
                'title' => 'আপনার রহমতই আমার ভরসা',
                'slug' => 'apnar-rohmotei-amar-vorsa',
                'excerpt' => 'আপনি না থাকলে, আমি কোথায় যাবো?',
                'body' => 'ইয়া আল্লাহ, আপনি যদি আমাকে ভালো না বাসেন, আমাকে দূরে সরিয়ে দেন, আমি কোথায় আশ্রয় পাবো? আপনার রহমতই আমার সাহসের শুরু।',
                'quote' => 'আপনার রহমতই',
                'quote_highlight' => 'আমার ভরসা',
                'image_path' => 'images/store-7.jpg',
                'category_label' => 'Hajj',
                'reading_time' => '7 Min',
            ],
            [
                'title' => 'আমি তুচ্ছ, আপনি মহান',
                'slug' => 'ami-tuccho-apni-mohan',
                'excerpt' => 'আমি কিছুই না, কিন্তু আপনিই সব কিছু।',
                'body' => 'আমার অন্তরকে, আমার কলবকে আপনি পবিত্র করে দিন। আপনার মহিমা স্মরণ করলেই অহংকার গলে যায়, আর হৃদয় নরম হয়।',
                'quote' => 'আমি তুচ্ছ,',
                'quote_highlight' => 'আপনি মহান',
                'image_path' => 'images/store-8.jpg',
                'category_label' => 'Hajj',
                'reading_time' => '4 Min',
            ],
        ];

        foreach ($posts as $post) {
            Post::query()->updateOrCreate(
                ['slug' => $post['slug']],
                [
                    ...$post,
                    'is_featured' => true,
                    'is_published' => true,
                    'published_at' => Carbon::now(),
                ],
            );
        }

        $pages = [
            ['title' => 'About Us', 'slug' => 'about-us', 'section' => 'information', 'excerpt' => 'Learn about the store.', 'body' => 'The Sunnah Store curates thoughtful, faith-rooted products and gifts designed to carry memory, intention, and beauty into daily life.'],
            ['title' => 'FAQs', 'slug' => 'faqs', 'section' => 'information', 'excerpt' => 'Common questions.', 'body' => 'Orders, delivery times, personalization, and product care are managed from one backend so your team can update details without touching Blade files.'],
            ['title' => 'Feedback', 'slug' => 'feedback', 'section' => 'information', 'excerpt' => 'Share your thoughts.', 'body' => 'We would love to hear what helped, what felt off, and what you want us to build next.'],
            ['title' => 'Blog', 'slug' => 'journal', 'section' => 'privacy', 'excerpt' => 'Read soulful reflections.', 'body' => 'Browse reflections, duas, and journal-style writing from the blog section.'],
            ['title' => 'Contact', 'slug' => 'contact', 'section' => 'privacy', 'excerpt' => 'Reach out to us.', 'body' => 'Use the form below to send a note to the team.'],
            ['title' => 'Terms & Conditions', 'slug' => 'terms-and-conditions', 'section' => 'privacy', 'excerpt' => 'Terms for use.', 'body' => 'These terms describe how the store, content, and orders are managed.'],
            ['title' => 'Privacy Policy', 'slug' => 'privacy-policy', 'section' => 'privacy', 'excerpt' => 'How data is handled.', 'body' => 'We collect only what is needed to respond to messages, manage subscriptions, and run the storefront.'],
            ['title' => 'Return & Refund', 'slug' => 'return-and-refund', 'section' => 'privacy', 'excerpt' => 'Refund and return policy.', 'body' => 'Customized items may have different return conditions, while standard products can follow the return policy described here.'],
            ['title' => 'Reviews', 'slug' => 'reviews', 'section' => 'information', 'excerpt' => 'What customers are saying.', 'body' => 'Customer reviews and testimonials can be added here as the content grows.'],
            ['title' => 'Profile', 'slug' => 'profile', 'section' => 'information', 'excerpt' => 'Your account overview.', 'body' => 'This page can evolve into a customer profile area later without changing the route structure.'],
        ];

        foreach ($pages as $index => $page) {
            Page::query()->updateOrCreate(
                ['slug' => $page['slug']],
                [
                    ...$page,
                    'sort_order' => $index + 1,
                    'is_visible' => true,
                ],
            );
        }

        $sections = [
            ['key' => 'hero_primary', 'image_path' => 'images/sunnah-hero-bg.jpg', 'media_type' => 'image', 'sort_order' => 1],
            ['key' => 'hero_video', 'title' => 'Personalized Prayer Mat', 'subtitle' => 'Pray Side by Side, Forever Engraved', 'button_label' => 'Customize Yours', 'button_url' => '/products/velvet-prayer-mat', 'video_path' => 'videos/sunnah-video.mp4', 'media_type' => 'video', 'sort_order' => 2],
            ['key' => 'hero_secondary', 'title' => 'Personalized Prayer Mat', 'subtitle' => 'Pray Side by Side, Forever Engraved', 'button_label' => 'Explore', 'button_url' => '/products/velvet-prayer-mat', 'image_path' => 'images/sunnah-hero-bg-2.jpg', 'media_type' => 'image', 'sort_order' => 3],
            ['key' => 'hero_tertiary', 'title' => 'Personalized Prayer Mat', 'subtitle' => 'Pray Side by Side, Forever Engraved', 'button_label' => 'Order Now', 'button_url' => '/products/velvet-prayer-mat', 'image_path' => 'images/sunnah-hero-bg-3.jpg', 'media_type' => 'image', 'sort_order' => 4],
            ['key' => 'hero_quaternary', 'title' => 'A Mug With A Message', 'subtitle' => 'A premium mug gift box that brings beauty, faith, and warmth together.', 'button_label' => 'Explore', 'button_url' => '/products/explore-mugs', 'image_path' => 'images/sunnah-hero-bg-4.jpg', 'media_type' => 'image', 'sort_order' => 5],
        ];

        foreach ($sections as $section) {
            HomeSection::query()->updateOrCreate(['key' => $section['key']], $section + ['is_active' => true]);
        }

        User::query()->updateOrCreate(
            ['email' => 'superadmin@sunnahstore.test'],
            ['name' => 'Super Admin', 'password' => 'password', 'role' => UserRole::SuperAdmin],
        );

        User::query()->updateOrCreate(
            ['email' => 'admin@sunnahstore.test'],
            ['name' => 'Admin User', 'password' => 'password', 'role' => UserRole::Admin],
        );

        User::query()->updateOrCreate(
            ['email' => 'editor@sunnahstore.test'],
            ['name' => 'Editor User', 'password' => 'password', 'role' => UserRole::Editor],
        );
    }
}
