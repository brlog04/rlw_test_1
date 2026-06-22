@extends('layouts.app')

@section('content')
    <section class="space-y-5">
        <div class="flex items-end justify-between">
            <div>
                <h1 class="text-2xl font-semibold tracking-tight">Products</h1>
                <p class="mt-1 text-sm text-slate-600">Osnovni prikaz svih products stavki.</p>
            </div>
            <a href="{{ route('products.create') }}"
                class="rounded-md bg-slate-900 px-3 py-2 text-sm font-medium text-white hover:bg-slate-800">
                Dodaj product
            </a>
        </div>

        <div class="overflow-hidden rounded-xl border border-slate-200 bg-white">
            <table class="min-w-full divide-y divide-slate-200 text-sm">
                <thead class="bg-slate-50">
                    <tr>
                        <th class="px-4 py-3 text-left font-semibold text-slate-700">Naziv</th>
                        <th class="px-4 py-3 text-left font-semibold text-slate-700">Kategorija</th>
                        <th class="px-4 py-3 text-left font-semibold text-slate-700">Opis</th>
                        <th class="px-4 py-3 text-right font-semibold text-slate-700">Cena</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-slate-200">
                    @forelse ($products as $product)
                        <tr>
                            <td class="px-4 py-3 font-medium text-slate-900">{{ $product->name }}</td>
                            <td class="px-4 py-3 text-slate-600">{{ $product->category?->name ?? '-' }}</td>
                            <td class="px-4 py-3 text-slate-600">{{ $product->description ?: '-' }}</td>
                            <td class="px-4 py-3 text-right text-slate-800">{{ number_format((float) $product->price, 2) }}</td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="4" class="px-4 py-10 text-center text-slate-500">Nema dodatih products.</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>

        <div>
            {{ $products->links() }}
        </div>
    </section>
@endsection