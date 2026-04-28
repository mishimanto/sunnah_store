@extends('layouts.admin')

@section('title', 'Users')
@section('heading', 'Users')

@section('content')
    <div class="mb-5 flex items-center justify-between">
        <p class="text-sm text-stone-600">Super admins can create additional admins and editors from here.</p>
        <a href="{{ route('admin.users.create') }}" class="rounded-2xl bg-stone-900 px-5 py-3 text-sm font-semibold text-white">Add user</a>
    </div>
    <div class="overflow-hidden rounded-3xl bg-white shadow-sm ring-1 ring-stone-200">
        <table class="min-w-full divide-y divide-stone-200 text-sm">
            <thead class="bg-stone-50 text-left text-xs uppercase tracking-[0.16em] text-stone-500">
                <tr><th class="px-5 py-4">Name</th><th class="px-5 py-4">Email</th><th class="px-5 py-4">Role</th><th class="px-5 py-4 text-right">Actions</th></tr>
            </thead>
            <tbody class="divide-y divide-stone-100">
                @foreach($users as $user)
                    <tr>
                        <td class="px-5 py-4 font-semibold">{{ $user->name }}</td>
                        <td class="px-5 py-4 text-stone-600">{{ $user->email }}</td>
                        <td class="px-5 py-4 text-stone-600">{{ $user->role->label() }}</td>
                        <td class="px-5 py-4"><div class="flex justify-end gap-3"><a href="{{ route('admin.users.edit', $user) }}" class="font-semibold text-stone-700">Edit</a><form action="{{ route('admin.users.destroy', $user) }}" method="POST" data-confirm="This will remove the user.">@csrf @method('DELETE')<button type="submit" class="font-semibold text-red-600">Delete</button></form></div></td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
    <div class="mt-6">{{ $users->links() }}</div>
@endsection
