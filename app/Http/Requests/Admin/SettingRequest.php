<?php

namespace App\Http\Requests\Admin;

use Illuminate\Foundation\Http\FormRequest;

class SettingRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'site_name' => ['required', 'string', 'max:255'],
            'site_tagline' => ['nullable', 'string', 'max:255'],
            'topbar_text' => ['nullable', 'string', 'max:255'],
            'topbar_button_label' => ['nullable', 'string', 'max:255'],
            'topbar_button_url' => ['nullable', 'string', 'max:255'],
            'footer_newsletter_text' => ['nullable', 'string', 'max:255'],
            'footer_copyright_text' => ['nullable', 'string', 'max:255'],
            'footer_privacy_label' => ['nullable', 'string', 'max:255'],
            'footer_privacy_url' => ['nullable', 'string', 'max:255'],
            'blog_section_title' => ['nullable', 'string', 'max:255'],
            'blog_section_subtitle' => ['nullable', 'string', 'max:255'],
            'blog_search_placeholder' => ['nullable', 'string', 'max:255'],
            'logo' => ['nullable', 'image', 'max:4096'],
            'social_links' => ['nullable', 'array'],
            'social_links.*' => ['nullable', 'string', 'max:255'],
        ];
    }
}
