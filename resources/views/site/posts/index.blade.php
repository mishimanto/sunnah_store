@extends('layouts.public')

@php use App\Support\Media; @endphp

@section('title', 'Blog')

@section('content')
    <section class="page-shell">
        <p class="page-eyebrow">Journal</p>
        <h1 class="page-title">Soulful reflections and growth notes</h1>
        <p class="page-copy">The old blog cards are now real posts with searchable content and individual detail pages.</p>

        <form action="{{ route('posts.index') }}" method="GET" class="mt-8 grid gap-4 rounded-[28px] bg-white p-5 shadow-sm ring-1 ring-stone-200 md:grid-cols-[1fr_auto]">
            <input type="text" name="q" value="{{ $search }}" placeholder="Search blog posts..." class="w-full rounded-2xl border border-stone-300 px-4 py-3 outline-none focus:border-stone-900">
            <button type="submit" class="rounded-2xl bg-stone-900 px-5 py-3 text-sm font-semibold text-white">Search</button>
        </form>

        <div class="mt-10 grid gap-6 md:grid-cols-2 xl:grid-cols-3">
            @foreach($posts as $post)
                <a href="{{ route('posts.show', $post->slug) }}" class="overflow-hidden rounded-[24px] bg-white shadow-sm ring-1 ring-stone-200 transition hover:-translate-y-1 hover:shadow-lg">
                    <img src="{{ Media::url($post->image_path) }}" alt="{{ $post->title }}" class="aspect-[4/3] w-full object-cover">
                    <div class="p-6">
                        <p class="text-[11px] font-semibold uppercase tracking-[0.18em] text-emerald-700">{{ $post->category_label }}</p>
                        <h2 class="mt-3 logo-font text-3xl leading-tight">{{ $post->title }}</h2>
                        <p class="mt-3 text-sm leading-7 text-stone-600">{{ $post->excerpt }}</p>
                        <p class="mt-4 text-sm font-semibold text-stone-900">{{ $post->reading_time }}</p>
                    </div>
                </a>
            @endforeach
        </div>

        <div class="mt-8">{{ $posts->links() }}</div>
    </section>
@endsection
