@extends('layouts.admin')

@section('title', 'Dashboard')
@section('heading', 'Dashboard')

@section('content')
    <div class="grid gap-4 md:grid-cols-2 xl:grid-cols-4">
        @foreach($stats as $label => $value)
            <div class="rounded-3xl bg-white p-6 shadow-sm ring-1 ring-stone-200">
                <p class="text-xs font-semibold uppercase tracking-[0.2em] text-stone-500">{{ str_replace('_', ' ', $label) }}</p>
                <p class="mt-3 text-4xl font-black text-stone-900">{{ $value }}</p>
            </div>
        @endforeach
    </div>

    <div class="mt-8 grid gap-6 lg:grid-cols-2">
        <div class="rounded-3xl bg-white p-6 shadow-sm ring-1 ring-stone-200">
            <h3 class="text-lg font-black">What is live now</h3>
            <p class="mt-3 text-sm leading-7 text-stone-600">This admin panel manages the home sections, products, category navigation, blog posts, generic pages, subscribers, messages, and site settings. Controllers are wired through repositories so the content layer stays clean and easy to extend.</p>
        </div>
        <div class="rounded-3xl bg-white p-6 shadow-sm ring-1 ring-stone-200">
            <h3 class="text-lg font-black">Suggested next steps</h3>
            <ul class="mt-3 space-y-3 text-sm leading-7 text-stone-600">
                <li>Upload your own logo and hero assets from `Settings` and `Home Sections`.</li>
                <li>Replace demo users and passwords from `Users` if you are using the seeded accounts.</li>
                <li>Expand product descriptions and post bodies before launch.</li>
            </ul>
        </div>
    </div>
@endsection
