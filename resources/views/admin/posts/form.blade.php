@extends('layouts.admin')

@section('title', $post->exists ? 'Edit Post' : 'Create Post')
@section('heading', $post->exists ? 'Edit Post' : 'Create Post')

@section('content')
    <form action="{{ $post->exists ? route('admin.posts.update', $post) : route('admin.posts.store') }}" method="POST" enctype="multipart/form-data" class="rounded-3xl bg-white p-6 shadow-sm ring-1 ring-stone-200">
        @csrf
        @if($post->exists) @method('PUT') @endif
        <div class="grid gap-5 md:grid-cols-2">
            <label class="block"><span class="mb-2 block text-sm font-semibold">Title</span><input type="text" name="title" value="{{ old('title', $post->title) }}" class="w-full rounded-2xl border border-stone-300 px-4 py-3"></label>
            <label class="block"><span class="mb-2 block text-sm font-semibold">Slug</span><input type="text" name="slug" value="{{ old('slug', $post->slug) }}" class="w-full rounded-2xl border border-stone-300 px-4 py-3"></label>
            <label class="block"><span class="mb-2 block text-sm font-semibold">Category label</span><input type="text" name="category_label" value="{{ old('category_label', $post->category_label) }}" class="w-full rounded-2xl border border-stone-300 px-4 py-3"></label>
            <label class="block"><span class="mb-2 block text-sm font-semibold">Reading time</span><input type="text" name="reading_time" value="{{ old('reading_time', $post->reading_time) }}" class="w-full rounded-2xl border border-stone-300 px-4 py-3"></label>
            <label class="block"><span class="mb-2 block text-sm font-semibold">Quote</span><input type="text" name="quote" value="{{ old('quote', $post->quote) }}" class="w-full rounded-2xl border border-stone-300 px-4 py-3"></label>
            <label class="block"><span class="mb-2 block text-sm font-semibold">Quote highlight</span><input type="text" name="quote_highlight" value="{{ old('quote_highlight', $post->quote_highlight) }}" class="w-full rounded-2xl border border-stone-300 px-4 py-3"></label>
            <label class="block"><span class="mb-2 block text-sm font-semibold">Publish date</span><input type="datetime-local" name="published_at" value="{{ old('published_at', optional($post->published_at)->format('Y-m-d\TH:i')) }}" class="w-full rounded-2xl border border-stone-300 px-4 py-3"></label>
            <label class="block"><span class="mb-2 block text-sm font-semibold">Image</span><input type="file" name="image" class="w-full rounded-2xl border border-stone-300 px-4 py-3"></label>
            <label class="md:col-span-2 block"><span class="mb-2 block text-sm font-semibold">Excerpt</span><input type="text" name="excerpt" value="{{ old('excerpt', $post->excerpt) }}" class="w-full rounded-2xl border border-stone-300 px-4 py-3"></label>
            <label class="md:col-span-2 block"><span class="mb-2 block text-sm font-semibold">Body</span><textarea name="body" rows="8" class="w-full rounded-2xl border border-stone-300 px-4 py-3">{{ old('body', $post->body) }}</textarea></label>
        </div>
        <div class="mt-5 flex flex-wrap gap-5 text-sm">
            <label class="flex items-center gap-2"><input type="checkbox" name="is_featured" value="1" @checked(old('is_featured', $post->is_featured))> Featured on home</label>
            <label class="flex items-center gap-2"><input type="checkbox" name="is_published" value="1" @checked(old('is_published', $post->is_published ?? true))> Published</label>
        </div>
        <button type="submit" class="mt-6 rounded-2xl bg-stone-900 px-5 py-3 text-sm font-semibold text-white">Save post</button>
    </form>
@endsection
