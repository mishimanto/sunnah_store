@extends('layouts.public')

@php use App\Support\Media; @endphp

@section('title', $product->name)

@section('content')
    <section class="page-shell">
        <div class="grid gap-10 lg:grid-cols-[1.05fr_0.95fr] lg:items-start">
            <div class="overflow-hidden rounded-[30px] bg-white shadow-sm ring-1 ring-stone-200">
                <img src="{{ Media::url($product->image_path) }}" alt="{{ $product->name }}" class="aspect-square w-full object-cover">
            </div>
            <div>
                <p class="page-eyebrow">{{ $product->category?->name ?? 'Product' }}</p>
                <h1 class="page-title">{{ $product->name }}</h1>
                <p class="text-2xl font-bold text-stone-900">${{ number_format((float) $product->price, 2) }}</p>
                <p class="mt-6 page-copy">{{ $product->description ?: $product->short_description }}</p>
                @if($product->badge_label)
                    <div class="mt-6 inline-flex rounded-full bg-emerald-100 px-4 py-2 text-sm font-semibold text-emerald-800">{{ $product->badge_label }}</div>
                @endif
            </div>
        </div>
    </section>
@endsection
