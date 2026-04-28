@extends('layouts.admin')

@section('title', 'Home Sections')
@section('heading', 'Home Sections')

@section('content')
    <div class="mb-5 flex items-center justify-between">
        <p class="text-sm text-stone-600">These sections power the home hero areas and video feature without changing the design.</p>
        <a href="{{ route('admin.home-sections.create') }}" class="rounded-2xl bg-stone-900 px-5 py-3 text-sm font-semibold text-white">Add section</a>
    </div>
    <div class="overflow-hidden rounded-3xl bg-white shadow-sm ring-1 ring-stone-200">
        <table class="min-w-full divide-y divide-stone-200 text-sm">
            <thead class="bg-stone-50 text-left text-xs uppercase tracking-[0.16em] text-stone-500">
                <tr><th class="px-5 py-4">Key</th><th class="px-5 py-4">Title</th><th class="px-5 py-4">Media</th><th class="px-5 py-4 text-right">Actions</th></tr>
            </thead>
            <tbody class="divide-y divide-stone-100">
                @foreach($sections as $section)
                    <tr>
                        <td class="px-5 py-4 font-semibold">{{ $section->key }}</td>
                        <td class="px-5 py-4 text-stone-600">{{ $section->title ?: 'No title' }}</td>
                        <td class="px-5 py-4 text-stone-600">{{ ucfirst($section->media_type) }}</td>
                        <td class="px-5 py-4"><div class="flex justify-end gap-3"><a href="{{ route('admin.home-sections.edit', $section) }}" class="font-semibold text-stone-700">Edit</a><form action="{{ route('admin.home-sections.destroy', $section) }}" method="POST" data-confirm="This will remove the home section.">@csrf @method('DELETE')<button type="submit" class="font-semibold text-red-600">Delete</button></form></div></td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
    <div class="mt-6">{{ $sections->links() }}</div>
@endsection
