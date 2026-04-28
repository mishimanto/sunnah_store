@extends('layouts.admin')

@section('title', $section->exists ? 'Edit Home Section' : 'Create Home Section')
@section('heading', $section->exists ? 'Edit Home Section' : 'Create Home Section')

@section('content')
    <form action="{{ $section->exists ? route('admin.home-sections.update', $section) : route('admin.home-sections.store') }}" method="POST" enctype="multipart/form-data" class="rounded-3xl bg-white p-6 shadow-sm ring-1 ring-stone-200">
        @csrf
        @if($section->exists) @method('PUT') @endif
        <div class="grid gap-5 md:grid-cols-2">
            <label class="block"><span class="mb-2 block text-sm font-semibold">Key</span><input type="text" name="key" value="{{ old('key', $section->key) }}" class="w-full rounded-2xl border border-stone-300 px-4 py-3"></label>
            <label class="block"><span class="mb-2 block text-sm font-semibold">Media type</span><select name="media_type" class="w-full rounded-2xl border border-stone-300 px-4 py-3">@foreach(['image', 'video'] as $type)<option value="{{ $type }}" @selected(old('media_type', $section->media_type ?: 'image') === $type)>{{ ucfirst($type) }}</option>@endforeach</select></label>
            <label class="block"><span class="mb-2 block text-sm font-semibold">Title</span><input type="text" name="title" value="{{ old('title', $section->title) }}" class="w-full rounded-2xl border border-stone-300 px-4 py-3"></label>
            <label class="block"><span class="mb-2 block text-sm font-semibold">Subtitle</span><input type="text" name="subtitle" value="{{ old('subtitle', $section->subtitle) }}" class="w-full rounded-2xl border border-stone-300 px-4 py-3"></label>
            <label class="block"><span class="mb-2 block text-sm font-semibold">Button label</span><input type="text" name="button_label" value="{{ old('button_label', $section->button_label) }}" class="w-full rounded-2xl border border-stone-300 px-4 py-3"></label>
            <label class="block"><span class="mb-2 block text-sm font-semibold">Button URL</span><input type="text" name="button_url" value="{{ old('button_url', $section->button_url) }}" class="w-full rounded-2xl border border-stone-300 px-4 py-3"></label>
            <label class="block"><span class="mb-2 block text-sm font-semibold">Sort order</span><input type="number" name="sort_order" value="{{ old('sort_order', $section->sort_order) }}" class="w-full rounded-2xl border border-stone-300 px-4 py-3"></label>
            <div class="grid gap-5 md:grid-cols-2">
                <label class="block"><span class="mb-2 block text-sm font-semibold">Image</span><input type="file" name="image" class="w-full rounded-2xl border border-stone-300 px-4 py-3"></label>
                <label class="block"><span class="mb-2 block text-sm font-semibold">Video</span><input type="file" name="video" class="w-full rounded-2xl border border-stone-300 px-4 py-3"></label>
            </div>
        </div>
        <div class="mt-5 text-sm"><label class="flex items-center gap-2"><input type="checkbox" name="is_active" value="1" @checked(old('is_active', $section->is_active ?? true))> Active</label></div>
        <button type="submit" class="mt-6 rounded-2xl bg-stone-900 px-5 py-3 text-sm font-semibold text-white">Save section</button>
    </form>
@endsection
