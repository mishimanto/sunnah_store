@extends('layouts.admin')

@section('title', 'Messages')
@section('heading', 'Messages')

@section('content')
    <div class="space-y-4">
        @foreach($messages as $message)
            <div class="rounded-3xl bg-white p-6 shadow-sm ring-1 ring-stone-200">
                <div class="flex flex-col gap-3 sm:flex-row sm:items-center sm:justify-between">
                    <div>
                        <h3 class="text-lg font-black">{{ $message->subject }}</h3>
                        <p class="text-sm text-stone-500">{{ $message->name }} · {{ $message->email }}</p>
                    </div>
                    <p class="text-sm text-stone-500">{{ $message->created_at?->diffForHumans() }}</p>
                </div>
                <p class="mt-4 text-sm leading-7 text-stone-700">{{ $message->message }}</p>
            </div>
        @endforeach
    </div>
    <div class="mt-6">{{ $messages->links() }}</div>
@endsection
