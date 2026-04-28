@extends('layouts.admin')

@section('title', $category->exists ? 'Edit Category' : 'Create Category')
@section('heading', $category->exists ? 'Edit Category' : 'Create Category')

@section('content')
    <form action="{{ $category->exists ? route('admin.categories.update', $category) : route('admin.categories.store') }}" method="POST" enctype="multipart/form-data" class="rounded-3xl bg-white p-6 shadow-sm ring-1 ring-stone-200">
        @csrf
        @if($category->exists) @method('PUT') @endif
        <div class="grid gap-5 md:grid-cols-2">
            <label class="block"><span class="mb-2 block text-sm font-semibold">Name</span><input type="text" name="name" value="{{ old('name', $category->name) }}" class="w-full rounded-2xl border border-stone-300 px-4 py-3"></label>
            <label class="block"><span class="mb-2 block text-sm font-semibold">Slug</span><input type="text" name="slug" value="{{ old('slug', $category->slug) }}" class="w-full rounded-2xl border border-stone-300 px-4 py-3"></label>
            <label class="block"><span class="mb-2 block text-sm font-semibold">Parent category</span><select name="parent_id" class="w-full rounded-2xl border border-stone-300 px-4 py-3"><option value="">None</option>@foreach($parents as $parent)<option value="{{ $parent->id }}" @selected(old('parent_id', $category->parent_id) == $parent->id)>{{ $parent->name }}</option>@endforeach</select></label>
            <label class="block"><span class="mb-2 block text-sm font-semibold">Lucide icon</span><input type="text" name="icon" value="{{ old('icon', $category->icon) }}" class="w-full rounded-2xl border border-stone-300 px-4 py-3"></label>
            <label class="block"><span class="mb-2 block text-sm font-semibold">Sort order</span><input type="number" name="sort_order" value="{{ old('sort_order', $category->sort_order) }}" class="w-full rounded-2xl border border-stone-300 px-4 py-3"></label>
            <label class="block"><span class="mb-2 block text-sm font-semibold">Image</span><input type="file" name="image" class="w-full rounded-2xl border border-stone-300 px-4 py-3"></label>
            <label class="md:col-span-2 block"><span class="mb-2 block text-sm font-semibold">Description</span><textarea name="description" rows="5" class="w-full rounded-2xl border border-stone-300 px-4 py-3">{{ old('description', $category->description) }}</textarea></label>
        </div>
        <div class="mt-5 flex flex-wrap gap-5 text-sm">
            <label class="flex items-center gap-2"><input type="checkbox" name="in_header" value="1" @checked(old('in_header', $category->in_header ?? true))> Header</label>
            <label class="flex items-center gap-2"><input type="checkbox" name="in_footer" value="1" @checked(old('in_footer', $category->in_footer))> Footer</label>
            <label class="flex items-center gap-2"><input type="checkbox" name="is_active" value="1" @checked(old('is_active', $category->is_active ?? true))> Active</label>
        </div>
        <button type="submit" class="mt-6 rounded-2xl bg-stone-900 px-5 py-3 text-sm font-semibold text-white">Save category</button>
    </form>
@endsection
