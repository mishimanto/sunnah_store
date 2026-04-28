@extends('layouts.admin')

@section('title', $page->exists ? 'Edit Page' : 'Create Page')
@section('heading', $page->exists ? 'Edit Page' : 'Create Page')

@section('content')
    <form action="{{ $page->exists ? route('admin.pages.update', $page) : route('admin.pages.store') }}" method="POST" class="rounded-3xl bg-white p-6 shadow-sm ring-1 ring-stone-200">
        @csrf
        @if($page->exists) @method('PUT') @endif
        <div class="grid gap-5 md:grid-cols-2">
            <label class="block"><span class="mb-2 block text-sm font-semibold">Title</span><input type="text" name="title" value="{{ old('title', $page->title) }}" class="w-full rounded-2xl border border-stone-300 px-4 py-3"></label>
            <label class="block"><span class="mb-2 block text-sm font-semibold">Slug</span><input type="text" name="slug" value="{{ old('slug', $page->slug) }}" class="w-full rounded-2xl border border-stone-300 px-4 py-3"></label>
            <label class="block"><span class="mb-2 block text-sm font-semibold">Section</span><select name="section" class="w-full rounded-2xl border border-stone-300 px-4 py-3">@foreach(['privacy', 'information', 'general'] as $section)<option value="{{ $section }}" @selected(old('section', $page->section ?: 'general') === $section)>{{ ucfirst($section) }}</option>@endforeach</select></label>
            <label class="block"><span class="mb-2 block text-sm font-semibold">Sort order</span><input type="number" name="sort_order" value="{{ old('sort_order', $page->sort_order) }}" class="w-full rounded-2xl border border-stone-300 px-4 py-3"></label>
            <label class="md:col-span-2 block"><span class="mb-2 block text-sm font-semibold">Excerpt</span><input type="text" name="excerpt" value="{{ old('excerpt', $page->excerpt) }}" class="w-full rounded-2xl border border-stone-300 px-4 py-3"></label>
            <label class="md:col-span-2 block"><span class="mb-2 block text-sm font-semibold">Body</span><textarea name="body" rows="10" class="w-full rounded-2xl border border-stone-300 px-4 py-3">{{ old('body', $page->body) }}</textarea></label>
        </div>
        <div class="mt-5 text-sm"><label class="flex items-center gap-2"><input type="checkbox" name="is_visible" value="1" @checked(old('is_visible', $page->is_visible ?? true))> Visible</label></div>
        <button type="submit" class="mt-6 rounded-2xl bg-stone-900 px-5 py-3 text-sm font-semibold text-white">Save page</button>
    </form>
@endsection
