@extends('layouts.public')

@section('title', $page->title)

@section('content')
    <section class="page-shell">
        <p class="page-eyebrow">{{ ucfirst($page->section) }}</p>
        <h1 class="page-title">{{ $page->title }}</h1>
        @if($page->excerpt)
            <p class="page-copy">{{ $page->excerpt }}</p>
        @endif

        <div class="mt-10 grid gap-10 lg:grid-cols-[1fr_0.85fr]">
            <div class="rounded-[28px] bg-white p-8 shadow-sm ring-1 ring-stone-200">
                <div class="space-y-5 text-[15px] leading-8 text-stone-700">
                    <p>{{ $page->body }}</p>
                </div>
            </div>

            @if(in_array($page->slug, ['contact', 'feedback'], true))
                <div class="rounded-[28px] bg-white p-8 shadow-sm ring-1 ring-stone-200">
                    <h2 class="text-2xl font-black text-stone-900">{{ $page->slug === 'feedback' ? 'Send feedback' : 'Send a message' }}</h2>
                    <form action="{{ route('contact.store') }}" method="POST" class="mt-6 space-y-4">
                        @csrf
                        <input type="hidden" name="subject" value="{{ $page->slug === 'feedback' ? 'Feedback' : 'Contact enquiry' }}">
                        <label class="block">
                            <span class="mb-2 block text-sm font-semibold">Name</span>
                            <input type="text" name="name" class="w-full rounded-2xl border border-stone-300 px-4 py-3 outline-none focus:border-stone-900" required>
                        </label>
                        <label class="block">
                            <span class="mb-2 block text-sm font-semibold">Email</span>
                            <input type="email" name="email" class="w-full rounded-2xl border border-stone-300 px-4 py-3 outline-none focus:border-stone-900" required>
                        </label>
                        <label class="block">
                            <span class="mb-2 block text-sm font-semibold">Message</span>
                            <textarea name="message" rows="6" class="w-full rounded-2xl border border-stone-300 px-4 py-3 outline-none focus:border-stone-900" required></textarea>
                        </label>
                        <button type="submit" class="rounded-2xl bg-stone-900 px-5 py-3 text-sm font-semibold text-white">Send</button>
                    </form>
                </div>
            @endif
        </div>
    </section>
@endsection
