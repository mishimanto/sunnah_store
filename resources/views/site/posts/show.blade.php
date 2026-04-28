@extends('layouts.public')

@php use App\Support\Media; @endphp

@section('title', $post->title)

@section('content')
    <article class="page-shell">
        <p class="page-eyebrow">{{ $post->category_label }}</p>
        <h1 class="page-title">{{ $post->title }}</h1>
        <p class="text-sm font-semibold text-stone-500">{{ optional($post->published_at)->format('F j, Y') }} · {{ $post->reading_time }}</p>
        <div class="mt-8 overflow-hidden rounded-[30px] bg-white shadow-sm ring-1 ring-stone-200">
            <img src="{{ Media::url($post->image_path) }}" alt="{{ $post->title }}" class="aspect-[16/9] w-full object-cover">
        </div>
        <div class="mt-10 max-w-3xl space-y-6 text-[15px] leading-8 text-stone-700">
            <blockquote class="rounded-[24px] bg-stone-900 px-6 py-5 text-lg font-medium text-white">{{ $post->quote }} <span class="text-amber-300">{{ $post->quote_highlight }}</span></blockquote>
            <p>{{ $post->body }}</p>
        </div>
    </article>
@endsection
