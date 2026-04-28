@extends('layouts.admin')

@section('title', 'Settings')
@section('heading', 'Site Settings')

@section('content')
    <form action="{{ route('admin.settings.update') }}" method="POST" enctype="multipart/form-data" class="space-y-6">
        @csrf
        @method('PUT')

        <div class="grid gap-6 xl:grid-cols-2">
            <div class="rounded-3xl bg-white p-6 shadow-sm ring-1 ring-stone-200">
                <h3 class="text-lg font-black">Brand</h3>
                <div class="mt-5 grid gap-4">
                    <label class="block">
                        <span class="mb-2 block text-sm font-semibold">Site name</span>
                        <input type="text" name="site_name" value="{{ old('site_name', $settings->site_name) }}" class="w-full rounded-2xl border border-stone-300 px-4 py-3 outline-none focus:border-stone-900">
                    </label>
                    <label class="block">
                        <span class="mb-2 block text-sm font-semibold">Tagline</span>
                        <input type="text" name="site_tagline" value="{{ old('site_tagline', $settings->site_tagline) }}" class="w-full rounded-2xl border border-stone-300 px-4 py-3 outline-none focus:border-stone-900">
                    </label>
                    <label class="block">
                        <span class="mb-2 block text-sm font-semibold">Logo</span>
                        <input type="file" name="logo" class="w-full rounded-2xl border border-stone-300 px-4 py-3">
                    </label>
                </div>
            </div>

            <div class="rounded-3xl bg-white p-6 shadow-sm ring-1 ring-stone-200">
                <h3 class="text-lg font-black">Top bar</h3>
                <div class="mt-5 grid gap-4">
                    <label class="block">
                        <span class="mb-2 block text-sm font-semibold">Text</span>
                        <input type="text" name="topbar_text" value="{{ old('topbar_text', $settings->topbar_text) }}" class="w-full rounded-2xl border border-stone-300 px-4 py-3 outline-none focus:border-stone-900">
                    </label>
                    <label class="block">
                        <span class="mb-2 block text-sm font-semibold">Button label</span>
                        <input type="text" name="topbar_button_label" value="{{ old('topbar_button_label', $settings->topbar_button_label) }}" class="w-full rounded-2xl border border-stone-300 px-4 py-3 outline-none focus:border-stone-900">
                    </label>
                    <label class="block">
                        <span class="mb-2 block text-sm font-semibold">Button URL</span>
                        <input type="text" name="topbar_button_url" value="{{ old('topbar_button_url', $settings->topbar_button_url) }}" class="w-full rounded-2xl border border-stone-300 px-4 py-3 outline-none focus:border-stone-900">
                    </label>
                </div>
            </div>
        </div>

        <div class="grid gap-6 xl:grid-cols-2">
            <div class="rounded-3xl bg-white p-6 shadow-sm ring-1 ring-stone-200">
                <h3 class="text-lg font-black">Footer</h3>
                <div class="mt-5 grid gap-4">
                    <label class="block">
                        <span class="mb-2 block text-sm font-semibold">Newsletter text</span>
                        <input type="text" name="footer_newsletter_text" value="{{ old('footer_newsletter_text', $settings->footer_newsletter_text) }}" class="w-full rounded-2xl border border-stone-300 px-4 py-3 outline-none focus:border-stone-900">
                    </label>
                    <label class="block">
                        <span class="mb-2 block text-sm font-semibold">Copyright</span>
                        <input type="text" name="footer_copyright_text" value="{{ old('footer_copyright_text', $settings->footer_copyright_text) }}" class="w-full rounded-2xl border border-stone-300 px-4 py-3 outline-none focus:border-stone-900">
                    </label>
                    <div class="grid gap-4 md:grid-cols-2">
                        <label class="block">
                            <span class="mb-2 block text-sm font-semibold">Privacy label</span>
                            <input type="text" name="footer_privacy_label" value="{{ old('footer_privacy_label', $settings->footer_privacy_label) }}" class="w-full rounded-2xl border border-stone-300 px-4 py-3 outline-none focus:border-stone-900">
                        </label>
                        <label class="block">
                            <span class="mb-2 block text-sm font-semibold">Privacy URL</span>
                            <input type="text" name="footer_privacy_url" value="{{ old('footer_privacy_url', $settings->footer_privacy_url) }}" class="w-full rounded-2xl border border-stone-300 px-4 py-3 outline-none focus:border-stone-900">
                        </label>
                    </div>
                </div>
            </div>

            <div class="rounded-3xl bg-white p-6 shadow-sm ring-1 ring-stone-200">
                <h3 class="text-lg font-black">Blog section</h3>
                <div class="mt-5 grid gap-4">
                    <label class="block">
                        <span class="mb-2 block text-sm font-semibold">Title</span>
                        <input type="text" name="blog_section_title" value="{{ old('blog_section_title', $settings->blog_section_title) }}" class="w-full rounded-2xl border border-stone-300 px-4 py-3 outline-none focus:border-stone-900">
                    </label>
                    <label class="block">
                        <span class="mb-2 block text-sm font-semibold">Subtitle</span>
                        <input type="text" name="blog_section_subtitle" value="{{ old('blog_section_subtitle', $settings->blog_section_subtitle) }}" class="w-full rounded-2xl border border-stone-300 px-4 py-3 outline-none focus:border-stone-900">
                    </label>
                    <label class="block">
                        <span class="mb-2 block text-sm font-semibold">Search placeholder</span>
                        <input type="text" name="blog_search_placeholder" value="{{ old('blog_search_placeholder', $settings->blog_search_placeholder) }}" class="w-full rounded-2xl border border-stone-300 px-4 py-3 outline-none focus:border-stone-900">
                    </label>
                </div>
            </div>
        </div>

        <div class="rounded-3xl bg-white p-6 shadow-sm ring-1 ring-stone-200">
            <h3 class="text-lg font-black">Social links</h3>
            <div class="mt-5 grid gap-4 md:grid-cols-2 xl:grid-cols-5">
                @foreach(['facebook', 'instagram', 'music-2', 'twitter', 'pin'] as $icon)
                    <label class="block">
                        <span class="mb-2 block text-sm font-semibold">{{ ucfirst(str_replace('-', ' ', $icon)) }}</span>
                        <input type="text" name="social_links[{{ $icon }}]" value="{{ old('social_links.'.$icon, data_get($settings->social_links, $icon)) }}" class="w-full rounded-2xl border border-stone-300 px-4 py-3 outline-none focus:border-stone-900">
                    </label>
                @endforeach
            </div>
        </div>

        <button type="submit" class="rounded-2xl bg-stone-900 px-5 py-3 text-sm font-semibold text-white">Save settings</button>
    </form>
@endsection
