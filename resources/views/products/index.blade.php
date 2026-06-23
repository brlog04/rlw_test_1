@extends('layouts.app')

@section('content')
    <section class="space-y-5">
        <!-- Filter sekcija -->
        <div class="mb-5">
            <form method="GET" action="{{ route('products.index') }}" class="flex items-end gap-3">
                <div>
                    <label for="category_id" class="block text-sm font-medium text-slate-700">Kategorija</label>
                    <select name="category_id" id="category_id" class="mt-1 rounded-md border border-slate-300 px-3 py-2">
                        <option value="">Sve kategorije</option>
                        @foreach ($categories as $category)
                            <option value="{{ $category->id }}" {{ $selectedCategory == $category->id ? 'selected' : '' }}>
                                {{ $category->name }}
                            </option>
                        @endforeach
                    </select>
                </div>
                <button type="submit"
                    class="rounded-md bg-slate-900 px-3 py-2 text-sm font-medium text-white hover:bg-slate-800">
                    Filtriraj
                </button>
            </form>
        </div>
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
                        <th class="px-4 py-3 text-right font-semibold text-slate-700">Akcije</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-slate-200">
                    @forelse ($products as $product)
                        <tr>
                            <td class="px-4 py-3 font-medium text-slate-900">{{ $product->name }}</td>
                            <td class="px-4 py-3 text-slate-600">{{ $product->category?->name ?? '-' }}</td>
                            <td class="px-4 py-3 text-slate-600">{{ $product->description ?: '-' }}</td>
                            <td class="px-4 py-3 text-right text-slate-800">{{ number_format((float) $product->price, 2) }}</td>
                            <td class="px-4 py-3 text-right">
                                <a href="{{ route('products.edit', $product) }}" class="font-bold text-blue-600 hover:text-blue-900">Izmeni</a>
                                <form action="{{ route('products.destroy', $product) }}" method="POST" class="inline">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="font-bold text-red-600 hover:text-red-900">Obriši</button>
                                </form>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="5" class="px-4 py-10 text-center text-slate-500">Nema dodatih products.</td>
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