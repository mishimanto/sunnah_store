@extends('layouts.admin')

@section('title', $managedUser->exists ? 'Edit User' : 'Create User')
@section('heading', $managedUser->exists ? 'Edit User' : 'Create User')

@section('content')
    <form action="{{ $managedUser->exists ? route('admin.users.update', $managedUser) : route('admin.users.store') }}" method="POST" class="rounded-3xl bg-white p-6 shadow-sm ring-1 ring-stone-200">
        @csrf
        @if($managedUser->exists) @method('PUT') @endif
        <div class="grid gap-5 md:grid-cols-2">
            <label class="block"><span class="mb-2 block text-sm font-semibold">Name</span><input type="text" name="name" value="{{ old('name', $managedUser->name) }}" class="w-full rounded-2xl border border-stone-300 px-4 py-3"></label>
            <label class="block"><span class="mb-2 block text-sm font-semibold">Email</span><input type="email" name="email" value="{{ old('email', $managedUser->email) }}" class="w-full rounded-2xl border border-stone-300 px-4 py-3"></label>
            <label class="block"><span class="mb-2 block text-sm font-semibold">Role</span><select name="role" class="w-full rounded-2xl border border-stone-300 px-4 py-3">@foreach(\App\Enums\UserRole::cases() as $role)<option value="{{ $role->value }}" @selected(old('role', $managedUser->role?->value) === $role->value)>{{ $role->label() }}</option>@endforeach</select></label>
            <label class="block"><span class="mb-2 block text-sm font-semibold">{{ $managedUser->exists ? 'New password (optional)' : 'Password' }}</span><input type="password" name="password" class="w-full rounded-2xl border border-stone-300 px-4 py-3"></label>
        </div>
        <button type="submit" class="mt-6 rounded-2xl bg-stone-900 px-5 py-3 text-sm font-semibold text-white">Save user</button>
    </form>
@endsection
