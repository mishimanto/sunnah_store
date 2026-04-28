@extends('layouts.public')

@php use App\Support\Media; @endphp

@section('title', $category->name)

@section('content')
    <section class="page-shell">
        <p class="page-eyebrow">Category</p>
        <h1 class="page-title">{{ $category->name }}</h1>
        <p class="page-copy">{{ $category->description ?: 'A dynamic category page backed by repository-driven content.' }}</p>

        @if($category->children->isNotEmpty())
            <div class="mt-8 flex flex-wrap gap-3">
                @foreach($category->children as $child)
                    <a href="{{ route('categories.show', $child->slug) }}" class="rounded-full border border-stone-300 bg-white px-4 py-2 text-sm font-semibold text-stone-700">{{ $child->name }}</a>
                @endforeach
            </div>
        @endif

        <div class="mt-10 grid gap-6 sm:grid-cols-2 lg:grid-cols-3 xl:grid-cols-4">
            @forelse($category->products as $product)
                <a href="{{ route('products.show', $product->slug) }}" class="overflow-hidden rounded-[24px] bg-white shadow-sm ring-1 ring-stone-200">
                    <img src="{{ Media::url($product->image_path) }}" alt="{{ $product->name }}" class="aspect-square w-full object-cover">
                    <div class="p-5">
                        <p class="text-[11px] font-semibold uppercase tracking-[0.18em] text-emerald-700">{{ $product->tag_label }}</p>
                        <h2 class="mt-2 logo-font text-2xl">{{ $product->name }}</h2>
                        <p class="mt-3 text-sm leading-7 text-stone-600">${{ number_format((float) $product->price, 2) }}</p>
                    </div>
                </a>
            @empty
                <div class="rounded-[24px] bg-white p-8 text-sm text-stone-600 shadow-sm ring-1 ring-stone-200">Products can be added to this category from the admin panel.</div>
            @endforelse
        </div>
    </section>
@endsection
