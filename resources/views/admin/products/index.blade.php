@extends('layouts.admin')

@section('title', 'Products')
@section('heading', 'Products')

@section('content')
    <div class="mb-5 flex items-center justify-between">
        <p class="text-sm text-stone-600">Best seller and swipe sections are controlled from product flags here.</p>
        <a href="{{ route('admin.products.create') }}" class="rounded-2xl bg-stone-900 px-5 py-3 text-sm font-semibold text-white">Add product</a>
    </div>
    <div class="overflow-hidden rounded-3xl bg-white shadow-sm ring-1 ring-stone-200">
        <table class="min-w-full divide-y divide-stone-200 text-sm">
            <thead class="bg-stone-50 text-left text-xs uppercase tracking-[0.16em] text-stone-500">
                <tr><th class="px-5 py-4">Product</th><th class="px-5 py-4">Category</th><th class="px-5 py-4">Price</th><th class="px-5 py-4">Flags</th><th class="px-5 py-4 text-right">Actions</th></tr>
            </thead>
            <tbody class="divide-y divide-stone-100">
                @foreach($products as $product)
                    <tr>
                        <td class="px-5 py-4 font-semibold">{{ $product->name }}</td>
                        <td class="px-5 py-4 text-stone-600">{{ $product->category?->name }}</td>
                        <td class="px-5 py-4 text-stone-600">${{ number_format((float) $product->price, 2) }}</td>
                        <td class="px-5 py-4 text-stone-600">{{ $product->is_best_seller ? 'Best seller' : '' }} {{ $product->is_swipe_featured ? 'Swipe' : '' }}</td>
                        <td class="px-5 py-4"><div class="flex justify-end gap-3"><a href="{{ route('admin.products.edit', $product) }}" class="font-semibold text-stone-700">Edit</a><form action="{{ route('admin.products.destroy', $product) }}" method="POST" data-confirm="This will remove the product.">@csrf @method('DELETE')<button type="submit" class="font-semibold text-red-600">Delete</button></form></div></td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
    <div class="mt-6">{{ $products->links() }}</div>
@endsection
