@extends('layouts.admin')

@section('title', $product->exists ? 'Edit Product' : 'Create Product')
@section('heading', $product->exists ? 'Edit Product' : 'Create Product')

@section('content')
    <form action="{{ $product->exists ? route('admin.products.update', $product) : route('admin.products.store') }}" method="POST" enctype="multipart/form-data" class="rounded-3xl bg-white p-6 shadow-sm ring-1 ring-stone-200">
        @csrf
        @if($product->exists) @method('PUT') @endif
        <div class="grid gap-5 md:grid-cols-2">
            <label class="block"><span class="mb-2 block text-sm font-semibold">Name</span><input type="text" name="name" value="{{ old('name', $product->name) }}" class="w-full rounded-2xl border border-stone-300 px-4 py-3"></label>
            <label class="block"><span class="mb-2 block text-sm font-semibold">Slug</span><input type="text" name="slug" value="{{ old('slug', $product->slug) }}" class="w-full rounded-2xl border border-stone-300 px-4 py-3"></label>
            <label class="block"><span class="mb-2 block text-sm font-semibold">Category</span><select name="category_id" class="w-full rounded-2xl border border-stone-300 px-4 py-3"><option value="">Select one</option>@foreach($categories as $category)<option value="{{ $category->id }}" @selected(old('category_id', $product->category_id) == $category->id)>{{ $category->name }}</option>@endforeach</select></label>
            <label class="block"><span class="mb-2 block text-sm font-semibold">Price</span><input type="number" step="0.01" name="price" value="{{ old('price', $product->price) }}" class="w-full rounded-2xl border border-stone-300 px-4 py-3"></label>
            <label class="block"><span class="mb-2 block text-sm font-semibold">Tag label</span><input type="text" name="tag_label" value="{{ old('tag_label', $product->tag_label) }}" class="w-full rounded-2xl border border-stone-300 px-4 py-3"></label>
            <label class="block"><span class="mb-2 block text-sm font-semibold">Badge label</span><input type="text" name="badge_label" value="{{ old('badge_label', $product->badge_label) }}" class="w-full rounded-2xl border border-stone-300 px-4 py-3"></label>
            <label class="block"><span class="mb-2 block text-sm font-semibold">Sort order</span><input type="number" name="sort_order" value="{{ old('sort_order', $product->sort_order) }}" class="w-full rounded-2xl border border-stone-300 px-4 py-3"></label>
            <label class="block"><span class="mb-2 block text-sm font-semibold">Image</span><input type="file" name="image" class="w-full rounded-2xl border border-stone-300 px-4 py-3"></label>
            <label class="md:col-span-2 block"><span class="mb-2 block text-sm font-semibold">Short description</span><input type="text" name="short_description" value="{{ old('short_description', $product->short_description) }}" class="w-full rounded-2xl border border-stone-300 px-4 py-3"></label>
            <label class="md:col-span-2 block"><span class="mb-2 block text-sm font-semibold">Description</span><textarea name="description" rows="6" class="w-full rounded-2xl border border-stone-300 px-4 py-3">{{ old('description', $product->description) }}</textarea></label>
        </div>
        <div class="mt-5 flex flex-wrap gap-5 text-sm">
            <label class="flex items-center gap-2"><input type="checkbox" name="is_best_seller" value="1" @checked(old('is_best_seller', $product->is_best_seller))> Best seller</label>
            <label class="flex items-center gap-2"><input type="checkbox" name="is_swipe_featured" value="1" @checked(old('is_swipe_featured', $product->is_swipe_featured))> Swipe featured</label>
            <label class="flex items-center gap-2"><input type="checkbox" name="is_active" value="1" @checked(old('is_active', $product->is_active ?? true))> Active</label>
        </div>
        <button type="submit" class="mt-6 rounded-2xl bg-stone-900 px-5 py-3 text-sm font-semibold text-white">Save product</button>
    </form>
@endsection
