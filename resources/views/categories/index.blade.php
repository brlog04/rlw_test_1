@extends('layouts.app')

@section('content')
    <section class="space-y-5">
        <div class="flex items-end justify-between">
            <div>
                <h1 class="text-2xl font-semibold tracking-tight">Kategorije</h1>
                <p class="mt-1 text-sm text-slate-600">Prikaz svih kategorija.</p>
            </div>
            <a href="{{ route('categories.create') }}"
                class="rounded-md bg-slate-900 px-3 py-2 text-sm font-medium text-white hover:bg-slate-800">
                Dodaj kategoriju
            </a>
        </div>

        @if (session('success'))
            <div class="rounded-md border border-emerald-200 bg-emerald-50 px-4 py-3 text-sm text-emerald-800">
                {{ session('success') }}
            </div>
        @endif
        <table class="min-w-full divide-y divide-slate-200 text-sm">
            <thead class="bg-slate-50">
                <tr>
                    <th class="px-4 py-3 text-left font-semibold text-slate-700">Naziv</th>
                    <th class="px-4 py-3 text-left font-semibold text-slate-700">Kreirano</th>
                    <th class="px-4 py-3 text-right font-semibold text-slate-700">Akcije</th>
                </tr>
            </thead>
            <tbody class="divide-y divide-slate-200">
                @forelse ($categories as $category)
                    <tr>
                        <td class="px-4 py-3 font-medium text-slate-900">{{ $category->name }}</td>
                        <td class="px-4 py-3 text-slate-600">{{ $category->created_at?->format('d.m.Y H:i') ?? '-' }}</td>
                        <td class="px-4 py-3 text-right">
                            <form method="POST" action="{{ route('categories.destroy', $category) }}"
                                onsubmit="return confirm('Jeste li sigurni da želite obrisati ovu kategoriju?');">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="text-sm text-red-600 hover:text-red-900">Obriši</button>
                            </form>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="3" class="px-4 py-10 text-center text-slate-500">Nema dodatih kategorija.</td>
                    </tr>
                @endforelse
            </tbody>
        </table>
        </div>
    </section>
@endsection