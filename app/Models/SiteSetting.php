<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SiteSetting extends Model
{
    use HasFactory;

    protected $fillable = [
        'site_name',
        'site_tagline',
        'logo_path',
        'topbar_text',
        'topbar_button_label',
        'topbar_button_url',
        'footer_newsletter_text',
        'footer_copyright_text',
        'footer_privacy_label',
        'footer_privacy_url',
        'blog_section_title',
        'blog_section_subtitle',
        'blog_search_placeholder',
        'social_links',
    ];

    protected function casts(): array
    {
        return [
            'social_links' => 'array',
        ];
    }
}
