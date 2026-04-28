<?php

namespace App\Http\Requests\Admin;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class HomeSectionRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    protected function prepareForValidation(): void
    {
        $this->merge([
            'is_active' => $this->boolean('is_active', true),
        ]);
    }

    public function rules(): array
    {
        $section = $this->route('home_section');

        return [
            'key' => ['required', 'string', 'max:255', Rule::unique('home_sections', 'key')->ignore($section)],
            'title' => ['nullable', 'string', 'max:255'],
            'subtitle' => ['nullable', 'string', 'max:255'],
            'button_label' => ['nullable', 'string', 'max:255'],
            'button_url' => ['nullable', 'string', 'max:255'],
            'media_type' => ['required', 'in:image,video'],
            'sort_order' => ['nullable', 'integer', 'min:0'],
            'image' => ['nullable', 'image', 'max:8192'],
            'video' => ['nullable', 'mimetypes:video/mp4,video/webm,video/quicktime', 'max:51200'],
            'is_active' => ['nullable', 'boolean'],
        ];
    }
}
