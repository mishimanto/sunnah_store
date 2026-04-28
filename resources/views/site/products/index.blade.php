@extends('layouts.public')

@php use App\Support\Media; @endphp

@section('title', 'Products')

@section('content')
    <section class="page-shell">
        <p class="page-eyebrow">Store</p>
        <h1 class="page-title">{{ $activeCategory?->name ?? 'All Products' }}</h1>
        <p class="page-copy">Browse the storefront as a fully dynamic catalog. Search, category filters, and content updates now run through Laravel instead of static markup.</p>

        <form action="{{ route('products.index') }}" method="GET" class="mt-8 grid gap-4 rounded-[28px] bg-white p-5 shadow-sm ring-1 ring-stone-200 md:grid-cols-[1fr_auto]">
            <input type="text" name="q" value="{{ $search }}" placeholder="Search products..." class="w-full rounded-2xl border border-stone-300 px-4 py-3 outline-none focus:border-stone-900">
            <button type="submit" class="rounded-2xl bg-stone-900 px-5 py-3 text-sm font-semibold text-white">Search</button>
        </form>

        <div class="mt-10 grid gap-6 sm:grid-cols-2 lg:grid-cols-3 xl:grid-cols-4">
            @forelse($products as $product)
                <a href="{{ route('products.show', $product->slug) }}" class="overflow-hidden rounded-[24px] bg-white shadow-sm ring-1 ring-stone-200 transition hover:-translate-y-1 hover:shadow-lg">
                    <img src="{{ Media::url($product->image_path) }}" alt="{{ $product->name }}" class="aspect-square w-full object-cover">
                    <div class="p-5">
                        <p class="text-[11px] font-semibold uppercase tracking-[0.18em] text-emerald-700">{{ $product->tag_label ?: ($product->category?->name ?? 'Product') }}</p>
                        <h2 class="mt-2 logo-font text-2xl">{{ $product->name }}</h2>
                        <p class="mt-3 text-sm leading-7 text-stone-600">{{ $product->short_description }}</p>
                        <div class="mt-4 flex items-center justify-between">
                            <span class="text-sm font-semibold">${{ number_format((float) $product->price, 2) }}</span>
                            <span class="text-sm font-semibold text-emerald-700">View</span>
                        </div>
                    </div>
                </a>
            @empty
                <div class="rounded-[24px] bg-white p-8 text-sm text-stone-600 shadow-sm ring-1 ring-stone-200">No products matched your search.</div>
            @endforelse
        </div>

        <div class="mt-8">{{ $products->links() }}</div>
    </section>
@endsection
