@extends('layouts.admin')

@section('title', 'Subscribers')
@section('heading', 'Subscribers')

@section('content')
    <div class="overflow-hidden rounded-3xl bg-white shadow-sm ring-1 ring-stone-200">
        <table class="min-w-full divide-y divide-stone-200 text-sm">
            <thead class="bg-stone-50 text-left text-xs uppercase tracking-[0.16em] text-stone-500">
                <tr><th class="px-5 py-4">Email</th><th class="px-5 py-4">Joined</th></tr>
            </thead>
            <tbody class="divide-y divide-stone-100">
                @foreach($subscribers as $subscriber)
                    <tr><td class="px-5 py-4 font-semibold">{{ $subscriber->email }}</td><td class="px-5 py-4 text-stone-600">{{ $subscriber->created_at?->diffForHumans() }}</td></tr>
                @endforeach
            </tbody>
        </table>
    </div>
    <div class="mt-6">{{ $subscribers->links() }}</div>
@endsection
