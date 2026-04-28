@extends('layouts.admin')

@section('title', 'Categories')
@section('heading', 'Categories')

@section('content')
    <div class="mb-5 flex items-center justify-between">
        <p class="text-sm text-stone-600">Manage header navigation, footer categories, and product organization.</p>
        <a href="{{ route('admin.categories.create') }}" class="rounded-2xl bg-stone-900 px-5 py-3 text-sm font-semibold text-white">Add category</a>
    </div>
    <div class="overflow-hidden rounded-3xl bg-white shadow-sm ring-1 ring-stone-200">
        <table class="min-w-full divide-y divide-stone-200 text-sm">
            <thead class="bg-stone-50 text-left text-xs uppercase tracking-[0.16em] text-stone-500">
                <tr>
                    <th class="px-5 py-4">Name</th><th class="px-5 py-4">Parent</th><th class="px-5 py-4">Slug</th><th class="px-5 py-4">Visible</th><th class="px-5 py-4 text-right">Actions</th>
                </tr>
            </thead>
            <tbody class="divide-y divide-stone-100">
                @foreach($categories as $category)
                    <tr>
                        <td class="px-5 py-4 font-semibold">{{ $category->name }}</td>
                        <td class="px-5 py-4 text-stone-600">{{ $category->parent?->name ?: 'Top level' }}</td>
                        <td class="px-5 py-4 text-stone-600">{{ $category->slug }}</td>
                        <td class="px-5 py-4 text-stone-600">{{ $category->is_active ? 'Yes' : 'No' }}</td>
                        <td class="px-5 py-4">
                            <div class="flex justify-end gap-3">
                                <a href="{{ route('admin.categories.edit', $category) }}" class="font-semibold text-stone-700">Edit</a>
                                <form action="{{ route('admin.categories.destroy', $category) }}" method="POST" data-confirm="This will remove the category.">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="font-semibold text-red-600">Delete</button>
                                </form>
                            </div>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
    <div class="mt-6">{{ $categories->links() }}</div>
@endsection
