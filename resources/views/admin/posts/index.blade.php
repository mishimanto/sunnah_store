@extends('layouts.admin')

@section('title', 'Posts')
@section('heading', 'Posts')

@section('content')
    <div class="mb-5 flex items-center justify-between">
        <p class="text-sm text-stone-600">Featured posts populate the blog section on the homepage automatically.</p>
        <a href="{{ route('admin.posts.create') }}" class="rounded-2xl bg-stone-900 px-5 py-3 text-sm font-semibold text-white">Add post</a>
    </div>
    <div class="overflow-hidden rounded-3xl bg-white shadow-sm ring-1 ring-stone-200">
        <table class="min-w-full divide-y divide-stone-200 text-sm">
            <thead class="bg-stone-50 text-left text-xs uppercase tracking-[0.16em] text-stone-500">
                <tr><th class="px-5 py-4">Title</th><th class="px-5 py-4">Category</th><th class="px-5 py-4">Published</th><th class="px-5 py-4 text-right">Actions</th></tr>
            </thead>
            <tbody class="divide-y divide-stone-100">
                @foreach($posts as $post)
                    <tr>
                        <td class="px-5 py-4 font-semibold">{{ $post->title }}</td>
                        <td class="px-5 py-4 text-stone-600">{{ $post->category_label }}</td>
                        <td class="px-5 py-4 text-stone-600">{{ $post->is_published ? 'Yes' : 'No' }}</td>
                        <td class="px-5 py-4"><div class="flex justify-end gap-3"><a href="{{ route('admin.posts.edit', $post) }}" class="font-semibold text-stone-700">Edit</a><form action="{{ route('admin.posts.destroy', $post) }}" method="POST" data-confirm="This will remove the post.">@csrf @method('DELETE')<button type="submit" class="font-semibold text-red-600">Delete</button></form></div></td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
    <div class="mt-6">{{ $posts->links() }}</div>
@endsection
