<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <title>{{ config('app.name', 'Laravel') }}</title>
        @if (file_exists(public_path('build/manifest.json')) || file_exists(public_path('hot')))
            @vite(['resources/css/app.css', 'resources/js/app.js'])
        @endif
    </head>
    <body class="min-h-screen bg-slate-100 text-slate-900">
        <header class="border-b border-slate-200 bg-white">
            <div class="mx-auto flex max-w-5xl items-center justify-between px-4 py-4 sm:px-6">
                <a href="{{ auth()->check() ? route('products.index') : route('login') }}" class="text-lg font-semibold tracking-tight">
                    Product App
                </a>

                @auth
                    <nav class="flex items-center gap-3">
                        <a href="{{ route('products.index') }}" class="rounded-md px-3 py-2 text-sm font-medium text-slate-700 hover:bg-slate-100">
                            Products
                        </a>
                        <a href="{{ route('products.create') }}" class="rounded-md bg-slate-900 px-3 py-2 text-sm font-medium text-white hover:bg-slate-800">
                            Dodaj product
                        </a>
                        <form method="POST" action="{{ route('logout') }}">
                            @csrf
                            <button type="submit" class="rounded-md px-3 py-2 text-sm font-medium text-slate-700 hover:bg-slate-100">
                                Logout
                            </button>
                        </form>
                    </nav>
                @else
                    <nav class="flex items-center gap-2">
                        <a href="{{ route('login') }}" class="rounded-md px-3 py-2 text-sm font-medium text-slate-700 hover:bg-slate-100">Login</a>
                        <a href="{{ route('register') }}" class="rounded-md bg-slate-900 px-3 py-2 text-sm font-medium text-white hover:bg-slate-800">Register</a>
                    </nav>
                @endauth
            </div>
        </header>

        <main class="mx-auto max-w-5xl px-4 py-8 sm:px-6">
            @if (session('status'))
                <div class="mb-6 rounded-md border border-emerald-200 bg-emerald-50 px-4 py-3 text-sm text-emerald-700">
                    {{ session('status') }}
                </div>
            @endif

            @yield('content')
        </main>
    </body>
</html>
